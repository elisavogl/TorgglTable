

<?php

/* Template Name: Search-Results*/

 ?>

 <?php get_header(); ?>


<div class="container">
<div class="row">

<div class="col-md-4" id="Filters and SearchForm">
<div id="searchform">
<h4 class="page-header" style="text-align:center;">Search</h4></br>
<label><b>Number of people</b></label></br>
<?php
echo "<select id=people-select name=people-select required>";
echo "<option value=''>--Choose no of people--</option>";
for ($i=1;$i<=10;$i++){
if(isset($_POST['selectPeopleHome'])){
if($i==	$_POST['selectPeopleHome']){
echo "<option value=$i selected>$i</option>";	
}
echo "<option value=$i>$i</option>";
}else{
echo "<option value=$i>$i</option>";
}}
echo "</select>";
?></br>
<label><b>Choose time</b></label></br>
<select id="time-select" name="time-select" required>
<option value="">--Choose dinner or lunch--</option>
<?php
if(isset($_POST['selectTimeHome'])){
if($_POST['selectTimeHome']=='dinner'){
echo "<option value=dinner selected>Dinner</option>";	
echo "<option value='lunch'>Lunch</option>";}
elseif ($_POST['selectTimeHome']=='lunch'){
echo "<option value='dinner'>Dinner</option>";	
echo "<option value='lunch' selected>Lunch</option>";	
}else{
echo "<option value='dinner'>Dinner</option>";	
echo "<option value='lunch'>Lunch</option>";	
}
}
?>
</select></br>
<label><b>When?</b></label></br>
<input id="datebooking" name="datebooking" value="<?php if (isset($_POST['datebookingHome'])){echo $_POST['datebookingHome'];}?>" type="date" required /></br>
<label><b>Where?</b></label></br>
<input name="locationinput" id="locationinput" value="<?php if (isset($_POST['locationinputHome'])){echo $_POST['locationinputHome'];}?>" type="text" /></br>
<input id="searchbutton" name="searchbutton" type="button" value="SEARCH" />
</br>
</br>
</div>

<h2 class="page-header" style="text-align:center;">Filter by</h2>

<div class="list-group"> 
 <h3>Resort Filtering</h3>
 <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
 <?php 
 global $wpdb;
 $sql="select distinct(meta_value) from wp_usermeta where meta_key='resort'";
 $result=$wpdb->get_results($sql);	
 foreach($result as $row)
                    {
 ?>
 <div class="list-group-item checkbox">
 <label><input type="checkbox" class="common_selector resort" value="<?php echo $row->meta_value; ?>"  > <?php echo $row->meta_value; ?></label>
 </div>
	<?php
}
?>
	</div>
</div>	

<div class="list-group">
<h3>Pricing</h3>
<div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
 <div class="list-group-item checkbox">
<label><input type="checkbox" class="common_selector pricing" value="1">€</label>
 </div>
  <div class="list-group-item checkbox">
<label><input type="checkbox" class="common_selector pricing" value="2">€€</label>
</div>
  <div class="list-group-item checkbox">
<label><input type="checkbox" class="common_selector pricing" value="3">€€€</label>
 </div>
   <div class="list-group-item checkbox">
<label><input type="checkbox" class="common_selector pricing" value="4">€€€€</label>
 </div>
  </div>
  </div>
  
 <div class="list-group">
<h3>Ranking</h3>
<div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
  <div class="list-group-item checkbox">
<label><input type="checkbox" class="common_selector ranking" value="1">1 Star</label>
 </div>
  <div class="list-group-item checkbox">
<label><input type="checkbox" class="common_selector ranking" value="2">2 Stars</label>
 </div>
  <div class="list-group-item checkbox">
<label><input type="checkbox" class="common_selector ranking" value="3">3 Stars</label>
 </div>
  <div class="list-group-item checkbox">
<label><input type="checkbox" class="common_selector ranking" value="4">4 Stars</label>
 </div>
   <div class="list-group-item checkbox">
<label><input type="checkbox" class="common_selector ranking" value="5">5 Stars</label>
 </div>
 </div>
   </div>
 
 <div class="list-group"> 
 <h3>SEATING OPTIONS</h3>
 <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
 <div class="list-group-item checkbox">
<label><input type="checkbox" class="common_selector seating" value="inside">Inside</label>
 </div>
  <div class="list-group-item checkbox">
<label><input type="checkbox" class="common_selector seating" value="outside">Outside</label>
 </div>
  </div>
</div>
</div>

<div class="col-md-8">
<br />
<div class="row filter_data">

        </div>

    </div>
</div>
</div>	
	
<script type="text/javascript">

jQuery(document).ready(function($) {

    filter_data();

    function filter_data()
    {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var pricing = get_filter('pricing');
        var ranking = get_filter('ranking');
        var seating = get_filter('seating');
		var resort = get_filter('resort');
		var selectpeople=$('#people-select').val();
		var selecttime=$('#time-select').val();
		var datebookingTime=$('#datebooking').val();
		var location_input=$('#locationinput').val();

        $.ajax({
            url:"<?php echo get_template_directory_uri();?>/fetch_data.php",
            method:"POST",
            data:{action:action, pricing:pricing,ranking:ranking,seating:seating,resort:resort,
			selectpeople:selectpeople,selecttime:selecttime,datebookingTime:datebookingTime,
			location_input:location_input},
            success:function(data){
                $('.filter_data').html(data);
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });

});
jQuery(document).ready(function($) {
$('#searchbutton').click(function(){
var selectpeople=$('#people-select').val();
var selecttime=$('#time-select').val();
var datebookingTime=$('#datebooking').val();
var location_input=$('#locationinput').val();


if (selectpeople!='' && selecttime!= ''
&&datebookingTime!=''){
	$.ajax({
		url:"<?php echo get_template_directory_uri();?>/SearchBooking.php",
		method:"POST",
		data:{
			selectpeople:selectpeople,
			selecttime:selecttime,
			datebookingTime:datebookingTime,
			location_input:location_input},
		success:function(data){
		 $('.filter_data').html(data); 

		}
		
		
	});
}
else{
	alert ("All fields are required");
}
	});

});

</script>

<?php get_footer(); ?>
