<?php
global $DISPLAY_ERRORS;

if($DISPLAY_ERRORS)
{
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(-1);
}
include("xml_funcs.php");

function one_show_vm() {
    global $vm_state, $lcm_state, $theme, $SOCKETstartport;

    $vmpool_info = rpc2_request("one.vmpool.info", array($_SESSION['auth'],-2,-1,-1,-2));
    
    if (is_array($vmpool_info['VM_POOL']['VM'][0]))
        $vmpool_info = $vmpool_info['VM_POOL']['VM'];
    elseif (is_array($vmpool_info['VM_POOL']['VM']))
        $vmpool_info = $vmpool_info['VM_POOL'];
    else
        $vmpool_info = array();
    print "<tr>
        <td><strong>ID</strong></td>
        <td><strong>Name</strong></td>
        <td><strong>Status</strong></td>
        <td><strong>RAM</strong></td>
        <td><strong>VNC Port</strong></td>
        <td><strong>l&auml;uft seit</strong></td>
        <td><strong>VNC</strong></td>
        </tr>\n";
    
    $count = 1 + $SOCKETstartport;
    foreach ($vmpool_info as $vm) {
        //LCM_STATE=3 means that the VM is running
        if($vm['LCM_STATE'] == 3)
        {
            $time = time() - $vm['STIME'];
            $days = $time / (24*60*60);
            $hours = ($time % (24*60*60)) / (60*60);
            $minutes = (($time % (24*60*60)) % (60*60)) / 60;
            $seconds = (($time % (24*60*60)) % (60*60)) % 60;
            $time = (int)$days."d ".(int)$hours.":".(int)$minutes.":".$seconds;
            print "<tr><td>".$vm['ID']."</td><td>".$vm['NAME']."</td><td>running</td><td>".$vm['MEMORY']."</td><td>".$vm['TEMPLATE']['GRAPHICS']['PORT']."</td><td>".$time."</td>".
                    "<td>
                     <form action=\"\" method=\"post\">
                           <input type=\"hidden\" name=\"vncPort\" value=\"".$vm['TEMPLATE']['GRAPHICS']['PORT']."\">
                           <input type=\"hidden\" name=\"webPort\" value=\"".$count."\">
                           <input type=\"hidden\" name=\"starten\" value=\"starten\">
                           <input type=\"image\" src=\"themes/".$theme."/images/monitor.png\" name=\"button starten\" value=\"starten\" width=\"35\" height=\"35\">
                     </form></td>";
            print "</tr>\n";
            $count++;
        }
    }
}


function one_show_vnet($vnetID) {   
   $status = rpc2_request("one.vn.info", array($_SESSION['auth'], $vnetID));
   if (isset($status['failed'])) {
       print "Err: ".$status['failed']."\n";
   }
   return $status;
}

function one_create_vnet($Name, $VlanID, $vnettemplate) {

   $template = "NAME = \"".$Name."\"\n";
   if($vnettemplate['VNET']['TYPE'] == "1")
   {
    $template .= "TYPE = FIXED\n";
   }
   else
   {
    $template .= "TYPE = RANGED\n";
   }
   $template .= "BRIDGE = ".$vnettemplate['VNET']['BRIDGE']."\n";

   foreach ($vnettemplate['VNET']['LEASES']['LEASE'] as $lease)
   {
         $template .= "LEASES = [ IP=\"".$lease['IP']."\"]\n";
   }
   $template .= "VLAN = YES\n";
   $template .= "VLAN_ID = ".$VlanID;
   
   $status = rpc2_request("one.vn.allocate", array($_SESSION['auth'], $template,-1),FALSE);
   if (isset($status['failed'])) {
       print "Err: ".$status['failed']."\n";
   }
   return $status;
}
function one_delete_vnet($vnetID) {   
   $status = rpc2_request("one.vn.delete", array($_SESSION['auth'], $vnetID),FALSE);
   if (isset($status['failed'])) {
       print "Err: ".$status['failed']."\n";
   }
   return $status;
}
function one_create_vm($Name, $vnetID, $templateID, $vncPort) {
    
   $template = "NIC=[NETWORK_ID=\"".$vnetID."\"]";
   $template .= "GRAPHICS=[TYPE=\"vnc\",PORT=\"".$vncPort."\"]";
   $status = rpc2_request("one.template.instantiate", array($_SESSION['auth'], $templateID,$Name,FALSE,$template),FALSE);
   if (isset($status['failed'])) {
       print "Err: ".$status['failed']."\n";
   }
   return $status;
}
function one_delete_vm($vmID) {
   $status = rpc2_request("one.vm.action", array($_SESSION['auth'],"delete", (int) $vmID),FALSE);
   if (isset($status['failed'])) {
       print "Err: ".$status['failed']."\n";
   }
   return $status;
}
function one_create_user($username, $password) {
   $status = rpc2_request("one.user.allocate", array($_SESSION['auth'], $username, $password, ""),FALSE);
   if (isset($status['failed'])) {
       print "Err: ".$status['failed']."\n";
   }
   return $status;
}
function one_delete_user($userID) {
   $status = rpc2_request("one.user.delete", array($_SESSION['auth'],(int) $userID),FALSE);
   if (isset($status['failed'])) {
       print "Err: ".$status['failed']."\n";
   }
   return $status;
}
function one_create_acl($user, $resource, $rights) {
   $status = rpc2_request("one.acl.addrule", array($_SESSION['auth'], $user,$resource,$rights),FALSE);
   if (isset($status['failed'])) {
       print "Err: ".$status['failed']."\n";
   }
   return $status;
}
function one_delete_acl($aclID) {
   $status = rpc2_request("one.acl.delrule", array($_SESSION['auth'],(int) $aclID),FALSE);
   if (isset($status['failed'])) {
       print "Err: ".$status['failed']."\n";
   }
   return $status;
}
function one_user_info() {
   $status = rpc2_request("one.user.info", array($_SESSION['auth'],-1));
   if (isset($status['failed'])) {
       print "Err: ".$status['failed']."\n";
   }
   return $status;
}
function hex_user_num($userID) {
   $hex_userid = dechex ($userID);
   $hex_user = "100000000";
   return substr($hex_user,0,strlen($hex_user)-strlen($hex_userid)) . $hex_userid;
}
function hex_ressource_num($vmID) {
   $hex_vmid = dechex ($vmID);
   $hex_vm = "1100000000";
   return substr($hex_vm,0,strlen($hex_vm)-strlen($hex_vmid)) . $hex_vmid;
}
?>
