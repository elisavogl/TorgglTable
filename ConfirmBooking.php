<?php
require_once('../../../wp-config.php');
global $wpdb;


$current_user = wp_get_current_user();
$user = $current_user->id;

$output='';


	
$restaurantnameModal=$_POST["restaurantnameModal"];
$idtableModal=$_POST["idtableModal"];
$restaurantidModal=$_POST["restaurantidModal"];
$selectPeopleModal=$_POST["selectPeopleModal"];
$dateBookingModal=$_POST["dateBookingModal"];
$selectLunchDinner=$_POST["selectLunchDinner"];
$selectTimeModal=$_POST["selectTimeModal"];
$current_user = wp_get_current_user();
$user = $current_user->id;

$sql1="INSERT INTO wp_booking (ID_Restaurant,
ID_User,number_of_guests,date_arrival,time_arrival)
VALUES ($restaurantidModal,$user,$selectPeopleModal,'$dateBookingModal','$selectLunchDinner');";

$sql2="INSERT INTO wp_bookingtable(IDbooking,IDtable,date_arrival,time_arrival,
type_time)VALUES ((Select ID from wp_booking where ID_Restaurant=$restaurantidModal 
and ID_User=$user and date_arrival='$dateBookingModal' and time_arrival='$selectLunchDinner'),
$idtableModal,'$dateBookingModal','$selectLunchDinner','$selectTimeModal');";

$result=$wpdb->query($sql1);
$result1=$wpdb->query($sql2);


if($result1){
	
echo "The booking was successful. You can see it in your account of future reservations";}

else{
echo "Something went wrong with the booking. Please make sure that if you have filled out all required information";	
}


?>