<?php
include("adodb/adodb.inc.php");

function db_create_vnet($vnetid) {
    global $adodb_type, $adodb_server, $adodb_user, $adodb_pass, $adodb_name;
    $db = NewADOConnection($adodb_type);
    $db->Connect($adodb_server, $adodb_user, $adodb_pass, $adodb_name);

    $result = $db->Execute("insert into running_vnet values(?,?)",array(NULL,$vnetid));
    return true;
}
function db_getall_vnet() {
    global $adodb_type, $adodb_server, $adodb_user, $adodb_pass, $adodb_name;
    $db = NewADOConnection($adodb_type);
    $db->Connect($adodb_server, $adodb_user, $adodb_pass, $adodb_name);

    $result = $db->GetAll("select vnetID from running_vnet");
    return $result;
}
function db_removeall_vnet() {
    global $adodb_type, $adodb_server, $adodb_user, $adodb_pass, $adodb_name;
    $db = NewADOConnection($adodb_type);
    $db->Connect($adodb_server, $adodb_user, $adodb_pass, $adodb_name);

    $result = $db->Execute("delete from running_vnet");
    return true;
}

function db_create_vm($vmid) {
    global $adodb_type, $adodb_server, $adodb_user, $adodb_pass, $adodb_name;
    $db = NewADOConnection($adodb_type);
    $db->Connect($adodb_server, $adodb_user, $adodb_pass, $adodb_name);

    $result = $db->Execute("insert into running_vm values(?,?)",array(NULL,$vmid));
    return true;
}
function db_getall_vm() {
    global $adodb_type, $adodb_server, $adodb_user, $adodb_pass, $adodb_name;
    $db = NewADOConnection($adodb_type);
    $db->Connect($adodb_server, $adodb_user, $adodb_pass, $adodb_name);

    $result = $db->GetAll("select vmID from running_vm");
    return $result;
}
function db_removeall_vm() {
    global $adodb_type, $adodb_server, $adodb_user, $adodb_pass, $adodb_name;
    $db = NewADOConnection($adodb_type);
    $db->Connect($adodb_server, $adodb_user, $adodb_pass, $adodb_name);

    $result = $db->Execute("delete from running_vm");
    return true;
}

function db_create_user($userid) {
    global $adodb_type, $adodb_server, $adodb_user, $adodb_pass, $adodb_name;
    $db = NewADOConnection($adodb_type);
    $db->Connect($adodb_server, $adodb_user, $adodb_pass, $adodb_name);

    $result = $db->Execute("insert into user values(?,?)",array(NULL,$userid));
    return true;
}
function db_getall_user() {
    global $adodb_type, $adodb_server, $adodb_user, $adodb_pass, $adodb_name;
    $db = NewADOConnection($adodb_type);
    $db->Connect($adodb_server, $adodb_user, $adodb_pass, $adodb_name);

    $result = $db->GetAll("select userID from user");
    return $result;
}
function db_removeall_user() {
    global $adodb_type, $adodb_server, $adodb_user, $adodb_pass, $adodb_name;
    $db = NewADOConnection($adodb_type);
    $db->Connect($adodb_server, $adodb_user, $adodb_pass, $adodb_name);

    $result = $db->Execute("delete from user");
    return true;
}
function db_create_acl($aclid) {
    global $adodb_type, $adodb_server, $adodb_user, $adodb_pass, $adodb_name;
    $db = NewADOConnection($adodb_type);
    $db->Connect($adodb_server, $adodb_user, $adodb_pass, $adodb_name);

    $result = $db->Execute("insert into acl values(?,?)",array(NULL,$aclid));
    return true;
}
function db_getall_acl() {
    global $adodb_type, $adodb_server, $adodb_user, $adodb_pass, $adodb_name;
    $db = NewADOConnection($adodb_type);
    $db->Connect($adodb_server, $adodb_user, $adodb_pass, $adodb_name);

    $result = $db->GetAll("select aclID from acl");
    return $result;
}
function db_removeall_acl() {
    global $adodb_type, $adodb_server, $adodb_user, $adodb_pass, $adodb_name;
    $db = NewADOConnection($adodb_type);
    $db->Connect($adodb_server, $adodb_user, $adodb_pass, $adodb_name);

    $result = $db->Execute("delete from acl");
    return true;
}
?>