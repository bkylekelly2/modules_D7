<?php
global $user;
	
if ( (!in_array("administrator", $user->roles)) && (!in_array("libraryhours", $user->roles)) ) {
	drupal_goto("/admin");
}

$nid = $_GET['nid'];

$node=get_node($nid);
$title = $node['title'];
$sectionKey = $node['field_section']['und'][0]['value'];
$sectionarr[0] = "field_section";
$sectionarr2 = field_info_field($sectionarr[0]);
foreach($sectionarr2[settings][allowed_values] as $key => $value){
	if ($sectionKey==$key){ $section = $value; }
}	

$start = date("l F j, Y", strtotime($node['field_period_dates']['und'][0]['value']));
$end = date("l F j, Y", strtotime($node['field_period_dates']['und'][0]['value2']));

$body = $node['body']['und'][0]['value'];
$exception = $node['field_special_hours']['und'][0]['value'];


?>

	
	
<div id="div_display_hours_details" >

<div><?php echo $title; ?></div>
<div><?php echo $section; ?></div>
<div><?php echo $period[1]; ?></div>
<div><?php echo $holiday; ?></div>
<div><?php echo $start; ?> to <?php echo $end; ?></div>
<div><?php echo $body; ?> </div>


<div style="margin-top:20px;">

<?php if ($exception=="Yes"){
view_exception_hours($nid);
} 
	
if ($exception=="No"){
echo view_non_exception_hours($nid);	
}
	

?> 

</div>
		
</div>