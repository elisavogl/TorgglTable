<?php

/* Template Name: Restaurant Account*/

 ?>

 <?php get_header(); ?>

 
 
 <div class="container">
	<div class="row">
    <div class="col-lg-10 col-md-10 col-sm-20 col-xs-9 bhoechie-tab-container">
        <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5 bhoechie-tab-menu">
      <div class="list-group">
      
                <a href="#" class="list-group-item text-center">
                  <h4 class="glyphicon glyphicon-list-alt"></h4><br/>Reservations today
                </a>
				<a href="#" class="list-group-item text-center">
                  <h4 class="glyphicon glyphicon-list-alt"></h4><br/>Future Reservations
                </a>
                <a href="#" class="list-group-item text-center">
                  <h4 class="glyphicon glyphicon-check"></h4><br/>Past Reservations
                </a>
                <a href="#" class="list-group-item text-center">
                  <h4 class="glyphicon glyphicon-comment"></h4><br/> Reviews
                </a>

              </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
                <!-- reservations today -->
                <div class="bhoechie-tab-content active">
                    <center>

                      <h4 class='page-header'> <i class="fa-fa users"></i>
                      YOUR RESERVATIONS TODAY </h4>
                      <table class="table">
                      <tr>
                      <th>FIRSTNAME AND LASTNAME</th>
                      <th>NUMBER OF PEOPLE</th>
                      <th>DATE ARRIVAL</th>
                      <th>TIME ARRIVAL</th>
                      </tr>
                      			<?php
                      			global $wpdb;
                      	$current_user = wp_get_current_user();
                      	$restaurantid = $current_user->ID;
                      	$sqlReservationsToday="Select  usermeta1.meta_value as firstname, usermeta2.meta_value as lastname ,booking.number_of_guests, booking.date_arrival, booking.time_arrival from wp_booking booking, wp_usermeta usermeta1
                      left join wp_usermeta usermeta2 on (usermeta2.user_id = usermeta1.user_id and usermeta2.meta_key = 'last_name')
                      where booking.date_arrival='". date("Y-m-d") ."'
                      and usermeta1.meta_key='first_name' and usermeta1.user_id=booking.ID_User
                      and booking.ID_Restaurant=$restaurantid order by booking.date_arrival;";
                      	$resultReservationsToday=$wpdb->get_results($sqlReservationsToday);

                      foreach ($resultReservationsToday as $row ){
                      	echo "<tr>";
                      echo "<td name=$row->lastname>" . $row->firstname ." " .$row->lastname ." </td>";
                      echo "<td name=$row->number_of_guests>" . $row->number_of_guests ."</td>";
                      echo "<td name=$row->date_arrival>" . $row->date_arrival ."</td>";
                      echo "<td name=$row->time_arrival>" . $row->time_arrival ."</td>";
                   
                      echo "</tr>";

                       }?>
                               </table>


                    </center>
                </div>
                <!-- reservations section -->
                <div class="bhoechie-tab-content">
                    <center>
                      <h4 class='page-header'> <i class="fa-fa users"></i>
                    YOUR FUTURE RESERVATIONS </h4>
                    <table class="table">
                    <tr>
                    <th>FIRSTNAME AND LASTNAME</th>
                    <th>NUMBER OF PEOPLE</th>
                    <th>DATE ARRIVAL</th>
                    <th>TIME ARRIVAL</th>
					 <th>DELETE</th>
                    </tr>
                    <?php
                    global $wpdb;
                    $current_user = wp_get_current_user();
                    $restaurantid = $current_user->ID;
                    $sqlReservationsFuture="Select booking.id as bookingid,usermeta1.user_id as userid,usermeta1.meta_value as firstname, usermeta2.meta_value as lastname ,booking.number_of_guests, booking.date_arrival, booking.time_arrival from wp_booking booking, wp_usermeta usermeta1
                    left join wp_usermeta usermeta2 on (usermeta2.user_id = usermeta1.user_id and usermeta2.meta_key = 'last_name')
                    where booking.date_arrival>='". date("Y-m-d") ."'
                    and usermeta1.meta_key='first_name' and usermeta1.user_id=booking.ID_User
                    and booking.ID_Restaurant=$restaurantid order by booking.date_arrival;";
                    $resultReservationsFuture=$wpdb->get_results($sqlReservationsFuture);
					
                    foreach ($resultReservationsFuture as $row ){
					
					echo "<tr id=".$row->bookingid .">";
                
                    echo "<td name=$row->lastname>" . $row->firstname ." " .$row->lastname ." </td>";
                    echo "<td name=$row->number_of_guests>" . $row->number_of_guests ."</td>";
                    echo "<td name=$row->date_arrival>" . $row->date_arrival ."</td>";
                    echo "<td name=$row->time_arrival>" . $row->time_arrival ."</td>";
         
                    echo "<td><a  type=submit name=deleteTableButton class='btn btn-sm btn-danger remove'><i class='fa fa-trash'></i></a></td>";
                    echo "</tr>";
					
                    }?>
                     </table>
                    </center>
                </div>

                <!-- past restaurants -->
                <div class="bhoechie-tab-content">
                    <center>
                      <h4 class='page-header'> <i class="fa-fa users"></i>
                    YOUR PAST RESERVATIONS </h4>
                    <table class="table">
                    <tr>
                    <th>FIRSTNAME AND LASTNAME</th>
                    <th>NUMBER OF PEOPLE</th>
                    <th>DATE ARRIVAL</th>
                    <th>TIME ARRIVAL</th>
					
                    </tr>
                    <?php
                    global $wpdb;
                    $current_user = wp_get_current_user();
                    $restaurantid = $current_user->ID;
                    $sqlReservationsFuture="Select  usermeta1.meta_value as firstname, usermeta2.meta_value as lastname ,booking.number_of_guests, booking.date_arrival, booking.time_arrival 
					from wp_booking booking, wp_usermeta usermeta1
                    left join wp_usermeta usermeta2 on (usermeta2.user_id = usermeta1.user_id and usermeta2.meta_key = 'last_name')
                    where date_arrival<'". date("Y-m-d") ."'
                    and usermeta1.meta_key='first_name' and usermeta1.user_id=booking.ID_User
                    and booking.ID_Restaurant=$restaurantid order by booking.date_arrival;";
                    $resultReservationsFuture=$wpdb->get_results($sqlReservationsFuture);
                    foreach ($resultReservationsFuture as $row ){
                    echo "<tr>";
					
                    echo "<td name=$row->lastname>" . $row->firstname ." " .$row->lastname ." </td>";
                    echo "<td name=$row->number_of_guests>" . $row->number_of_guests ."</td>";
                    echo "<td name=$row->date_arrival>" . $row->date_arrival ."</td>";
                    echo "<td name=$row->time_arrival>" . $row->time_arrival ."</td>";
               
                    echo "</tr>";

                    }?>
                    </table>


                    </center>
                </div>
                <div class="bhoechie-tab-content">
                    <center>
					  <h4 class='page-header'> <i class="fa-fa users"></i>
                    REVIEWS ABOUT YOUR RESTAURANT </h4>
                      <?php
                      					global $wpdb;
                      	$current_user = wp_get_current_user();
                      	$restaurantid = $current_user->ID;
                      	$sqlReview="select overallaverage,priceaverage,recommendationpercentage,
                      	foodpercentage,locationpercentage,servicepercentage from wp_overallrating where idrestaurant=$restaurantid;";
                      	$result=$wpdb->get_results($sqlReview);
           
			  foreach ($result as $row){
                      					?>
										<h4>Overall Rating</h4>
										<p><?php echo $row->overallaverage;?> of 5 stars</p>
									<h4>Pricing</h4>
									<p><?php echo $row->priceaverage;?> of 4</p>
										<h4><i class="fa-fa thumps-up"></i><b>Recommendation:</b></h4>
										<div class="progress">
  <div class="progress-bar progress-bar-striped bg-success" role="progressbar" aria-valuenow="<?php echo $row->recommendationpercentage;?>"
  aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $row->recommendationpercentage;?>%">
    <?php echo $row->recommendationpercentage;?>%
  </div>
</div>

<h4><i class="fa-fa utensils"></i><b>Food:</b></h4>
										<div class="progress">
  <div class="progress-bar progress-bar-striped bg-success" role="progressbar" aria-valuenow="<?php echo $row->foodpercentage;?>"
  aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $row->foodpercentage;?>%">
    <?php echo $row->foodpercentage;?>%
  </div>
</div>
<h4><i class="fa-fa location-arrow"></i><b>Location:</b></h4>
										<div class="progress">
  <div class="progress-bar progress-bar-striped bg-success" role="progressbar" aria-valuenow="<?php echo $row->locationpercentage;?>"
  aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $row->locationpercentage;?>%">
    <?php echo $row->locationpercentage;?>%
  </div>
</div>
<h4><i class="fas fa-concierge-bell"></i><b>Service:</b></h4>
										<div class="progress">
  <div class="progress-bar progress-bar-striped bg-success" role="progressbar" aria-valuenow="<?php echo $row->servicepercentage;?>"
  aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $row->servicepercentage;?>%">
    <?php echo $row->servicepercentage;?>%
  </div>
</div>
			  <?php } ?>
                    </center>
                </div>
                <div class="bhoechie-tab-content">
                    <center>

                    </center>
                </div>
            </div>
        </div>
  </div>
</div>

<script>
jQuery(document).ready(function($) {
    $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
        $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
    });
});
jQuery(document).ready(function($) {
$(".remove").click(function(){

 var id = $(this).parents("tr").attr("id");

if(confirm('Are you sure to remove the booking'))
{
$.ajax({
               url: '<?php echo get_template_directory_uri();?>/delete.php',
               type: 'POST',
               data: {id:id},
               error: function() {
                  alert('Something is wrong');
               },
               success: function(data) {
                  $("#"+id).remove();
                    alert("Record removed successfully");  
               }
            });
        }
    });
	
 });
</script>
<?php get_footer(); ?>