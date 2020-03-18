

<?php

/* Template Name: User Account*/

 ?>

 <?php get_header(); ?>

<?php if(isset($_POST["deleteTableButton"])){
	
	 
 }?>
 
 
 <div class="container">
	<div class="row">
        <div class="col-lg-10 col-md-10 col-sm-20 col-xs-9 bhoechie-tab-container">
            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5 bhoechie-tab-menu">
              <div class="list-group">
          
                <a href="#" class="list-group-item text-center">
                  <h4 class="glyphicon glyphicon-cutlery"></h4><br/>Reservations
                </a>
                <a href="#" class="list-group-item text-center">
                  <h4 class="glyphicon glyphicon-check"></h4><br/>Past Reservations
                </a>


              </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
                
                <!-- reservations section -->
                <div class="bhoechie-tab-content">
                    <center>
			   <h4 class='page-header'> <i class="fa-fa users"></i>
                    YOUR FUTURE RESERVATIONS </h4>
                    <table class="table">
                    <tr>
                    <th>RESTAURANTNAME</th>
                    <th>ADDRESS</th>
                    <th>NUMBER OF PEOPLE</th>
                    <th>ARRIVAL DATE AND TIME</th>
					<th>DELETE</th>
                    </tr>
                    <?php 
			global $wpdb;
	$current_user = wp_get_current_user();
	$userid = $current_user->ID;
	$sqlReservationsNow="Select booking.id as bookingid, usermeta1.meta_value as restaurantname, usermeta2.meta_value as address ,booking.number_of_guests, booking.date_arrival, booking.time_arrival from wp_booking booking, wp_usermeta usermeta1 
left join wp_usermeta usermeta2 on (usermeta2 .user_id = usermeta1.user_id and usermeta2.meta_key = 'address')
where booking.ID_User=$userid and booking.date_arrival>='" .date("Y-m-d") ."'
and usermeta1.meta_key='restaurant_name' and usermeta1.user_id=booking.ID_Restaurant order by booking.date_arrival;";

                    $resultReservationsFuture=$wpdb->get_results($sqlReservationsNow);
                    foreach ($resultReservationsFuture as $row ){
                    echo "<tr id=".$row->bookingid .">";
                    echo "<td name=$row->lastname>" . $row->restaurantname ." </td>";
                    echo "<td name=$row->number_of_guests>" . $row->address ."</td>";
                    echo "<td name=$row->date_arrival>" . $row->number_of_guests ."</td>";
                    echo "<td name=$row->time_arrival>" . $row->time_arrival ." ". $row->date_arrival ."</td>";
                     echo "<td><a href='#' type=submit name=deleteTableButton class='btn btn-sm btn-danger remove'><i class='fa fa-trash'></i></a></td>";
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
                    <th>RESTAURANTNAME</th>
                    <th>ADDRESS</th>
                    <th>NUMBER OF PEOPLE</th>
                    <th>ARRIVAL DATE AND TIME</th>
					
                    </tr>
                    <?php 
			global $wpdb;
	$current_user = wp_get_current_user();
	$userid = $current_user->ID;
	$sqlReservationsPast="Select  usermeta1.meta_value as restaurantname, usermeta2.meta_value as address ,booking.number_of_guests, booking.date_arrival, booking.time_arrival from wp_booking booking, wp_usermeta usermeta1 
left join wp_usermeta usermeta2 on (usermeta2 .user_id = usermeta1.user_id and usermeta2.meta_key = 'address')
where booking.ID_User=$userid and booking.date_arrival<'" .date("Y-m-d") ."'
and usermeta1.meta_key='restaurant_name' and usermeta1.user_id=booking.ID_Restaurant order by booking.date_arrival;";

                    $resultReservationsPast=$wpdb->get_results($sqlReservationsPast);
                    foreach ($resultReservationsPast as $row ){
                    echo "<tr>";
                    echo "<td name=$row->lastname>" . $row->restaurantname ." </td>";
                    echo "<td name=$row->number_of_guests>" . $row->address ."</td>";
                    echo "<td name=$row->date_arrival>" . $row->number_of_guests ."</td>";
                    echo "<td name=$row->time_arrival>" . $row->time_arrival ." ". $row->date_arrival ."</td>";
                    echo "</tr>";

                    }?>
                    </table>
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
               url: '<?php echo get_template_directory_uri();?>/deleteBookingUser.php',
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
