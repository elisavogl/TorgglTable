
<?php

/* Template Name: Homepage*/

 ?>
 
 <?php get_header(); ?>
 


	

<div id="SearchFormWithImage">

<div id="backgroundImageHome">

</div>


<form class="form-inline searchform" role="form" id="searchform" action="http://www.localhost/torggltable/searchresults/" method="post">

<div class="form-group mb-2 selectPeopleHome">
<select id="selectPeopleHome" name="selectPeopleHome" required>
<option value="">--Number of people--</option>
<?php
for ($i=1;$i<=10;$i++){
echo "<option value=$i>$i</option>";	
}
?>
</select>
</div>
<div class="form-group mx-sm-3 mb-2 selectTimeHome">
<select id="selectTimeHome" name="selectTimeHome" required>
<option value="">--Choose dinner or lunch--</option>
<option value="lunch">Lunch</option>
<option value="dinner">Dinner</option>
</select>
</div>

<div class="form-group mb-2 datebookingHome">
<input id="datebookingHome" name="datebookingHome" type="date" required />
</div>

<div class="form-group mb-2 locationinputHome">
<input id="locationinputHome" name="locationinputHome" type="text" placeholder="Please enter your location or restaurant name" />
</div>

<div id="searchbuttonHome">
<input type="submit" id="searchbuttonHome" name="searchbuttonHome" value="LET'S GO" />
</div>
</form>
</div>


<div id="StoryToerggelen">

<div id="textStoryandHeading">
<h1 id="headingStory">Story of törggelen</h1>
<p id="textstory" style="text-align: left;"><b>How did the custom of Törggelen first begin?</b><br>
In autumn, wine lovers visited local winegrowers to sample the year’s yield of wine. 
	Even the innkeepers, who received their house wines directly from the producers, felt obliged to test the quality of the wines produced that year directly from the source. 
	At that time, the visitors themselves brought their own food....<a href="http://www.localhost/torggltable/story-about-torggelen/" >Read more </a></p>
</div>




<div id="imagesStory">
<figure class="gallery-item"><a href="http://www.localhost/torggltable/wp-content/uploads/2018/12/d8ee66bbfa.jpg" data-elementor-open-lightbox="default" data-elementor-lightbox-slideshow="25e7d599"><img src="http://www.localhost/torggltable/wp-content/uploads/2018/12/d8ee66bbfa-150x150.jpg" alt="" width="150" height="150" /></a></figure>
<figure class="gallery-item"><a href="http://www.localhost/torggltable/wp-content/uploads/2018/12/eat-1.jpg" data-elementor-open-lightbox="default" data-elementor-lightbox-slideshow="25e7d599"><img src="http://www.localhost/torggltable/wp-content/uploads/2018/12/eat-1-150x150.jpg" alt="" width="150" height="150" /></a></figure>
<figure class="gallery-item"><a href="http://www.localhost/torggltable/wp-content/uploads/2018/12/eat1-1.jpg" data-elementor-open-lightbox="default" data-elementor-lightbox-slideshow="25e7d599"><img src="http://www.localhost/torggltable/wp-content/uploads/2018/12/eat1-1-150x150.jpg" alt="" width="150" height="150" /></a></figure>
<figure class="gallery-item"><a href="http://www.localhost/torggltable/wp-content/uploads/2018/12/herbstauslese-gerichte-rippen-mit-knoedel-vinschgau-fb.jpg" data-elementor-open-lightbox="default" data-elementor-lightbox-slideshow="25e7d599"><img src="http://www.localhost/torggltable/wp-content/uploads/2018/12/herbstauslese-gerichte-rippen-mit-knoedel-vinschgau-fb-150x150.jpg" alt="" width="150" height="150" /></a></figure>
<figure class="gallery-item"><a href="http://www.localhost/torggltable/wp-content/uploads/2018/12/hofprodukte-aepfel-01.jpg" data-elementor-open-lightbox="default" data-elementor-lightbox-slideshow="25e7d599"><img src="http://www.localhost/torggltable/wp-content/uploads/2018/12/hofprodukte-aepfel-01-150x150.jpg" alt="" width="150" height="150" /></a></figure>
<figure class="gallery-item"><a href="http://www.localhost/torggltable/wp-content/uploads/2018/12/t4.jpg" data-elementor-open-lightbox="default" data-elementor-lightbox-slideshow="25e7d599"><img src="http://www.localhost/torggltable/wp-content/uploads/2018/12/t4-150x150.jpg" alt="" width="150" height="150" /></a></figure>
</div>

</div>


<div class="gallery js-flickity">
  <div class="gallery-cell"></div>
  <div class="gallery-cell"></div>
  <div class="gallery-cell"></div>
  <div class="gallery-cell"></div>
  <div class="gallery-cell"></div>
  <div class="gallery-cell"></div>
  <div class="gallery-cell"></div>
</div>


<div id="wouldRegister">
<div id="backgroundImageRegister">


<h2 id="headingRegister">Would you like to register your restaurant?</h2>
<p id="paragraphRegister">The best way to experience our features is to register over the website and see the special offers only for you.</p>
<form action="http://www.localhost/torggltable/registration-restaurant" method="post">
<input type="submit" value="Become part of it" id="buttonBecomePartHome" />
</form>
</div>
</div>

<p style="font-size:40px;padding:20px;padding-left:50px;color:#910026"><b>Most ranked restaurants</b></p>
<div class="scrolling-wrapper">
<?php 
$sql="select m1.meta_value as Restaurantname,
m1.user_id as userid,overall.overallaverage,m2.meta_value as Address,m3.file_name as RestaurantImage from wp_usermeta m1 left join wp_imagesrestaurant m3 on 
(m3.idrestaurant = m1.user_id and m3.typeimage='MainPicture') 
left join wp_usermeta m2 on (m2.user_id=m1.user_id and m2.meta_key = 'address') 
right join wp_overallrating overall on (m1.user_id=overall.idrestaurant)
where m1.meta_key = 'restaurant_name' order by overall.overallaverage LIMIT 5";

	$result=$wpdb->get_results($sql);
foreach ( $result as $row ) {
?>

  <div class="card"><img style="width:200px;height:200px;" src="http://www.localhost/torggltable/wp-content/uploads/ultimatemember/temp/<?php echo $row->RestaurantImage;?>" /><p><b><?php echo $row->Restaurantname;?></b></br><?php echo $row->Address;?>
  </br><b><?php echo $row->overallaverage;?></b> of 5 stars</div>

<?php } ?>
</div>
 <script type="text/javascript">
jQuery(document).ready(function($) {
$('#searchbuttonHome').click(function(e){
var selectPeopleHome=$('#selectPeopleHome').val();
var selectTimeHome=$('#selectTimeHome').val();
var datebookingHome=$('#datebookingHome').val();
var locationinputHome=$('#locationinputHome').val();


if (selectPeopleHome==''){
	e.preventDefault();
	alert("Please select number of people");
}
if(selectTimeHome==''){
	e.preventDefault();
	alert("Please select lunch or dinner");
}


});
  });
</script>

 
<?php get_footer(); ?>

