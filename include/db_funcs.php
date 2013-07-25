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


function db_has_user_permission($user_name, $permission) {
    global $adodb_type, $adodb_server, $adodb_user, $adodb_pass, $adodb_name;
    $db = NewADOConnection($adodb_type);
    $db->Connect($adodb_server, $adodb_user, $adodb_pass, $adodb_name);

    $perm_id = $db->GetOne("select id from permissions where name = ?", array($permission));
    $result = $db->GetOne("select count(user_name) from user_permissions where user_name = ? and permissions_id = ?", array($user_name, $perm_id));
    if ($result > 0)
       return true;
    else
       return false;
    return false;
}
/*
function db_get_user_permissions($user_name) {
    global $adodb_type, $adodb_server, $adodb_user, $adodb_pass, $adodb_name;
    $db = NewADOConnection($adodb_type);
    $db->Connect($adodb_server, $adodb_user, $adodb_pass, $adodb_name);

    $perms = array();
    $result = $db->GetAll("select permissions_id from user_permissions where user_name = ?", array($user_name));
    foreach($result as $perms_id) {
        $perms[] = $db->GetOne("select name from permissions where id = ?", array($perms_id['permissions_id']));
    }

    return $perms;
}

function db_set_user_permission($user_name, $permission) {
    global $adodb_type, $adodb_server, $adodb_user, $adodb_pass, $adodb_name;
    $db = NewADOConnection($adodb_type);
    $db->Connect($adodb_server, $adodb_user, $adodb_pass, $adodb_name);

    $perm_id = $db->GetOne("select id from permissions where name = ?", array($permission));
    $result = $db->Execute("insert into user_permissions values(?,?)", array($user_name, $perm_id));

    return true;
}

function db_remove_user_permission($user_name, $permission) {
    global $adodb_type, $adodb_server, $adodb_user, $adodb_pass, $adodb_name;
    $db = NewADOConnection($adodb_type);
    $db->Connect($adodb_server, $adodb_user, $adodb_pass, $adodb_name);

    $perm_id = $db->GetOne("select id from permissions where name = ?", array($permission));
    $result = $db->Execute("delete from user_permissions where user_name = ? and permissions_id = ?", array($user_name, $perm_id));

    return true;
}

function db_get_permissions() {
    global $adodb_type, $adodb_server, $adodb_user, $adodb_pass, $adodb_name;
    $db = NewADOConnection($adodb_type);
    $db->Connect($adodb_server, $adodb_user, $adodb_pass, $adodb_name);

    $perms = array();
    $result = $db->GetAll("select name from permissions");
    foreach($result as $perm) {
        $perms[] = $perm['name'];
    }

    return $perms;
}

function db_create_template($user_name, $template_name, $template) {
    global $adodb_type, $adodb_server, $adodb_user, $adodb_pass, $adodb_name;
    $db = NewADOConnection($adodb_type);
    $db->Connect($adodb_server, $adodb_user, $adodb_pass, $adodb_name);

    $result = $db->Execute("insert into user_templates values(?,?,?)",array($user_name, $template_name, $template));
    return $result;
}

function db_get_user_template($user_name, $template_name) {
    global $adodb_type, $adodb_server, $adodb_user, $adodb_pass, $adodb_name;
    $db = NewADOConnection($adodb_type);
    $db->Connect($adodb_server, $adodb_user, $adodb_pass, $adodb_name);

    $result = $db->GetOne("select template from user_templates where user_name = ? and template_name = ?", array($user_name, $template_name));
    return $result;
}

function db_get_user_templates($user_name) {
    global $adodb_type, $adodb_server, $adodb_user, $adodb_pass, $adodb_name;
    $db = NewADOConnection($adodb_type);
    $db->Connect($adodb_server, $adodb_user, $adodb_pass, $adodb_name);

    $result = array();
    $result = $db->GetAll("select template_name, template from user_templates where user_name = ?", array($user_name));
    return $result;
}

function db_get_templates($user_name) {
    global $adodb_type, $adodb_server, $adodb_user, $adodb_pass, $adodb_name;
    $db = NewADOConnection($adodb_type);
    $db->Connect($adodb_server, $adodb_user, $adodb_pass, $adodb_name);

    $result = array();
    $result = $db->GetAll("select template_name, template from user_templates where user_name = ? or user_name = 'oneadmin'", array($user_name));
    return $result;
}

function db_remove_user_template($user_name, $template_name) {
    global $adodb_type, $adodb_server, $adodb_user, $adodb_pass, $adodb_name;
    $db = NewADOConnection($adodb_type);
    $db->Connect($adodb_server, $adodb_user, $adodb_pass, $adodb_name);

    $result = $db->Execute("delete from user_templates where user_name = ? and template_name = ?", array($user_name, $template_name));
    return $result;
}
 * 
 */

?>
