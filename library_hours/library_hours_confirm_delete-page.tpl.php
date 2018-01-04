<?php
global $user;
	
if ( (!in_array("administrator", $user->roles)) && (!in_array("libraryhours", $user->roles)) ) {
	drupal_goto("/admin");
}

$nid = $_GET['nid'];
$node = get_node($nid);
$title = $node['title'];

?>

<?php // get_library_hours_tabs(); ?>

<div id="div_confirm_delete" >
<h2>Confirm Delete</h2>
<p>Are you sure you want to delete <em><?php echo $title; ?></em>?</p>
<p>This action cannot be undone.</p>
<span id="div_confirm_delete_yes">
	<button id="button_confirm_delete_yes" value="Yes">Yes, delete</button>
</span>
<span id="div_confirm_delete_no">
	<button id="button_confirm_delete_no" value="No">No, dont delete!</button>
</span>
</div>
<form id="form_confirm_delete" name="form_confirm_delete">
	<input type="hidden" id="confirm_delete_nid" name="confirm_delete_nid" value="<?php echo $nid; ?>">
</form>
