<?php
//remove trailing slash from uri
if( ($_SERVER['REQUEST_URI'] != "/") and preg_match('{/$}',$_SERVER['REQUEST_URI']) ) {
    header ('Location: '.preg_replace('{/$}', '', $_SERVER['REQUEST_URI']));
    exit();
}
      $field_format[] = "field_event_format";
      $field_open_to[] = "field_event_type";
      $field_category[] = "field_event_category";
      $field_series[] = "field_event_series";
      $field_sponsor[] = "field_event_unit";

	if ($_GET['events_date_start']==""){
	  $events_date_start = "";
	  }
	if ($_GET['events_date_end']==""){
	  $events_date_end = "";
	  }
	  if ($_GET['terms']<>""){
	  $terms = $_GET['terms'];
	  }
	  if ($_GET['terms']==""){
	  $terms = "";
	  }
	  if ($_GET['format']<>""){
	  $format = $_GET['format'];
	  }
	  if ($_GET['format']==""){
	  $format = "";
	  }
	  if ($_GET['open_to']<>""){
	  $open_to = $_GET['open_to'];
	  }
	  if ($_GET['open_to']==""){
	  $open_to = "";
	  }
	  if ($_GET['series']<>""){
	  $series = $_GET['series'];
	  }
	  if ($_GET['series']==""){
	  $series = "";
	  }
	  if ($_GET['category']<>""){
	  $category = $_GET['category'];
	  }
	  if ($_GET['category']==""){
	  $category = "";
	  }
	  if ($_GET['sponsor']<>""){
	  $sponsor = $_GET['sponsor'];
	  }
	  if ($_GET['sponsor']==""){
	  $sponsor = "";
	  }
	  if ($_GET['page']<>""){
	  $page = $_GET['page'];
	  }
	  if ($_GET['page']==""){
	  $page = "1";
	  }

	  if ($_GET['order']<>""){
	  $order = $_GET['order'];
	  }
	  if ($_GET['order']==""){
	  $order = "DATE_ASC";
	  }

$do_ajax=TRUE;
if ( ($date=="")&&($terms=="")&&($format=="")&&($open_to=="")&&($series=="")&&($category=="")&&($sponsor=="")&&($page=="") ){
$do_ajax=FALSE; search_results();
}



drupal_add_library('system', 'ui.datepicker');
drupal_add_js("(function ($) { $('.datepicker').datepicker(); })(jQuery);", array('type' => 'inline', 'scope' => 'footer', 'weight' => 5));
?>

<div class="sidebar-content" id="events-sidebar">
<div class="region region-sidebar">
<div class="section">
<div class="block block-views contextual-links-region">
<div class="inner clearfix gutter">
<div class="inner-wrapper">
<div class="inner-inner">
<div id="show_hide_filters">
  <div id="show_filters">show event filters</div>
  <div id="hide_filters">hide event filters</div>
</div>
<div id="filter_divisions">
  <div class="filter-division"><?php block_format("Format","events",$field_format); ?></div>
  <div class="filter-division"><?php block_format("Sponsor","events",$field_sponsor); ?></div>
  <div class="filter-division"><?php block_format("Open To","events",$field_open_to); ?></div>
  <div class="filter-division"><?php block_format("Category","events",$field_category); ?></div>
  <div class="filter-division"><?php block_format("Series","events",$field_series); ?></div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="primary-content-063">
<section class="all-purpose-detail pane contextual-links-region">

<h1 class="page-title">Events at GW Libraries</h1>

<p id="events_current_past">
<!--
<span id="search_count"></span> upcoming events at GW Libraries. Looking for an older event? Check out our <a href="/news-events/past-events">archives of past events</a>.
-->
<span id="search_count"></span> events at GW Libraries.
</p>

<div id="events_search_and_sort">
<form name="eventsForm" id="eventsForm" >
  <div id="order_sort">
    <label for="order">Sort by:</label>
    <select name="order" id="order" onchange="do_ajax();" >
      <option value="DATE_ASC" <?php if ($order=="DATE_ASC") {echo $select;} ?> >Date (first to last)</option>
      <option value="DATE_DESC" <?php if ($order=="DATE_DESC") {echo $select;} ?> >Date (last to first)</option>
      <option value="TITLE_ASC" <?php if ($order=="TITLE_ASC") {echo $select;} ?> >Title (A-Z)</option>
      <option value="TITLE_DESC" <?php if ($order=="TITLE_ASC") {echo $select;} ?> >Title (Z-A)</option>
    </select>
  </div>
  <input type="text" id="terms" name="terms" value="<?php echo $terms; ?>" placeholder="Search by keyword" value="">
  <input type="hidden" value="<?php echo $format; ?>" name="format" id="format">
  <input type="hidden" value="<?php echo $open_to; ?>" name="open_to" id="open_to">
  <input type="hidden" value="<?php echo $sponsor; ?>" name="sponsor" id="sponsor">
  <input type="hidden" value="<?php echo $category; ?>" name="category" id="category">
  <input type="hidden" value="<?php echo $series; ?>" name="series" id="series">
  <input type="hidden" value="<?php echo $format; ?>" name="room" id="room">
  <input type="hidden" value="<?php echo $page; ?>" name="page" id="page">
  <input type="text" class="datepicker" name="events_date_start" id="events_date_start" value="<?php echo $events_date_start; ?>" placeholder="Start Date" readonly size="10">
  <input type="text" class="datepicker" name="events_date_end" id="events_date_end" value="<?php echo $events_date_end; ?>" placeholder="End Date" readonly size="10">
  <input type="button" id="submitForm" value="Search">
  <input type="button" id="clearDate" value="Clear Date">

</form>
</div>
<div id="filters" class="filters">
<div id="filter_remove" style="display:none"></div>
<div id="filter_terms" style="display:none"></div> 
<div id="filter_date_range" style="display:none"></div> 
<div id="filter_format" style="display:none"></div> 
<div id="filter_sponsor" style="display:none"></div> 
<div id="filter_open_to" style="display:none"></div> 
<div id="filter_category" style="display:none"></div> 
<div id="filter_series" style="display:none"></div>
</div>
<!--<div id="search_sql"></div>-->
<div id="search_results"></div>
<div id="pagination">
</div>
</section>
<section id="section_send_email">
<div id="div_send_email">
<div id="label_share_results">Share Results</div>
<form id="form2" name="form2" onclick="return false;" style="display:none;">
<div>
<input type="text" id="email" name="email" placeholder="Email">
</div>
<div id="url_to_copy">
<input id="url" name="url" readonly > <i class="fa fa-copy fa-lg" id="copy" title="Copy to clipboard"></i>
</div>
<button id="send_results">Send Results</button>
</form>
</section>
</div>

<?php if ($do_ajax){?>
<script>
do_ajax();
</script>	
<?php } ?>
