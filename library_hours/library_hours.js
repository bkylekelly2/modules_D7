jQuery( document ).ready(function() {
"use strict";
	
	jQuery("#btnHoursReset").on("mousedown", function(){
		window.location.href="/library-hours/list?show=non_default";
    });
	
	jQuery("#btnHoursSearch").on("mousedown", function(){
        do_hours_filter();
    });
	
	jQuery("#btnHoursOpen").on("mousedown", function(){
        do_open();
    });
	
    jQuery("body").on("focus", ".timepicker", function(){
        jQuery(this).timepicker();
    });
    jQuery("body").on("focus", ".datepicker", function(){
        jQuery(this).datepicker();
    });
	
	var nid = jQuery("#nid").val();
	
		var special_hours = jQuery('#special_hours');
	
	if (window.location.href.indexOf("edit") >= 0) {
		get_special_hours(special_hours,nid);
	}
	
	var select_special = '<div class="datepair"><input type="text" name="exception_hours[1][]" class="datepicker" placeholder="Date" /> <input type="text" class="timepicker" name="exception_hours[2][]" placeholder="Hours Start" /> to <input type="text" class="timepicker" name="exception_hours[3][]" placeholder="Hours End"  /><select name="exception_hours[4][]"><option value="open">Open</option><option value="closed">Closed</option><option value="appointment">By Appointment Only</option></select><input type="text" name="exception_hours[5][]" placeholder="Public Comments"  /><a href="#" class="remove_field">Remove</a></div>';
	
jQuery('#button_confirm_delete_yes').on('click', function(){

var deletenid = jQuery( "#confirm_delete_nid" ).val();
var urldelete = "/library-hours/delete?nid_to_delete="+deletenid;
window.location = urldelete;	
	
});
	
jQuery('#button_confirm_delete_no').on('click', function(){

var deletenid = jQuery( "#confirm_delete_nid" ).val();
var returntoview = "/library-hours/view?nid="+deletenid;
window.location = returntoview;	
	
});
jQuery("#hours_date_end, #hours_date_start").on("change", function() {

	var startVal = jQuery("#hours_date_start").val();
	var endVal = jQuery("#hours_date_end").val();
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


jQuery('form[name=hoursform] #submit_hours_form').on('mousedown', function(){
	var error = false;
	
	var nodeid = jQuery("#nid").val();
	
	
	if (jQuery("#hours_title").val()===""){
		jQuery("#hours_title").addClass("error");
		error = true;
	}
	/**/
	if (jQuery("#hours_date_start").val()===""){
		jQuery("#hours_date_start").addClass("error");
		error = true;
	}	
	if (jQuery("#hours_date_end").val()===""){
		jQuery("#hours_date_end").addClass("error");
		error = true;
	}
	
	if (jQuery("#hours_section").val()===""){
		jQuery("#hours_section").addClass("error");		
		error = true;
	}
	
	if (jQuery("#special_hours").val()===""){
		jQuery("#special_hours").addClass("error");		
		error = true;
	}
	
	
		if (error===true){
			alert("You have errors in your form!");
			return false;
		}

		if (error===false){
			jQuery("#hoursform").submit();
		}

	
});

    var max_fields      = 1000; //maximum input boxes allowed
    var wrapper         = jQuery(".input_fields_wrap"); //Fields wrapper
    var wrapper2        = jQuery(".input_fields_wrap2"); //Fields wrapper
    var add_button      = jQuery(".add_field_button"); //Add button ID
	
   var x = 1; //initlal text box count
    jQuery(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
         jQuery(wrapper).append(select_special); //add fields
        }
    });
    
    jQuery(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); jQuery(this).parent('div').remove(); x--;
    });
    
   jQuery(wrapper2).on("click",".remove_field2", function(e){ //user click on remove text
        e.preventDefault(); jQuery(this).parent("div").remove();
    });
	
jQuery('#special_hours').on('change', function(){
	
	get_special_hours(special_hours,nid);
	
});
	
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
			jQuery("#date_start").val(endVal);

		} else {
			jQuery("#date_end").val(startVal);
		}
	}
});
	
	
});

function do_open(){
"use strict";
	
var openData = jQuery( "form[name='formfilterOpenLibraryHours']" );
	
var urlopen = "/library-hours/open-results";
jQuery.ajax({
  async:false,
  type: "POST",
  url: urlopen,
  data:openData.serializeArray(),
  cache: false,
  success: function(data){
	  jQuery("#LibraryHoursOpenResults").html(data);
  }
});
	
}

function do_create(){
"use strict";
	
var createData = jQuery( "form[name='hoursform']" );
	
var url1 = "/library-hours/submit_create";
jQuery.ajax({
  async:false,
  type: "POST",
  url: url1,
  data:createData.serializeArray(),
  cache: false,
  success: function(data){
var urlsuccess = "/library-hours/view?nid="+data;
  window.location = urlsuccess;
  }
});
	
}

function do_edit(){
"use strict";
	
var editData = jQuery( "form[name='hoursform']" );
	
var url2 = "/library-hours/submit_edit";
jQuery.ajax({
  async:false,
  type: "POST",
  url: url2,
  data:editData.serializeArray(),
  cache: false,
  success: function(data){
var urlsuccess = "/library-hours/view?nid="+data;
  window.location = urlsuccess;
  }
});
	
}
function do_hours_filter(){
"use strict";
var filterData = jQuery( "form[name='formfilterLibraryHours']" );
	
var urlHoursFilter = "/library-hours/filter";
jQuery.ajax({
  async:false,
  type: "POST",
  url: urlHoursFilter,
  data:filterData.serializeArray(),
  cache: false,
  success: function(data){
	  jQuery("#LibraryHoursResults").html(data);
  }
});
	
}

function do_fill_special_hours(nid){
"use strict";

	
var urlgetspecialhours = "/library-hours/current_special_hours?nid="+nid;
jQuery.post( urlgetspecialhours, function( data ) {
  jQuery( ".current_special_hours" ).html( data );
});
	
}



function get_special_hours(special_hours,nid){
	"use strict";
if (special_hours.val()==="Yes"){
	    do_fill_special_hours(nid);
		jQuery('#div_library_hours_special').show();
		jQuery('#div_library_hours').hide();
		jQuery('#div_body').hide();
	}
	if (special_hours.val()==="No"){
		jQuery('#div_library_hours_special').hide(); 		
		jQuery('#div_library_hours').show();
		jQuery('#div_body').show();
	}
	if (special_hours.val()===""){
		jQuery('#div_library_hours').hide();
		jQuery('#div_library_hours_special').hide();
		jQuery('#div_body').hide();
	}
}