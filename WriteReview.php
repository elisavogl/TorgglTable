<?php
require_once('../../../wp-config.php');
global $wpdb;


$current_user = wp_get_current_user();
$userid = $current_user->id;
	
$overallratingvalue=$_POST["overallratingvalue"];
$restaurantid=$_POST["restaurantid"];
$ratingvalueEuro=$_POST["ratingvalueEuro"];
$titleReview=$_POST["titleReview"];
$commentReview=$_POST["commentReview"];
$percentageReccomendation=$_POST["percentageReccomendation"];
$percentageFood=$_POST["percentageFood"];
$percentageService=$_POST["percentageService"];
$percentageLocation=$_POST["percentageLocation"];

$current_user = wp_get_current_user();
$user = $current_user->id;

//inserting the values into the table wp_rating where the user is able to see 
//the rating the user has done for which restaurant
$sqlRatingInsert="
INSERT INTO wp_rating(iduser,idrestaurant,overall,price,title,comment,recommendation, food,location,service)
VALUES ($userid,$restaurantid,$overallratingvalue,$ratingvalueEuro,
'$titleReview','$commentReview',$percentageReccomendation,$percentageFood,$percentageLocation,$percentageService);";
$resultRatingInsert=$wpdb->query($sqlRatingInsert);


$sqlOverallRatingSelect="Select * from wp_overallrating where idrestaurant=$restaurantid; ";
$resultOverallRatingSelect=$wpdb->get_results($sqlOverallRatingSelect);
$rowcount = $wpdb->num_rows;

if ($rowcount==0){

$recommendationdecimal=($percentageReccomendation/100);
$fooddecimal=($percentageFood/100);
$servicedeciaml=($percentageService/100);
$locationdecimal=($percentageLocation/100);
$servicedecimal=($percentageService/100);

$sqlRatingInsertOverall="
INSERT INTO wp_overallrating(idrestaurant,overall1,overall2,overall3,overall4,overall5,overallaverage,price1,price2,price3,price4,priceaverage,recommendationdecimal, recommendationcount,recommendationpercentage,
fooddecimal,foodcount,foodpercentage,locationdecimal,locationcount,locationpercentage,
servicedecimal, servicecount,servicepercentage)
VALUES ($restaurantid,0,0,0,0,0,0.00,0,0,0,0,0.00,$recommendationdecimal,1,$percentageReccomendation,$fooddecimal,1,$percentageFood,
$locationdecimal,1,$percentageLocation,$servicedecimal,1,$percentageService);";
$resultsqlRatingInsertOverall=$wpdb->query($sqlRatingInsertOverall);

}

else{
$recommendationdecimal=(float)($percentageReccomendation/100);
$fooddecimal=(float)($percentageFood/100);
$servicedeciaml=(float)($percentageService/100);
$locationdecimal=(float)($percentageLocation/100);
$servicedecimal=(float)($percentageService/100);
//inserting first the counting and conversion from percentage to decimal of the fields
//food, location, service and recommendation 
$sqlUpdate="update wp_overallrating
	SET recommendationdecimal=recommendationdecimal+$recommendationdecimal where idrestaurant=$restaurantid;";
$sqlUpdate1="update wp_overallrating
	SET recommendationcount=recommendationcount+1 where idrestaurant=$restaurantid;";

$sqlUpdate2="update wp_overallrating
	SET fooddecimal=fooddecimal+$fooddecimal where idrestaurant=$restaurantid;";
	
	$sqlUpdate3="update wp_overallrating
	SET foodcount=foodcount+1 where idrestaurant=$restaurantid;";
	
	$sqlUpdate4="update wp_overallrating
	SET locationdecimal=locationdecimal+$locationdecimal where idrestaurant=$restaurantid;";	
	
	$sqlUpdate5="update wp_overallrating
	SET locationcount=locationcount+1 where idrestaurant=$restaurantid;";	

	$sqlUpdate6="update wp_overallrating
	SET servicedecimal=	servicedecimal+$servicedecimal where idrestaurant=$restaurantid;";	
		
		$sqlUpdate7="update wp_overallrating
	SET servicecount=servicecount+1 where idrestaurant=$restaurantid;";	
	
	
//makes the calculation for the overall percentage for the fields 
//recommendation, food,location and service
$sqlUpdate8="update wp_overallrating
set recommendationpercentage= ((recommendationdecimal/recommendationcount)*100)  where idrestaurant=$restaurantid;";
$sqlUpdate9="update wp_overallrating
set foodpercentage=(fooddecimal/foodcount)*100 where idrestaurant=$restaurantid;";

$sqlUpdate10="update wp_overallrating
set locationpercentage=(locationdecimal/locationcount)*100 where idrestaurant=$restaurantid;";

$sqlUpdate11="update wp_overallrating set
servicepercentage=(servicedecimal/servicecount)*100 where idrestaurant=$restaurantid;";


$resultsqlUpdate=$wpdb->query($sqlUpdate);
$resultsqlUpdate1=$wpdb->query($sqlUpdate1);
$resultsqlUpdate2=$wpdb->query($sqlUpdate2);
$resultsqlUpdate3=$wpdb->query($sqlUpdate3);
$resultsqlUpdate4=$wpdb->query($sqlUpdate4);
$resultsqlUpdate5=$wpdb->query($sqlUpdate5);
$resultsqlUpdate6=$wpdb->query($sqlUpdate6);
$resultsqlUpdate7=$wpdb->query($sqlUpdate7);
$resultsqlUpdate8=$wpdb->query($sqlUpdate8);
$resultsqlUpdate9=$wpdb->query($sqlUpdate9);
$resultsqlUpdate10=$wpdb->query($sqlUpdate10);
$resultsqlUpdate11=$wpdb->query($sqlUpdate11);

}

if ($overallratingvalue==1){
	$sqlupdateRatingOverall1="update wp_overallrating
	SET overall1=overall1+1 where idrestaurant=$restaurantid;";
	$resultsqlupdateRatingOverall1=$wpdb->query($sqlupdateRatingOverall1);

	
}elseif ($overallratingvalue==2){
	$sqlupdateRatingOverall2="update wp_overallrating
	SET overall2=overall2+1 where idrestaurant=$restaurantid;";
	$resultsqlupdateRatingOverall2=$wpdb->query($sqlupdateRatingOverall2);

}elseif ($overallratingvalue==3){
	$sqlupdateRatingOverall3="update wp_overallrating
	SET overall3=overall3+1 where idrestaurant=$restaurantid;";
	$resultsqlupdateRatingOverall3=$wpdb->query($sqlupdateRatingOverall3);

}elseif ($overallratingvalue==4){
	$sqlupdateRatingOverall4="update wp_overallrating
	SET overall4=overall4+1 where idrestaurant=$restaurantid;";
	$resultsqlupdateRatingOverall4=$wpdb->query($sqlupdateRatingOverall4);

}else{
		$sqlupdateRatingOverall5="update wp_overallrating
	SET overall5=overall5+1 where idrestaurant=$restaurantid;";
$resultsqlupdateRatingOverall5=$wpdb->query($sqlupdateRatingOverall5);

	}
if ($ratingvalueEuro==1){
		$sqlprice1Update="update wp_overallrating
	SET price1=(price1+1) where idrestaurant=$restaurantid;";
	$resultsqlprice1Update=$wpdb->query($sqlprice1Update);

	
}elseif ($ratingvalueEuro==2){
	$sqlprice2Update="update wp_overallrating
	SET price2=(price2+1)where idrestaurant=$restaurantid;";
	$resultssqlprice2Update=$wpdb->query($sqlprice2Update);

}elseif ($ratingvalueEuro==3){
	$sqlprice3Update="update wp_overallrating
	SET price3=(price3+1) where idrestaurant=$restaurantid;";
		$resultssqlprice3Update=$wpdb->query($sqlprice3Update);
	
}else{
		$sqlprice4Update="update wp_overallrating
	SET price4=(price4+1) where idrestaurant=$restaurantid;";
	$resultssqlprice4Update=$wpdb->query($sqlprice4Update);
}

$sqlupdateAverage="update wp_overallrating set 
overallaverage=(1*overall1+2*overall2+3*overall3+4*overall4+5*overall5)/
(overall1+overall2+overall3+overall4+overall5) where idrestaurant=$restaurantid;";
$sqlupdateAverage1="update wp_overallrating set 
priceaverage=(1*price1+2*price2+3*price3+4*price4)/
(price1+price2+price3+price4) where idrestaurant=$restaurantid;";
$updateAverage=$wpdb->query($sqlupdateAverage);
$updateAverage1=$wpdb->query($sqlupdateAverage1);

echo "You have successfully inserted your review about the restaurant"; 

?>