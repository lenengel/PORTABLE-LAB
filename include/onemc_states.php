<?php

$host_state[0] = "init";
$host_state[1] = "on"; // The host is being monitored.
$host_state[2] = "on"; // The host has been successfully monitored.
$host_state[3] = "err";
$host_state[4] = "off";

$vm_state[0] = "init";
$vm_state[1] = "pending";
$vm_state[2] = "hold";
$vm_state[3] = "active";
$vm_state[4] = "stopped";
$vm_state[5] = "suspended";
$vm_state[6] = "done";
$vm_state[7] = "failed";

$lcm_state[0] = "init";
$lcm_state[1] = "prolog";
$lcm_state[2] = "boot";
$lcm_state[3] = "running";
$lcm_state[4] = "migrate";
$lcm_state[5] = "save stop";
$lcm_state[6] = "save suspend";
$lcm_state[7] = "save migrate";
$lcm_state[8] = "prolog migrate";
$lcm_state[9] = "prolog resume";
$lcm_state[10] = "epilog stop";
$lcm_state[11] = "epilog";
$lcm_state[12] = "shutdown";
$lcm_state[13] = "cancel";
$lcm_state[14] = "failure";
$lcm_state[15] = "delete";
$lcm_state[16] = "unknown";

?>
