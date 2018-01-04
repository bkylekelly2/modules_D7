<?php
global $user; if (!$user->uid){
	drupal_goto("/admin");
}

$nid = $_GET['nid'];
$node=get_node($nid);
	
$hours = get_hours_array($nid);

//print_r($node);

$title = $node['title'];
  
$section = explode("|",$node['field_section']['und'][0]['value']);
$section = $section[1];	

$period = explode("|",$node['field_period']['und'][0]['value']);
$period = $period[1];	

$holiday = explode("|",$node['field_holiday']['und'][0]['value']);
$holiday = $holiday[1];	

$body = $node['body']['und'][0]['value'];
$start = explode(" ",$node['field_date_start']['und'][0]['value']);
$start = $start[0];
$end = explode(" ",$node['field_date_end']['und'][0]['value']);
$end = $end[0];

?>
<?php // get_library_hours_tabs($nid); ?>

<div id="div_display_hours_details" >
<!--
<div><?php echo $title; ?></div>
<div><?php echo $section; ?></div>
<div><?php echo $period; ?></div>
<div><?php echo $holiday; ?></div>
<div><?php echo $start; ?> to <?php echo $end; ?></div>
<div>Comments:<BR><?php echo $body; ?> </div>


	<?php if ($hours['m1sh']<>""){ ?>
	<div> Monday </div>
	
	<div><?php echo $hours['m1sh'].":".$hours['m1sm']."".$hours['m1sdp']; ?> - <?php echo $hours['m1eh'].":".$hours['m1em']."".$hours['m1edp']." ".$hours['m1ht']; ?> </div> 
	<?php if ($hours['m2sh']<>""){ ?>
	<div><?php echo $hours['m2sh'].":".$hours['m2sm']."".$hours['m2sdp']; ?> - <?php echo $hours['m2eh'].":".$hours['m2em']."".$hours['m2edp']." ".$hours['m2ht']; ?> </div>
	<?php } ?> 	<?php } ?>

	
	
	<?php if ($hours['t1sh']<>""){ ?>
	<div> Tuesday </div> 
	<div><?php echo $hours['t1sh'].":".$hours['t1sm']."".$hours['t1sdp']; ?> - <?php echo $hours['t1eh'].":".$hours['t1em']."".$hours['t1edp']." ".$hours['t1ht']; ?> </div>
	<?php if ($hours['t2sh']<>""){ ?>
	<div><?php echo $hours['t2sh'].":".$hours['t2sm']."".$hours['t2sdp']; ?> - <?php echo $hours['t2eh'].":".$hours['t2em']."".$hours['t2edp']." ".$hours['t2ht']; ?> </div>
	<?php } ?>	<?php } ?>
	
	<?php if ($hours['w1sh']<>""){ ?>
	<div> Wednesday </div> 
	<div><?php echo $hours['w1sh'].":".$hours['w1sm']."".$hours['w1sdp']; ?> - <?php echo $hours['w1eh'].":".$hours['w1em']."".$hours['w1edp']." ".$hours['w1ht']; ?> </div> 
	<?php if ($hours['w2sh']<>""){ ?>
	<div><?php echo $hours['w2sh'].":".$hours['w2sm']."".$hours['w2sdp']; ?> - <?php echo $hours['w2eh'].":".$hours['w2em']."".$hours['w2edp']." ".$hours['w2ht']; ?> </div>
	<?php } ?>	<?php } ?>
	
	<?php if ($hours['th1sh']<>""){ ?>
	<div> Thursday </div> 
	<div><?php echo $hours['th1sh'].":".$hours['th1sm']."".$hours['th1sdp']; ?> - <?php echo $hours['th1eh'].":".$hours['th1em']."".$hours['th1edp']." ".$hours['th1ht']; ?> </div> 
	<?php if ($hours['th2sh']<>""){ ?>
	<div><?php echo $hours['th2sh'].":".$hours['th2sm']."".$hours['th2sdp']; ?> - <?php echo $hours['th2eh'].":".$hours['th2em']."".$hours['th2edp']." ".$hours['th2ht']; ?> </div>
	<?php } ?>	<?php } ?>
	
	<?php if ($hours['f1sh']<>""){ ?>
	<div> Friday </div> 
	<div><?php echo $hours['f1sh'].":".$hours['f1sm']."".$hours['f1sdp']; ?> - <?php echo $hours['f1eh'].":".$hours['f1em']."".$hours['f1edp']." ".$hours['f1ht']; ?> </div> 
	<?php if ($hours['f2sh']<>""){ ?>
	<div><?php echo $hours['f2sh'].":".$hours['f2sm']."".$hours['f1sdp']; ?> - <?php echo $hours['f2eh'].":".$hours['f2em']."".$hours['f2edp']." ".$hours['f2ht']; ?> </div>
	<?php } ?>	<?php } ?>
	
	<?php if ($hours['s1sh']<>""){ ?>
	<div> Saturday </div> 
	<div><?php echo $hours['s1sh'].":".$hours['s1sm']."".$hours['s1sdp']; ?> - <?php echo $hours['s1eh'].":".$hours['s1em']."".$hours['s1edp']." ".$hours['s1ht']; ?> </div> 
	<?php if ($hours['s2sh']<>""){ ?>
	<div><?php echo $hours['s2sh'].":".$hours['s2sm']."".$hours['s2sdp']; ?> - <?php echo $hours['s2eh'].":".$hours['s2em']."".$hours['s2edp']." ".$hours['s2ht']; ?> </div>
	<?php } ?>	<?php } ?>
	
	<?php if ($hours['ss1sh']<>""){ ?>
	<div> Sunday </div> 
	<div><?php echo $hours['ss1sh'].":".$hours['ss1sm']."".$hours['ss1sdp']; ?> - <?php echo $hours['ss1eh'].":".$hours['ss1em']."".$hours['ss1edp']." ".$hours['ss1ht']; ?> </div> 
	<?php if ($hours['ss2sh']<>""){ ?>
	<div><?php echo $hours['ss2sh'].":".$hours['ss2sm']."".$hours['ss2sdp']; ?> - <?php echo $hours['ss2eh'].":".$hours['ss2em']."".$hours['ss2edp']." ".$hours['ss2ht']; ?> </div>
	<?php } ?>
	<?php } ?>

	


</div>
