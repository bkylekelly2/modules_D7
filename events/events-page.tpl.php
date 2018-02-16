<style>
body{
background-color:#ffffff;
height:100%;
}
#upcoming_events_filter{
background-color:#e5e5e5;
margin-left:10px;
color:#000000;
text-align:center;
}
#upcoming_events{
background-color:#e5e5e5;
margin-left:10px;
color:#000000;
text-align:left;
}
#upcoming_events img {
  padding: .5em;
  float: left;
}
#upcoming_events_misc{
background-color:#e5e5e5;
margin-left:10px;
color:#000000;
text-align:center;
margin-right:10px;
}
</style>

<script>
jQuery( document ).ready(function() {
  // Handler for .ready() called.
"use strict";	

	
  // Get some values from elements on the page:
  var url = "/search_events";
 
  // Send the data using post
  var posting = jQuery.get(url);
 
  // Put the results in a div
  posting.done(function( data ) {
    jQuery( "#display_events" ).html( data );
  });
	
jQuery( ".dateterm" ).click(function( event ) {
 
  // Stop form from submitting normally
  event.preventDefault();
 
  // Get some values from elements on the page:
  var url = "/search_events";
  var dateterm = jQuery(this).data("id");
 
  // Send the data using post
  var posting = jQuery.post( url, { dateterm: dateterm } );
 
  // Put the results in a div
  posting.done(function( data ) {
    jQuery( "#display_events" ).html( data );
  });
});
	
jQuery( "#search_events_Form" ).submit(function( event ) {
 
  // Stop form from submitting normally
  event.preventDefault();
 
  // Get some values from elements on the page:
  var $form = jQuery( this ),
    search = $form.find( "input[name='title']" ).val(),
    date_start = $form.find( "input[name='date_start']" ).val(),
    date_end = $form.find( "input[name='date_end']" ).val(),
    url = $form.attr( "action" );
 
  // Send the data using post
  var posting = jQuery.post( url, { title: search, date_start: date_start, date_end: date_end } );
 
  // Put the results in a div
  posting.done(function( data ) {
    jQuery( "#display_events" ).html( data );
  });
});	
	
    jQuery( ".datepicker" ).datepicker();
	
jQuery("#date_end, #date_start").on("change", function() {

	var startVal = jQuery("#date_start").val();
	var endVal = jQuery("#date_end").val();
	var startArray = startVal.split("/");
	var startYear = startArray.pop();
	startArray.unshift(startYear);
	var startVal2 = startArray.join("");
	var endArray = endVal.split("/");
	var endYear = endArray.pop();
	endArray.unshift(endYear);
	var endVal2 = endArray.join("");

	if (startVal !== "" && endVal !== "") {
		if (startVal2 > endVal2) {
			jQuery(this).val("");
			alert("End date must be later than (or same as) the start date");			
		} 
	} else {
		if (startVal === "") {
			jQuery("#hours_date_start").val(endVal);

		} else {
			jQuery("#hours_date_end").val(startVal);
		}
	}
  

});	
	

	
});
</script>
 <div class="row" style="height:100%;height:100vh;">
 
 <div class="col-sm-3">
 <div id="upcoming_events_filter">
 <h3>Upcoming Events</h3>
 <div class="dateterm" data-id="all" data-toggle="tooltip" data-placement="left" title="Get All Events">All</div>
 <div class="dateterm" data-id="today" data-toggle="tooltip" data-placement="left" title="Get All Today's Events">Today</div>
 <div class="dateterm" data-id="tomorrow" data-toggle="tooltip" data-placement="left" title="Get All Tomorrow's Events">Tomorrow</div>
 <div class="dateterm" data-id="week" data-toggle="tooltip" data-placement="left" title="Get All Events For This Week">This Week</div>
 <div class="dateterm" data-id="weekend" data-toggle="tooltip" data-placement="left" title="Get All Events This Weekend">This Weekend</a></div>
 <div class="dateterm" data-id="month" data-toggle="tooltip" data-placement="left" title="Get All Events This Month">This Month</a></div>
 </div>
 </div>
 
 <div class="col-sm-6">
 <div id="upcoming_events"><h3></h3>
 <div id="display_events"></div>
 </div>
 </div>
  
 <div class="col-sm-3">
 <form action="/search_events" id="search_events_Form">
<div id="upcoming_events_misc"><h3>Search</h3>
	  <input type="text" name="title" placeholder="Search..."  data-toggle="tooltip" data-placement="left" title="Enter Your Search Keyword Here">
	  <input type="hidden" name="dateterm" value="<?php echo $dateterm; ?>">
</div>
 <div id="upcoming_events_misc"><h3>Date Range</h3>
	  <input type="text" class="datepicker" id="date_start" name="date_start"  placeholder="Date Start" size="10" data-toggle="tooltip" data-placement="left" title="Select a starting date here. You can select only one date."/>
	  <input type="text" class="datepicker" id="date_end" name="date_end"  placeholder="Date End" size="10" data-toggle="tooltip" data-placement="left" title="If you select a start date, select your end date here."/>
</div>
<div id="div_search_button" style="margin-left:.5em;margin-top:1em;margin-right:.5em;"><input type="submit" value="Search" style="width:100%;"></div>
	</form>
 </div>
  
 </div>
