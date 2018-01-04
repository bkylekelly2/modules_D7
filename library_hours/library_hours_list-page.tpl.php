<?php
global $user;
	
if ( (!in_array("administrator", $user->roles)) && (!in_array("libraryhours", $user->roles)) ) {
	drupal_goto("/admin");
}

$node_deleted = $_GET['node_deleted'];
$title = $_GET['title'];

?>

<?php if ($node_deleted=="Yes"){ ?>
<div id="div_node_deleted" class="messages status"><?php echo $title; ?> has been deleted!</div>
<?php } ?>
<label for="divformfilterLibraryHours">Filter Hours</label>
<div id="divformfilterLibraryHours" class="box">
	
	<form id="formfilterLibraryHours" name="formfilterLibraryHours" onclick="return false;">
		
		<div id="div_filter_title" name="div_filter_title"><label for="title">Title</label>
		<div class="description">Filter By Title</div>
		<input type="hours_by_text" id="hours_by_title" name="hours_by_title" value="" size="40">
		</div>
		
		<div id="div_filter_sections" name="div_filter_sections" class="div-margin">
		<label for="section">Section</label>
		<div class="description">Filter by Section</div>
		<select name="hours_by_section">
		<?php echo get_sections(); ?>
		</select>
		</div>
			
	<div id="div_filter_date" name="div_filter_date" class="div-margin">
	<label for="default">Date Filter</label>
   <div class="description">Filter by Date? You can filter by one or both dates.</div>
   <div>
   <input type="text" name="hours_by_date_start" id="hours_by_date_start" class="datepicker" value="">
   <input type="text" name="hours_by_date_end" id="hours_by_date_end" class="datepicker" value="">
   </div>
    </div>

    <div id="div_filter_button" name="div_filter_button" class="div-margin">
    <span>
    <button id="btnHoursSearch">Search</button>
    <button id="btnHoursReset">Reset</button>
    </span>
    </div>
 	<input type="hidden" id="hours_by_default" name="hours_by_default" value="0">
   
	</form>
	
</div>



<div id="div_display_list_of_hours" >
<div id="LibraryHoursResults"></div>
</div>