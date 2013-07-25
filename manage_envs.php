<h1>&Uuml;bungsumgebungen verwalten</h1><br>
Hier k&ouml;nnen s&auml;mtliche &Uuml;bungsumgebungen verwaltet werden.<br><br><br><br>

<?php 
global $VLANstartID, $VNCstartID, $use_vnetÌD, $use_tempIDWebserver, $use_tempIDMitM, $use_tempIDClient;

if (isset($_POST['starten'])) {
    $count = (int) $_POST['count'];
    $vncID = $VNCstartID;
    if($count){
        if(isset($_POST['shared']))
        {
            $vnetID = one_create_vnet("MitM_Network", $VLANstartID, one_show_vnet($use_vnetÌD));   
            db_create_vnet($vnetID);
            db_create_vm(one_create_vm("MitM_Webserver", (int) $vnetID, (int) $use_tempIDWebserver, (int) $vncID));
            $vncID++;
            db_create_vm(one_create_vm("MitM_Client", (int) $vnetID, (int) $use_tempIDClient, (int) $vncID));
            $vncID++;
            for ($i = 1; $i <= $count; $i++) {
                $vmID_MitM = one_create_vm("MitM_Attacker_User_".$i, (int) $vnetID, (int) $use_tempIDMitM, (int) $vncID);
                db_create_vm($vmID_MitM);
                $vncID++;
                 // Create the user
                $username = "User".$i;
                $password = "User".$i;
                $userID = one_create_user($username, $password);
                $users[]= "<strong>Benutername=</strong>".$username." <strong>Passwort=</strong>".$password."<br>";
                db_create_user($userID);
                // Create acl for this user
                one_create_acl(hex_user_num($userID), hex_ressource_num($vmID_MitM), "1");
            }
        }
        else
        {
            for ($i = $VLANstartID; $i <= $count+$VLANstartID-1; $i++) {
                // Create the virtual network
                $vnetID = one_create_vnet("Network_".$i, $i, one_show_vnet($use_vnetÌD));
                db_create_vnet($vnetID);
                // Create the virtual machines
                db_create_vm(one_create_vm("MitM_Webserver_User_".$i, (int) $vnetID, (int) $use_tempIDWebserver, (int) $vncID));
                $vncID++;
                $vmID_MitM = one_create_vm("MitM_Attacker_User_".$i, (int) $vnetID, (int) $use_tempIDMitM, (int) $vncID);
                db_create_vm($vmID_MitM);
                $vncID++;
                db_create_vm(one_create_vm("MitM_Client_User_".$i, (int) $vnetID, (int) $use_tempIDClient, (int) $vncID));
                $vncID++;
                // Create the user
                $username = "User".$i;
                $password = "User".$i;
                $userID = one_create_user($username, $password);
                $users[]= "<strong>Benutername=</strong>".$username." <strong>Passwort=</strong>".$password."<br>";
                db_create_user($userID);
                // Create acl for this user
                one_create_acl(hex_user_num($userID), hex_ressource_num($vmID_MitM), "1");
            }
        }
        echo "<div class=\"success\">Es wurden <strong>".$count."</strong> &Uuml;bungsumgebungen erstellt!<br>
            Die Zugangsdaten f&uuml;r die Benutzer sind:<br><br>";
        $count = 1;
            foreach($users as $user)
            {
                echo "Benutzer ".$count.": ".$user;
                $count++;
            }
        echo "</div>";
    }
    else
    {
        echo "<div class=\"error\">Geben Sie eine g&uuml;ltige Zahl ein!</div>";
    }
}
if (isset($_POST['stoppen'])) { 
    if(TRUE){
        // Delete virtual networks
        $vnetIDs = db_getall_vnet();
        $vmIDs = db_getall_vm();
        $userIDs = db_getall_user();
        $aclIDs = db_getall_acl();
        $count = 0;
        foreach ($vnetIDs as $vnetID) {
            one_delete_vnet((int) $vnetID['vnetID']);
        }
        db_removeall_vnet();
        foreach ($vmIDs as $vmID) {
            one_delete_vm($vmID['vmID']);
        }
        db_removeall_vm();
        foreach ($userIDs as $userID) {
            one_delete_user($userID['userID']);
            $count++;
        }
        db_removeall_user();
        echo "<div class=\"success\">Es wurden <strong>".$count."</strong> &Uuml;bungsumgebungen beendet!</div>";
    }
    else {
        echo "<div class=\"error\">Geben Sie eine g&uuml;ltige Zahl ein!</div>";
    }
} 
?>
<table align="left" cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="5"><h3>Verf&uuml;gbare &Uuml;bungsumgebungen:</h3></td></tr>
<tr><td><strong>Name</strong></td><td><strong>Umgebung starten</strong></td><td><strong>geteilte Umgebung</strong></td><td><strong>Umgebung stoppen</strong></td></tr>
<tr><td>Man-in-the-Middle Angriff</td>
    <form action="" method="post">
        <?php
            if(count(db_getall_vm())) {
                echo "<td>";
                echo count(db_getall_vnet())." Umgebungen laufen";
                echo "</td><td></td>";
            } 
            else {
                echo "<td>";
                echo "<input type=\"number\" name=\"count\" size=\"1\"> <button type=\"submit\" name=\"starten\">starten</button>";
                echo "</td><td><input type=\"checkbox\" name=\"shared\" value=\"true\"  /></td>";
                echo "</td>";
            }
        ?>
    </form>
<td>    
    <form action="" method="post">
        <?php
            if(count(db_getall_vm())){
                echo "<button type=\"submit\" name=\"stoppen\">stoppen</button>";
            } 
            else {
                echo "<button disabled>stoppen</button>";
            }
        ?>
    </form>
</td></tr>
</table>