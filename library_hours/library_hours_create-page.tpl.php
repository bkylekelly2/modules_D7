<?php
global $user;
	
if ( (!in_array("administrator", $user->roles)) && (!in_array("libraryhours", $user->roles)) ) {
	drupal_goto("/admin");
}
$errors = $_GET['error'];
?>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
<div>
<?php if ($errors<>""){ ?>
<div id="div_errors" class="messages error"><?php echo $errors; ?></div>
<?php } ?>

<div id="div_display_hours_form_new" >
<?php get_hours_form(); ?>
</div>

	
</div>
