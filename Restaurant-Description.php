

<?php

/* Template Name: Restaurant Description*/

 ?>

 <?php get_header(); ?>

 
 
 <?php
$id = $_GET['id'];
$selectpeople = $_GET['selectpeople'];
$datebooking = $_GET['datebooking'];
$selettime = $_GET['selettime'];

function make_slide_indicators(){
	 $id = $_GET['id'];
	 
	 global $wpdb;
	$output='';
$count=0;
$query1="Select * from wp_imagesrestaurant where idrestaurant=$id";

	$result1=$wpdb->get_results($query1);
	foreach ($result1 as $row){
		if ($count==0){
		$output.='
<li data-target="#dynamic_slide_show" data-slide-to="'.$count.'" class="active"></li>
   '; 		
		}
		else{
			 $output .= '
   <li data-target="#dynamic_slide_show" data-slide-to="'.$count.'"></li>
   ';
		}
		 $count = $count + 1;
	}
	 return $output;
 }
 
 function make_slides()
{global $wpdb;
	$id = $_GET['id'];
 $output = '';
 $count = 0;
$query1="Select * from wp_imagesrestaurant where idrestaurant=$id";
	$result1=$wpdb->get_results($query1);
	foreach ($result1 as $row)
 {
  if($count == 0)
  {
   $output .= '<div class="item active">';
  }
  else
  {
   $output .= '<div class="item">';
  }
  $imageURL = 'http://www.localhost/torggltable/wp-content/uploads/ultimatemember/temp/'.$row->file_name;
  $output .= '
   <img src="'.$imageURL.'" alt="'.$imageURL.'" />
   <div class="carousel-caption">
   </div>
  </div>
  ';
  $count = $count + 1;
 }
 return $output;
}

?>
 
 <?php 
 $id = $_GET['id'];
 
$query="select m1.user_id as userid, m1.meta_value as Restaurantname, m2.meta_value as Address,
m3.meta_value as Description, m4.meta_value as HowtoReach, m5.meta_value as Openinghours, m6.meta_value as FoodDrinks,
m7.file_name as RestaurantImage
from wp_usermeta m1
left join wp_usermeta m2 on (m2.user_id = m1.user_id and m2.meta_key = 'address')
left join wp_usermeta m3 on (m3.user_id = m1.user_id and m3.meta_key = 'story_restaurant')
left join wp_usermeta m4 on (m4.user_id = m1.user_id and m4.meta_key = 'reach_us')
left join wp_usermeta m5 on (m5.user_id = m1.user_id and m5.meta_key = 'opening_hours')
left join wp_usermeta m6 on (m6.user_id = m1.user_id and m6.meta_key = 'food')
left join wp_imagesrestaurant m7 on (m7.idrestaurant = m1.user_id and m7.typeimage='MainPicture')
where m1.user_id =$id and m1.meta_key = 'restaurant_name'";
$result=$wpdb->get_results($query);

if (!empty($result)){
echo "<table class=table>";

foreach ( $result as $row ) { // for loop per prendere i dati dal database
  echo "<tr><td rowspan=3>";
  echo "<img id='restaurantimage' src='http://www.localhost/torggltable/wp-content/uploads/ultimatemember/temp/$row->RestaurantImage' >";
 echo "</td></tr>";
 echo "<tr><td>";
 echo "<h1 style=text-align:left;>" . $row->Restaurantname . "</h1>";
  echo "</br><h4>" . $row->Address . "</h4>";
  echo "</td></tr>";
  
?>
</table>

    <ul class="nav nav-tabs" id="myrest_Tab">
       <li class="active"><a data-toggle="tab" href="#overview">Overview</a></li>
        <li><a data-toggle="tab" href="#food">Food</a></li>
        <li><a data-toggle="tab" href="#reviews">Reviews</a></li>
    </ul>
	
    <div class="tab-content">	
	
     <div id="overview" class="tab-pane fade in active">
        <div id="aboutus">
            <label id="labelAboutUs">About us </label>
            <?php
            echo "<p id='descriptionparagraph'>" . $row->Description . "<p>";
             ?>
          </div>
			 
<div class="container galleryslideshow">
   <br />
   <div id="dynamic_slide_show" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
    <?php echo make_slide_indicators(); ?>
    </ol>

    <div class="carousel-inner">
     <?php echo make_slides(); ?>
    </div>
    <a class="left carousel-control" href="#dynamic_slide_show" data-slide="prev">
     <span class="glyphicon glyphicon-chevron-left"></span>
     <span class="sr-only">Previous</span>
    </a>

    <a class="right carousel-control" href="#dynamic_slide_show" data-slide="next">
     <span class="glyphicon glyphicon-chevron-right"></span>
     <span class="sr-only">Next</span>
    </a>

   </div>
  </div>
              <div id="reachus">
              <label id="labelReachus">How to reach us?</label>
			  <span class="glyphicon glyphicon-road" aria-hidden="true"></span>
              <?php
              echo "<p id='reachusparagraph'>" . $row->HowtoReach . "<p>";
               ?>
          </div>
		 
			<div id="makereservation">
			
			<h4 id="headingMakeReservation">Make a reservation</h4>
			</br>
			<label id="NumberofPeoplemakereservation">Number of people</label>
			<form action="" method="post" >
			<?php
		echo "<select id=peopleselectDesc name=peopleselectDesc>";
		echo "<option value=''>--Choose no of people--</option>";
		for ($i=1;$i<=20;$i++){
		if(isset($_POST['peopleselectDesc'])){
		if($i==	$_POST['peopleselectDesc']){
		echo "<option value=$i selected>$i</option>";	
		}
		echo "<option value=$i>$i</option>";
		}elseif(isset($_GET['selectpeople'])){
			if($i==	$_GET['selectpeople']){
			echo "<option value=$i selected>$i</option>";		
			}
			echo "<option value=$i>$i</option>";
		}
		else{
		echo "<option value=$i>$i</option>";
		}}
echo "</select>";
?></br>


		<label id="WhenMakeReservation">When?</label>
			<input type="date" id="bookingdateMakeReservation" value="<?php if (isset($_POST['bookingdateMakeReservation'])){echo $_POST['bookingdateMakeReservation'];}elseif (isset($_GET['datebooking'])){echo $_GET['datebooking'];}?>" name="bookingdateMakeReservation" required /></br>
			<label id="Whenlunchordinner">Please select when you would like to come</label>
			<select id="selectLunchorDinner" name="selectLunchorDinner">
			<option value="">--Please select--</option>
			<?php
			if(isset($_POST['selectLunchorDinner'])){
			if($_POST['selectLunchorDinner']=='dinner'){	
			?>
			<option value="lunch" >Lunch</option>
			<option value="dinner" selected >Dinner</option>
			<?php }elseif($_POST['selectLunchorDinner']=='lunch'){
				?>
			<option value="lunch" selected >Lunch</option>
			<option value="dinner">Dinner</option>
			<?php }}
			elseif(isset($_GET['selecttime'])){ 
			if($_GET['selecttime']=='dinner'){
			?>
			<option value="lunch" >Lunch</option>
			<option value="dinner" selected >Dinner</option>
			<?php } elseif($_GET['selecttime']=='lunch'){
			
			?>
			<option value="lunch" selected >Lunch</option>
			<option value="dinner">Dinner</option>
<?php }}else{?>
			<option value="lunch" >Lunch</option>
			<option value="dinner">Dinner</option>
<?php } ?>
			</select>
			</br></br>
			<label id="LabelInsideorOutside">Please inform us if you prefer a table inside or outside</label>
			<select id="selectInsideOrOutside" name="selectInsideOrOutside" required>
			<option value=''>--Please select--</option>
			<?php
			if(isset($_POST['selectInsideOrOutside'])){
			if($_POST['selectInsideOrOutside']=='inside'){	
			?>
			<option value="inside" selected>Inside</option>
			<option value="outside">Outside</option>
			<?php }elseif($_POST['selectInsideOrOutside']=='outside'){ ?>
				<option value="inside">Inside</option>
			<option value="outside" selected>Outside</option>
				
			<?php }}else{?>
			<option value="inside">Inside</option>
			<option value="outside">Outside</option>
			
			<?php } ?>
			</select></br>
			<input type="submit" id="ButtonBookingConfirm" name="ButtonBookingConfirm" value="Check availability" />
			</form>			
		
			<?php 
			if (isset($_POST['ButtonBookingConfirm'])){

$peopleselectDesc=$_POST['peopleselectDesc'];
$bookingdateMakeReservation=$_POST['bookingdateMakeReservation'];
$selectLunchorDinner=$_POST['selectLunchorDinner'];
$selectInsideOrOutside=$_POST['selectInsideOrOutside'];
$id = $_GET['id'];

global $wpdb;
$sql="select m1.meta_value as Restaurantname,m1.user_id as userid,t.ID as idtable,t.seatingsFrom, t.SeatingsTo, t.locationTable,m2.meta_value as Address,m3.file_name as RestaurantImage from wp_usermeta m1 
left join wp_imagesrestaurant m3 on (m3.idrestaurant = m1.user_id and m3.typeimage='MainPicture')
left join wp_usermeta m2 on (m2.user_id=m1.user_id and m2.meta_key = 'address') 
right join wp_table t on (m1.user_id=t.ID_Restaurant 
and t.SeatingsFrom<=$peopleselectDesc and t.SeatingsTo>=$peopleselectDesc and t.ID not in 
(select distinct IDtable from wp_bookingtable bt where 
(type_time='$selectLunchorDinner' and bt.date_arrival='$bookingdateMakeReservation'))) 
where m1.meta_key = 'restaurant_name' and m1.user_id=$id ";
	if (isset($_POST['selectInsideOrOutside'])){
		$sql.=" and t.locationTable='$selectInsideOrOutside' ";
	}
	
	$sql.=" group by Restaurantname";
	
	$result=$wpdb->get_results($sql);	
	$rows=$wpdb->num_rows;
	
if ($rows>0){

if($bookingdateMakeReservation<date("Y-m-d")){?>
		<div id="NotFoundResultDiv">
	<img src="http://www.localhost/torggltable/wp-content/uploads/2018/12/sadface.jpg" id="sadFaceImageRestaurantDes" class="sadFaceImage" />
	</br>
	<p id="NotFoundRestaurantDes">
	Please select a date greater than today.
	Try again <p>
</div>

<?php
		 
	 }else{
?>
<div id="ResultsDiv">
<h3 align="center">Availability of tables</h3>
<table style="width:100%;">
	<?php
	foreach ($result as $row) {
	$idTable=$row->idtable;
	$SeatingsFrom=$row->seatingsFrom;
	$SeatingsTo=$row->SeatingsTo;
	$locationTable=$row->locationTable;
	$restaurantid=$row->userid;
	$restaurantname=$row->Restaurantname;
	?>
	<tr>
	<td>
	<p style='font-size:14px;'>We have found one of the following available tables:</p></td>
	</tr>
	<tr>
	<td>
	Table for <?php echo $SeatingsFrom;?> - <?php echo $SeatingsTo; ?>,
	Location: <?php echo $locationTable;?> </br>
	</td> 
	</tr>
	<tr>
	<td><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#ModalConfirmation<?php echo $id;?>">Reserve your table now</button>
	</td>
	</tr>
	</div>
	
<div id="ModalConfirmation<?php echo $id;?>" class="modal fade" role="dialog">

    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Booking Confirmation</h4>
		  <p> Please confirm the selected table reservation </p>
        </div>
        
        <div class="modal-body" id="restaurant_detail">
		<?php $role = (array) $current_user->roles;
$rolecurrent=$role[0];
			if ($rolecurrent=='restaurant'||$rolecurrent==''){?>
			<p> Sorry you are not allowed to do a booking with a Restaurant login or if you do not have any user account. Please register.</p>
			<?php }else {?>
		<form action="" method="post">
		<input type="hidden" id="idtableModal" name="idtableModal" value="<?php echo $idTable; ?>" required />
		<input type="hidden" id="restaurantidModal" name="restaurantidModal" value="<?php echo $id; ?> " required />
		<label><b>Restaurantname:</b> </label>
		</br><input type="hidden" name="restaurantnameModal" id="restaurantnameModal" value="<?php echo $restaurantname; ?>" required />
		<?php echo $restaurantname; ?>
		</br>
		</br>
		<label><b>Number of people coming:</b> </label></br>
		<input type="hidden" name="selectPeopleModal" id="selectPeopleModal" value="<?php echo $peopleselectDesc; ?>" required />
		<?php echo $peopleselectDesc; ?>
		</br></br>
		<label><b>Date of arrival:</b> </label></br>
		<input type="hidden" name="dateBookingModal" id="dateBookingModal" value="<?php echo $bookingdateMakeReservation; ?>" required />
		<?php echo $bookingdateMakeReservation; ?>
		</br></br>
		<label><b>Location of table: </b></label></br>
		<input type="hidden" name="selectLocationModal" id="selectLocationModal" value="<?php echo $locationTable; ?>" required />
		<?php echo $locationTable; ?></br>
		<label><b>Time of arrival: </b></label></br>
		<input type="hidden" name="selectTimeModal" id="selectTimeModal"value="<?php echo $selectLunchorDinner; ?>" required />
		<?php echo $selectLunchorDinner; ?>
		</br></br>
		<label><b>Please inform us at which time you will arrive:</b> </label></br>
		
		<?php if ($selectLunchorDinner=='lunch'){ ?>
		<select name="selectLunchDinner" id="selectLunchDinner">
		<option value="">--Please select the time--</option>
		<option value="12:00">12:00</option>
		<option value="12:30">12:30</option>
		<option value="13:00">13:00</option>
		<option value="13:30">13:30</option>
		</select>
		<?php } elseif ($selectLunchorDinner=='dinner'){?>
		<select name="selectLunchDinner" id="selectLunchDinner">
		<option value="">--Please select the time--</option>
		<option value="17:30">17:30</option>
		<option value="18:00">18:00</option>
		<option value="18:30">18:30</option>
		<option value="19:00">19:00</option>
		<option value="19:30">19:30</option>
		<option value="20:00">20:00</option>
		<option value="20:30">20:30</option>
		</select>
		<?php }?>
		</br></br>
		<button type="button" name="confirm_booking_button" id="confirm_booking_button" class="btn btn-warning">Reserve the table</button>
		</form>
	
		</div>
		<?php }?>
	   <div class="modal-footer">
          <button type="button"  data-dismiss="modal">Close</button> 
        </div>
      </div> 
    </div>
	</div>
	<?php
}
?>
	
	</table>
	</div>
<?php	
			}}else{?>	
	<div id="NotFoundResultDiv">
	<img src="http://www.localhost/torggltable/wp-content/uploads/2018/12/sadface.jpg" id="sadFaceImageRestaurantDes" class="sadFaceImage" />
	</br>
	<p id="NotFoundRestaurantDes">
	Sorry, we were unable to find any restaurant who has an available table in the date from you requested. 
	Please try again <p>
</div>

  <?php	
}
}
?>
</div>
</div>
        <div id="food" class="tab-pane fade in">
        <div id="fooddrinks">

          <label id="labelFoodandDrinks">Food and Drinks</label>
          <?php
          echo "<p id=descriptionFoodAndDrink>" . $row->FoodDrinks . "<p>";
           ?>
        </div>
      </div>
	  
        <div id="reviews" class="tab-pane fade">
		<?php global $wpdb;
                      
                      	$id = $_GET['id'];
                      	$sqlReview="select overall1, overall2,overall3, overall4,overall5,overallaverage,priceaverage,recommendationpercentage,
                      	foodpercentage,locationpercentage,servicepercentage from wp_overallrating where idrestaurant=$id
						";
                      	$result=$wpdb->get_results($sqlReview);
						$rows=$wpdb->num_rows;
			if ($rows>0){
		foreach ($result as $row){	
$countall=($row->overall1+$row->overall2+$row->overall3+$row->overall4+$row->overall5);		
		$percentagestar1=($row->overall1*100)/($row->overall1+$row->overall2+$row->overall3+$row->overall4+$row->overall5);
		$percentagestar2=($row->overall2*100)/($row->overall1+$row->overall2+$row->overall3+$row->overall4+$row->overall5);
		$percentagestar3=($row->overall3*100)/($row->overall1+$row->overall2+$row->overall3+$row->overall4+$row->overall5);
		$percentagestar4=($row->overall4*100)/($row->overall1+$row->overall2+$row->overall3+$row->overall4+$row->overall5);
		$percentagestar5=($row->overall5*100)/($row->overall1+$row->overall2+$row->overall3+$row->overall4+$row->overall5);
		
				?>
		<div class="container">
    <div class="row">
        <div class="col-lg-11 col-xs-12 col-md-11">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-lg-7 col-xs-12 col-md-7 text-center">
                        <h1 class="rating-num">
                            <?php echo $row->overallaverage;?></h1>
                       
                        <div>
                            <span class="glyphicon glyphicon-user"></span><h4><?php echo $countall;?> review(s) total </h4>
                        </div>
                    </div>
                    <div class="col-lg-11 col-xs-12 col-md-11">
                        <div class="row rating-desc">
                            <div class="col-lg-5 col-xs-3 col-md-5 text-right">
                                <span class="glyphicon glyphicon-star"></span>5
                            </div>
                            <div class="col-lg-11 col-xs-8 col-md-11">
                                <div class="progress progress-striped">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $percentagestar5;?>"
                                        aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percentagestar5;?>%">
                                        <span class="sr-only"><?php echo $percentagestar5;?></span>
                                    </div>
                                </div>
                            </div>
                            <!-- end 5 -->
                            <div class="col-lg-5 col-xs-3 col-md-5 text-right">
                                <span class="glyphicon glyphicon-star"></span>4
                            </div>
                            <div class="col-lg-11 col-xs-8 col-md-11">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $percentagestar4;?>"
                                        aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percentagestar4;?>%">
                                        <span class="sr-only"><?php echo $percentagestar4;?>%</span>
                                    </div>
                                </div>
                            </div>
                            <!-- end 4 -->
                            <div class="col-lg-5 col-xs-3 col-md-5 text-right">
                                <span class="glyphicon glyphicon-star"></span>3
                            </div>
                            <div class="col-lg-11 col-xs-8 col-md-11">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?php echo $percentagestar3;?>"
                                        aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percentagestar3;?>%">
                                        <span class="sr-only"><?php echo $percentagestar3;?>%</span>
                                    </div>
                                </div>
                            </div>
                            <!-- end 3 -->
                            <div class="col-lg-5 col-xs-3 col-md-5 text-right">
                                <span class="glyphicon glyphicon-star"></span>2
                            </div>
                            <div class="col-lg-11 col-xs-8 col-md-11">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo $percentagestar2;?>"
                                        aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percentagestar2;?>%">
                                        <span class="sr-only"><?php echo $percentagestar2;?>%</span>
                                    </div>
                                </div>
                            </div>
                            <!-- end 2 -->
                            <div class="col-lg-5 col-xs-3 col-md-5 text-right">
                                <span class="glyphicon glyphicon-star"></span>1
                            </div>
                            <div class="col-lg-11 col-xs-8 col-md-11">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?php echo $percentagestar1;?>"
                                        aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percentagestar1;?>%">
                                        <span class="sr-only"><?php echo $percentagestar1;?>%</span>
                                    </div>
                                </div>
                            </div>
                            <!-- end 1 -->
                        </div>
                        <!-- end row -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}
}
?>
<form action="http://www.localhost/torggltable/review-this-restaurant/?id=<?php echo $_GET['id'];?>" method="post">
<input type="hidden" value="<?php echo $_GET['id'];?>" name="ButtonReview">
<input type="submit" name="WriteReviewButton" id="WriteReviewButton" value="Write a review">
</form>

<?php 
$sqlBEST="select ranking.title,ranking.comment,ranking.overall 
from wp_rating ranking where ranking.idrestaurant=$id
order by overall DESC LIMIT 5 ;";
$sqlLOWEST="select ranking.title,ranking.comment,ranking.overall 
from wp_rating ranking where ranking.idrestaurant=$id 
order by overall ASC LIMIT 5 ;";
?>

<div class="scrolling-wrapper">
<p style="font-size:30px;padding-left:30;color:#910026;" >The 5 best rankings</p>
<?php 	$resultBEST=$wpdb->get_results($sqlBEST);

foreach ( $resultBEST as $row ) {
	?>
<div class="card"><b><p style="font-size:15px;"><?php echo $row->title;?></b></p></br>
<div id="commentRanking">
<textarea rows="10" cols="50">
<?php echo $row->comment;?>
</textarea>
</div>
</br> 
<p><?php echo $row->overall;?></p>
</div>

<?php }
  ?>
  </div>
  


<div class="scrolling-wrapper">
<p style="font-size:30px;color:#910026;">The 5 worst rankings</p>
<?php 	$resultLOWEST=$wpdb->get_results($sqlLOWEST);
foreach ( $resultBEST as $row ) {
	?>
<div class="card">
<p style="font-size:15px;"><b><?php echo $row->title;?></b></p></br>
<div id="commentRanking">
<textarea rows="10" cols="50">
<?php echo $row->comment;?>
</textarea>
</div>
</br> 
<p><?php echo $row->overall;?></p>
</div>

<?php }
  ?>
  </div>


			<?php }}else{ ?>
<h4>There are not any reviews until now</h4>
<?php } ?>

		

	
</div>		
		
        

<script type="text/javascript">


jQuery(document).ready(function($){	

$('#confirm_booking_button').click(function(){
var idtableModal=$('#idtableModal').val();
var restaurantidModal=$('#restaurantidModal').val();
var restaurantnameModal=$('#restaurantnameModal').val();
var selectPeopleModal=$('#selectPeopleModal').val();
var dateBookingModal=$('#dateBookingModal').val();
var selectTimeModal=$('#selectTimeModal').val();
var selectLocationModal=$('#selectLocationModal').val();
var selectLunchDinner=$('#selectLunchDinner').val();

if (idtableModal!='' && restaurantidModal!= ''
&&restaurantnameModal!=''
&&selectPeopleModal!='' && dateBookingModal!= ''&& selectTimeModal!= ''&&selectLocationModal!=''
&&selectLunchDinner!=''){
	$.ajax({
		url:"<?php echo get_template_directory_uri();?>/ConfirmBooking.php",
		method:"POST",
		data:{
			restaurantnameModal:restaurantnameModal,
			idtableModal:idtableModal,
			restaurantidModal:restaurantidModal,
			selectPeopleModal:selectPeopleModal,
			dateBookingModal:dateBookingModal,
			selectLunchDinner:selectLunchDinner,
		selectTimeModal:selectTimeModal,
		selectLocationModal:selectLocationModal},
		success:function(data){
			alert(data); 
		
		}
		
		
	});
}else{
	alert("Please select the requested fields");
}

 });
 
 
});


</script>
 <?php get_footer(); ?>
