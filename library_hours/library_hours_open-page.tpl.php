<?php
global $user;
	
if ( (!in_array("administrator", $user->roles)) && (!in_array("libraryhours", $user->roles)) ) {
	drupal_goto("/admin");
}

?>
<label for="divformfilterOpenLibraryHours">Filter Open Hours</label>
<div id="divformfilterOpenLibraryHours" class="box">
	
	<form id="formfilterOpenLibraryHours" name="formfilterOpenLibraryHours" onclick="return false;">
		
	
	<div id="div_filter_date_open" name="div_filter_date_open" class="div-margin">
	<label for="default">Date Filter</label>
   <div class="description">Filter by Date. Leaving the date empty will return today's date.</div>
   <div>
   <input type="text" name="hours_open_by_date" id="hours_open_by_date" class="datepicker" value="">
   </div>
    </div>

    <div id="div_filter_button_open" name="div_filter_button_open" class="div-margin">
    <span>
    <button id="btnHoursOpen">Search</button>
    </span>
    </div>
    
	</form>
	
</div>



<div id="div_display_list_of_hours" >
<div id="LibraryHoursOpenResults"></div>
</div>