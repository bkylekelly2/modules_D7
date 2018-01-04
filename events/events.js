jQuery( document ).ready(function() {
"use strict";
var reset_page = 1;
	
jQuery('#copy').on('click', function(){
jQuery( "#form2" ).show();
jQuery("input#url").select();
 document.execCommand('copy');
});
	
jQuery('#label_share_results').on('click', function(){
jQuery( "#form2" ).show();
});


jQuery("#show_filters").on("click", function() {
  jQuery(this).hide();
  jQuery("#hide_filters").show();
  jQuery("#filter_divisions").show();
});
jQuery("#hide_filters").on("click", function() {
  jQuery(this).hide();
  jQuery("#show_filters").show();
  jQuery("#filter_divisions").hide();
});
	
//jQuery( "#terms" ).addClass("terms").focus();
	
jQuery('#terms').on('blur', function(){
   jQuery(this).removeClass('terms_focus').addClass('terms_blur');
}).on('focus', function(){
  jQuery(this).removeClass('terms_blur').addClass('terms_focus');
});
	
	var emailData = jQuery( "form[name='form2']" );
	var emailDataEmail = jQuery( "form[name='form2'] #email" );
	var emailDataURL = jQuery( "form[name='form2'] #url" );
	
jQuery(emailDataEmail).on('blur', function(){
   jQuery(this).removeClass('error');
});	
jQuery(emailDataURL).on('blur', function(){
   jQuery(this).removeClass('error');
});
	//show the initial filters and highlights, if any
	show_filters_and_highlights();

	
jQuery('#send_results').on('mousedown', function(){
	
	if (emailDataEmail.val()===""){
		alert("You must enter an email address!");
		emailDataEmail.addClass("error").focus();
		return false;
	}
	if (emailDataURL.val()===""){
		alert("You must have an URL to share!");
		emailDataURL.addClass("error").focus();
		return false;
	}
	
	var urlemail = "events/send_email";
	jQuery.ajax({
	  async:false,
	  type: "POST",
	  url: urlemail,
	  data:emailData.serializeArray(),
	  cache: false,
	  success: function(data){
		 alert(data);
	  }
	});
	
	jQuery( "#form2" ).hide();
	
});
	
jQuery('#pagination').on('click', 'ul.page_numbers li', function(){
	var page_number = jQuery(this).data('value');
	reset_page_count(page_number);
	jQuery( "li.active_page" ).removeClass("active_page");
	jQuery(this).addClass("active_page");

	do_ajax();
	jQuery('html,body').animate({scrollTop: jQuery("#events_current_past").offset().top - jQuery("#secondary-nav").innerHeight() }, 500);
});
	
jQuery('#pagination').on('click', '#next', function(){
	var increment_page = parseInt(jQuery("#page").val());
	increment_page = (increment_page+1);
	reset_page_count(increment_page);

do_ajax();
    jQuery('html,body').animate({scrollTop: jQuery("#events_current_past").offset().top - jQuery("#secondary-nav").innerHeight() }, 500);
});
	
jQuery('#pagination').on('click', '#previous', function(){
	var decrement_page = parseInt(jQuery("#page").val());
	decrement_page = (decrement_page-1);
    reset_page_count(decrement_page);
do_ajax();
    jQuery('html,body').animate({scrollTop: jQuery("#events_current_past").offset().top - jQuery("#secondary-nav").innerHeight() }, 500);
});

jQuery('#terms').keypress(function (e) {
  if (e.which === 13) {

	if(jQuery.trim(jQuery("#terms").val())!==''){
			jQuery("#filter_terms").html(jQuery('#terms').val());
			jQuery("#filter_terms").show();
	} else {
		jQuery("#filter_terms").hide();					
        	jQuery( "form[name='eventsForm'] #terms" ).val("");
	}
	
	reset_page_count(reset_page);
	do_ajax();
  }
	
});

	
jQuery("#events_date_end, #events_date_start").on("change", function() {

	var startVal = jQuery("#events_date_start").val();
	var endVal = jQuery("#events_date_end").val();
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
		} else {
			jQuery("#filter_date_range").html(startVal + " to " + endVal);
			jQuery("#filter_date_range").show();
			reset_page_count(reset_page);
	        do_ajax();
		}
	} else {
		if (startVal === "") {
			jQuery("#events_date_start").val(endVal);

		} else {
			jQuery("#events_date_end").val(startVal);
		}
	}
  

});




jQuery( "#filter_remove" ).click(function() {
	jQuery( "#eventsForm input[type=hidden], #terms, #events_date_start, #events_date_end" ).each(function() {
		jQuery( this ).text("").val("");
	});

	jQuery( "#order option[value='DATE_ASC']" ).prop('selected', true);	
	jQuery( "#filters div" ).each(function() {
		jQuery( this ).hide();
	});

	jQuery( ".field_block li" ).removeClass('highlighted');
    
	reset_page_count(reset_page);
	do_ajax();

});


	
jQuery( ".show_fewer" ).click(function() {
  var field_block = jQuery(this).closest(".field_block");
  field_block.find( ".show_fewer" ).hide();  
  field_block.find( ".show_more" ).show();  
  field_block.find( ".items_to_hide" ).slideUp(500);
});
	
jQuery( ".show_more" ).click(function() {
  var field_block = jQuery(this).closest(".field_block");
  field_block.find( ".show_more" ).hide();  
  field_block.find( ".show_fewer" ).show();  
  field_block.find( ".items_to_hide" ).slideDown(500);

});

jQuery( ".field_block li" ).click(function() {
 var field_block = jQuery(this).closest('.field_block');


  if(field_block.find('li.highlighted').length===1){
  field_block.find('li').removeClass('highlighted');
  }
jQuery(this).addClass( "highlighted" );
	
var form_field_block_id =  jQuery(this).data("id");
var form_field_block_value1 =  jQuery(this).data("value1");
var form_field_block_value2 =  jQuery(this).data("value2");
	
jQuery( "form[name='eventsForm'] #"+ field_block.data("id") ).val(form_field_block_value1);

/* show the filters */
if (form_field_block_id==="format"){
	jQuery("#filter_format").html(form_field_block_value2);
	jQuery("#filter_format").show();
}
if (form_field_block_id==="sponsor"){
	jQuery("#filter_sponsor").html(form_field_block_value2);
	jQuery("#filter_sponsor").show();
}
if (form_field_block_id==="open_to"){
	jQuery("#filter_open_to").html(form_field_block_value2);
	jQuery("#filter_open_to").show();
}
if (form_field_block_id==="category"){
	jQuery("#filter_category").html(form_field_block_value2);
	jQuery("#filter_category").show();
}
if (form_field_block_id==="series"){
	jQuery("#filter_series").html(form_field_block_value2);
	jQuery("#filter_series").show();
}

// If clicking below the fold, scroll up to the top of the search form
if (jQuery("#events_current_past").offset().top < jQuery(window).scrollTop()) {
    jQuery('html,body').animate({scrollTop: jQuery("#events_current_past").offset().top - jQuery("#secondary-nav").innerHeight() }, 500);
}

//run ajax function
	reset_page_count(reset_page);
	do_ajax();
});

/* hide the filters and remove highlight */
jQuery( "#filter_terms" ).click(function() {
	jQuery("#filter_terms").hide();

jQuery( "form[name='eventsForm'] #terms" ).val("");

//run ajax function
	reset_page_count(reset_page);
	do_ajax();});
jQuery( "#filter_date_range" ).click(function() {
	jQuery("#filter_date_range").hide();

jQuery( "form[name='eventsForm'] #events_date_start" ).val("");
jQuery( "form[name='eventsForm'] #events_date_end" ).val("");

//run ajax function
	reset_page_count(reset_page);
	do_ajax();});
jQuery( "#filter_format" ).click(function() {
	jQuery("#filter_format").hide();
 
if(jQuery("#field_block_format").find('li.highlighted').length===1){
  jQuery("#field_block_format").find('li').removeClass('highlighted');
}
	
jQuery( "form[name='eventsForm'] #format" ).val("");

//run ajax function
	reset_page_count(reset_page);
	do_ajax();
});
jQuery( "#filter_category" ).click(function() {
	jQuery("#filter_category").hide();

if(jQuery("#field_block_category").find('li.highlighted').length===1){
  jQuery("#field_block_category").find('li').removeClass('highlighted');
}
	
jQuery( "form[name='eventsForm'] #category" ).val("");

//run ajax function
	reset_page_count(reset_page);
	do_ajax();});
jQuery( "#filter_sponsor" ).click(function() {
jQuery("#filter_sponsor").hide();


if(jQuery("#field_block_sponsor").find('li.highlighted').length===1){
  jQuery("#field_block_sponsor").find('li').removeClass('highlighted');
}

jQuery( "form[name='eventsForm'] #sponsor" ).val("");

//run ajax function
	reset_page_count(reset_page);
	do_ajax();
});
jQuery( "#filter_open_to" ).click(function() {
jQuery("#filter_open_to").hide();


if(jQuery("#field_block_open_to").find('li.highlighted').length===1){
  jQuery("#field_block_open_to").find('li').removeClass('highlighted');
}

jQuery( "form[name='eventsForm'] #open_to" ).val("");

//run ajax function
	reset_page_count(reset_page);
	do_ajax();
});
jQuery( "#filter_series" ).click(function() {
	jQuery("#filter_series").hide();


if(jQuery("#field_block_series").find('li.highlighted').length===1){
  jQuery("#field_block_series").find('li').removeClass('highlighted');
}

jQuery( "form[name='eventsForm'] #series" ).val("");

//run ajax function
	reset_page_count(reset_page);
	do_ajax();
});
	
jQuery( "#submitForm" ).click(function() {

    if(jQuery('#terms').val().trim()===""){
		jQuery("#filter_terms").hide();					
		jQuery( "form[name='eventsForm'] #terms" ).val("");
	} else {
		jQuery("#filter_terms").html(jQuery("#terms").val());
		jQuery("#filter_terms").show();
	}
	
	var startVal = jQuery("#events_date_start").val();
	var endVal = jQuery("#events_date_end").val();
	var startArray = startVal.split("/");
	var startYear = startArray.pop();
	startArray.unshift(startYear);
	var startVal2 = startArray.join("");
	var endArray = endVal.split("/");
	var endYear = endArray.pop();
	endArray.unshift(endYear);
	var endVal2 = endArray.join("");
	if ( (startVal2!=="") && (endVal2!=="") ) {
	jQuery("#filter_date_range").html(startVal + " to " + endVal);
	jQuery("#filter_date_range").show();
	}
	
  jQuery( "#terms" ).focus();
	reset_page_count(reset_page);
	do_ajax();	 
});
	
});

function do_ajax(){
"use strict";
	
var formData = jQuery( "form[name='eventsForm']" );
	
var url = "events/results";
jQuery.ajax({
  async:false,
  type: "POST",
  url: url,
  data:formData.serializeArray(),
  cache: false,
  success: function(data){
     jQuery("#search_results").html(data);
  }
});
	
var url1 = "events/count";
jQuery.ajax({
  async:false,
  type: "POST",
  url: url1,
  data:formData.serializeArray(),
  cache: false,
  success: function(data){
     jQuery("#search_count").html( data );
  }
});
	
var url2 = "events/sql";
jQuery.ajax({
  async:false,
  type: "POST",
  url: url2,
  data:formData.serializeArray(),
  cache: false,
  success: function(data){
     jQuery("#search_sql").html(data);
  }
});
	
var url3 = "events/pagination";
jQuery.ajax({
  async:false,
  type: "POST",
  url: url3,
  data:formData.serializeArray(),
  cache: false,
  success: function(data){
     jQuery("#pagination").html(data);
  }
});
	
var url4 = "events/build_url";
jQuery.ajax({
  async:false,
  type: "POST",
  url: url4,
  data:formData.serializeArray(),
  cache: false,
  success: function(data){
     build_url(data);
  }
});


/*
jQuery(".field_block li").each(function() {
	var newcount = jQuery(this).find(".filter-count");
	var datavalue1 = jQuery(this).data("value1");
	
	get_count(newcount,datavalue1);
});
*/	
	
get_url();
count_filters();
show_terms_filters();
}

 function build_url(data){
  "use strict";
	 var newTitle = "Events | GWU Libraries";
	 document.title = newTitle;
	 window.history.pushState(null, newTitle, data);
 }

function reset_filter_count(count){
	"use strict";
	jQuery( "#filter_count" ).val(count);
}

function reset_page_count(page){
	"use strict";
	jQuery( "form[name='eventsForm'] #page" ).val(page);
}

function count_filters(){
	"use strict";
	if(jQuery("#filters div:visible:not(#filter_remove)").length >= 2) { 
	jQuery("#filter_remove").html("Remove All Filters");
	jQuery("#filter_remove").show();
	} else {
		jQuery("#filter_remove").hide();
	}
}
function GetTodayDate() {
	"use strict";
   var tdate = new Date();
   var dd = tdate.getDate(); //yields day
   var MM = tdate.getMonth(); //yields month
   var yyyy = tdate.getFullYear(); //yields year
   var currentDate= (MM+1) + "/" + dd + "/" + yyyy;

   return currentDate;
}

function get_url(){
	"use strict";
	var url      = window.location.href;     // Returns full URL
	jQuery( "#url" ).val(url);
}

function show_filters_and_highlights(){
	"use strict";
	
var urlParams = new URLSearchParams(window.location.search);
	
/* show the filters and add highlighted*/
jQuery(".field_block").each(function() {
	var which_filter = jQuery(this).data("id");//format
	var which_param = urlParams.get(which_filter);//lecture
	if (which_param!==""){
		//if (which_filter.data("value1")===which_filter){
			var pretty = jQuery("li[data-value1="+which_param+"]").data("value2");
		//}

	jQuery("#filter_"+which_filter).html(pretty);
	jQuery("#filter_"+which_filter).show();
	}
	jQuery( ".filter_"+which_filter).each(function() {
		if (jQuery( this ).data("value1")===which_param){
 			jQuery(this).addClass('highlighted');		
		}
	});

});

if (jQuery("#terms").val()!=="") {
  jQuery("#filter_terms").html(jQuery("#terms").val());
  jQuery("#filter_terms").show();
}
				 
if ( (jQuery("#events_date_start").val()!=="") && (jQuery("#events_date_end").val()!=="") ) {
  jQuery("#filter_date_range").html(jQuery("#events_date_start").val()+" to " +jQuery("#events_date_end").val());
  jQuery("#filter_date_range").show();
}
				 
count_filters();			 
}

function get_count(newcount,datavalue1){
	
	
	"use strict";
	var formData = jQuery( "form[name='eventsForm']" );

	var url1 = "events/rowcount";
	jQuery.ajax({
	  async:false,
	  type: "POST",
	  url: url1,
	  data:formData.serializeArray(),
	  cache: false,
	  success: function(data){
		 jQuery(newcount).html( data );
	  }
	});
	
}

function show_terms_filters(){
"use strict";
	if (jQuery("#terms").val()!==""){
		jQuery("#filter_terms").html(jQuery('#terms').val());
		jQuery("#filter_terms").show();
	}
}