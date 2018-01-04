<?php
global $user;
	
if ( (!in_array("administrator", $user->roles)) || (!in_array("library-hours", $user->roles)) ) {
	drupal_goto("/admin");
}

$today = $_GET['date'];

?>