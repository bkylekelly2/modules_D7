<?php
global $user;
	
if ( (!in_array("administrator", $user->roles)) && (!in_array("libraryhours", $user->roles)) ) {
	drupal_goto("/admin");
}

$nid = $_GET['nid'];
$node = get_node($nid);
$errors = $_GET['error'];
$msg = $_GET['msg'];

?>

<div>
<?php if ($errors<>""){ ?>
<div id="div_errors" class="messages error"><?php echo $errors; ?></div>
<?php } ?>
<?php if ($msg<>""){ ?>
<div id="div_errors" class="messages status"><?php echo $msg; ?></div>
<?php } ?>
<div id="div_display_hours_form_edit" >
<?php get_hours_form($nid,$post); ?>
</div>

	
</div>
