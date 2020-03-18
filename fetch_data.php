<?php
//fetch_data
require_once('../../../wp-config.php');
global $wpdb;

	
if(isset($_POST["action"]))
{
$selectpeople=$_POST["selectpeople"];
$selecttime=$_POST["selecttime"];
$datebookingTime=$_POST["datebookingTime"];
$current_user = wp_get_current_user();
$userid = $current_user->id;

$query="select m1.meta_value as Restaurantname,
m1.user_id as userid,t.ID as idtable,t.seatingsFrom, t.SeatingsTo, 
t.locationTable,m2.meta_value as Address,m3.file_name as RestaurantImage,
m4.meta_value as Resort from wp_usermeta m1 left join wp_imagesrestaurant m3 on 
(m3.idrestaurant = m1.user_id and m3.typeimage='MainPicture') 
left join wp_usermeta m2 on (m2.user_id=m1.user_id and m2.meta_key = 'address') 
left join wp_usermeta m4 on (m4.user_id=m1.user_id and m4.meta_key='resort') 
right join wp_table t on (m1.user_id=t.ID_Restaurant and t.SeatingsFrom<=$selectpeople and t.SeatingsTo>=$selectpeople 
and t.ID not in (select distinct IDtable from wp_bookingtable bt 
where (type_time='$selecttime' and bt.date_arrival='$datebookingTime'))) 
left join wp_overallrating overall on (overall.idrestaurant=m1.user_id)
where m1.meta_key = 'restaurant_name' ";

   if(isset($_POST["location_input"]))
 {
	 
	$location=$_POST["location_input"];
$query .=" and (m2.meta_value like '%" . $_POST['location_input'] ."%' or m1.meta_value like '%". $_POST['location_input'] ."%')";
 }
  if(isset($_POST["seating"]))
 {

  $ranking_filter = implode("','", $_POST["seating"]);
  $query .= "
   AND t.locationTable IN('".$ranking_filter."')
  ";
 }
   if(isset($_POST["resort"]))
 {

  $resort_filter = implode("','", $_POST["resort"]);
  $query .= "
   AND m4.meta_value IN('".$resort_filter."')
  ";
 }
  if(isset($_POST["ranking"]))
 {

  $ranking_filter = implode("','", $_POST["ranking"]);
  $query .= "
   AND ceiling(overall.overallaverage) IN('".$ranking_filter."')
  ";
 }
 
 if(isset($_POST["pricing"]))
 {
	 
 $pricing_filter = implode("','", $_POST["pricing"]);
  $query .= "
   AND ceiling(overall.priceaverage) IN('".$pricing_filter."')
  ";
 }
 $query .=" group by Restaurantname;";

$result=$wpdb->get_results($query);	
$rows=$wpdb->num_rows;
$output = '';

if($rows > 0)
 {
	 
	 if($datebookingTime<date("Y-m-d")){
		$output.='<div class="container" style="width:700px;">
	<div class="row">
	<div class="col-md-12">
	<h4 id="noResultsFoundHeading" class="noResultsFoundHeading" style="text-align:center">
	Sorry, you have entered a date which is smaller than the date today. Please enter a valid date. </h4>
	</div>
	</div>
	</div>';	 
		 
	 }else{

	$output.='<table style="width:100%;">
<h3 align="center">Your results</h3>';
  foreach($result as $row)
  {$idTable=$row->idtable;
	$restaurantid=$row->userid;
	$restaurantname=$row->Restaurantname;
	$overallaverage=$row->overallaverage;
	$restaurantaddress=$row->address;
	$recommendation=$row->recommendationpercentage;

$imageURL = 'http://www.localhost/torggltable/wp-content/uploads/ultimatemember/temp/'.$row->RestaurantImage;

	  
   $output .= '
   <tr>
	<td width="30%" rowspan=2><img src="http://www.localhost/torggltable/wp-content/uploads/ultimatemember/temp/' .$row->RestaurantImage .'" style="width:200px;height:150px;"></td>
	<td width="70%"><a href="http://www.localhost/torggltable/restaurantdescription/?id='.$row->userid .'&selectpeople='.$selectpeople.'&datebooking='.$datebookingTime.'&selecttime='.$selecttime.'" style="font-weight:bold;color:black;font-size:18px;">' .$row->Restaurantname . '</a></td>
	</tr>
	<tr style="border-bottom:1pt solid black;">
	<td><p style="font-size:14px;">' . $row->Address . '</p></td>
	</tr>
	';
}
$output.='</table>';
 }}else{

$output.='<div class="container" style="width:700px;">
	<div class="row">
	<div class="col-md-12">
	<img src="http://www.localhost/torggltable/wp-content/uploads/2018/12/sadface.jpg" id="sadFaceImage" class="sadFaceImage" />
	<h4 id="noResultsFoundHeading" class="noResultsFoundHeading" style="text-align:center">
	Sorry, we were unable to find any restaurant who has an available table in the date from you requested. 
	Please try again </h4>
	</div>
	</div>
	</div>';	
}

echo $output;
}



?>