<?php
class Combo {

function number_select ( $start, $end, $match, $name  ) {

$counter=$start;

$select = "<select name=" . $name . " class='form_control'>";

$select = $select. "<option value='' >" . $name . "</option>";

while ( $counter <= $end ) {

if ($counter==0 && $name=="minutes") $counter="00";

$select = $select. "<option value=" . $counter;

if ( $match==$counter && $match<>"" ) { 
$select = $select. " selected "; 
} 

$select = $select. ">" . $counter . "</option>";

$counter++;
}

$select = $select. "</select>";

return $select;

} // end function

function daypart_select ( $daypart ) {

$select = "<select name='daypart' class='form_control'>";

$select = $select. "<option value='' "; 
if ($daypart==="") { 
$select = $select. " selected "; 
}  
$select = $select. ">daypart</option>";

$select = $select. "<option value='AM' "; 
if ($daypart=="AM") { 
$select = $select. " selected "; 
}  
$select = $select. ">AM</option>";

$select = $select. "<option value='PM' "; 
if ($daypart=="PM") { 
$select = $select. " selected "; 
}  
$select = $select. ">PM</option>";

$select = $select. "</select>";

return $select;

} // end function

function binary_select ( $binary, $name  ) {

$select = "<select name='".$name."' class='form_control'>";

$select = $select. "<option value='' "; 
if ($binary=="") { 
$select = $select. " selected "; 
}  
$select = $select. ">".$name."</option>";

$select = $select. "<option value='0' "; 
if ($binary==0) { 
$select = $select. " selected "; 
}  
$select = $select. ">No</option>";

$select = $select. "<option value='1' "; 
if ($binary==1) { 
$select = $select. " selected "; 
}  
$select = $select. ">Yes</option>";

$select = $select. "</select>";

return $select;

} // end function

//=============================================================================================================================
function make_combo ( $select_name, $sql_select, $sql_table, $where, $id_to_match ) {
include_once($_SERVER['DOCUMENT_ROOT']."/includes/strip_last.php");
global $conn;
$variable = "";

$sql  = "select " . $sql_select . " from " . $sql_table . " " . $where;

$array = explode(",",$sql_select); $arraycount = count($array); 
				
$stroutput = "<select name=" . $select_name . " id=" . $select_name . " style='width:100%;'>";

$stroutput = $stroutput."<option value=''>" . $sql_table . "</option>";
//echo $sql; exit;
$result = $conn->query($sql);
	
while (($row = $result->fetch_array()) !== NULL) {						
$stroutput = $stroutput."<option";
if ($id_to_match == $row[0]) { $stroutput = $stroutput." selected "; }
$stroutput = $stroutput." value='".$row[0]."'>";
for ($i = 1; $i <= ($arraycount-1); $i++) { $variable = $variable.$row[$i].", "; } $variable = strip_last($variable,",");
$stroutput = $stroutput.$variable; $variable="";
$stroutput = $stroutput."</option>";
}
		
$stroutput = $stroutput."</select>";	
return $stroutput;
}// end combo
//=============================================================================================================================


//=============================================================================================================================
function user_combo ( $user_to_match ) {
include("/var/www/includes/connect.php"); 
include_once("/var/www/includes/strip_last.php");




$sql  = "select alt_email from users "; //echo $sql; exit;
$result = $conn->query($sql);
$alt_email = array();
$i=0;
while (($row = $result->fetch_array()) !== NULL) {
$alt_email[$i]=$row['alt_email']; 
$i++;
}


				
$stroutput = "<select name='assignedto' class='form_control'>";

$stroutput = $stroutput."<option value='0' selected>assigned to</option>";

foreach ($alt_email as $key => $value) {
$sql  = "select contactID, firstname, lastname from contacts where alt_email = '$value' "; //echo $sql; exit;
$result = $conn->query($sql);

	
while (($row = $result->fetch_array()) !== NULL) {
						
		$stroutput = $stroutput."<option";
		if ($user_to_match == $row[0]) { $stroutput = $stroutput." selected "; }
		$stroutput = $stroutput." value='".$row[0]."'>";
		$stroutput = $stroutput.$row[1];
		$stroutput = $stroutput."</option>";

}


}		
$stroutput = $stroutput."</select>";
		
	
return $stroutput;

}// end combo
//=============================================================================================================================

function time_select ($time) { 
$time_select = '<select name="time">';
     
	$now_hour = date("G"); 
	if ($time){ $now_hour = $time; }
    for ($i = 0; $i < 24 ; $i++)  
    { 
      switch ($i)  
      { 
        case 0; 
          $time_select .= "    <option value=".$i; 
          if ($now_hour == $i) { $time_select .= " selected"; } 
          $time_select .= "> 12 Midnight</option>\n";
          $min=$i.":30";
          $time_select .="     <option value=".$min."> 12:30AM</option>\n";
          break; 
        case 12: 
          $time_select .= "    <option value=".$i; 
          if ($now_hour == $i) { $time_select .= " selected"; } 
          $time_select .= "> 12 Noon</option>\n";
          $min=$i.":30";
          $time_select .="     <option value=".$min."> 12:30PM</option>\n"; 
          break; 
        case ($i< 13): 
          $time_select .= "    <option value=".$i;  
          if ($now_hour == $i) { $time_select .= " selected"; } 
          $time_select .= "> ".$i." AM</option>\n";
          $min=$i.":30";
          $time_select .="     <option value=".$min."> ".$i.":30 AM</option>\n";  
          break; 
        case ($i > 12); 
          $time_select .= "    <option value=".$i; 
          if ($now_hour == $i) { $time_select .= " selected"; } 
          $time_select .= "> " . ($i-12) . " PM</option>\n";
          $min=$i.":30";
          $time_select .="     <option value=".$min."> ".($i-12).":30 PM</option>\n";  
          break; 
      } 
    }
$time_select .= '</select>';

return  $time_select;  ?> 
<?php } //end time select
}?>
