
<?php

/* Template Name: ReviewRestaurant*/

 ?>

 <?php get_header(); ?>
 
 
<?php  $restaurantid = $_POST['ButtonReview'];
$restaurantidget = $_GET['id']; 

$role = (array) $current_user->roles;
$rolecurrent=$role[0];
if ($rolecurrent=='restaurant'||$rolecurrent==''){?>
<div class="col-sm-12">
<div class="col-sm-12">
<a href="http://www.localhost/torggltable/restaurantdescription/?id=<?php echo $restaurantidget;?>" style="font-size:30px;">Go back to restaurant</a>
<form method="POST" id="insert_review">
<div class="form-group">
<p style="font-size:30px;padding-top:20px;">Sorry you are not allowed to write a review as a Restaurant!!!!!</p>
</div>
<?php }else{?>


<div class="col-sm-12">
<a href="http://www.localhost/torggltable/restaurantdescription/?id=<?php echo $restaurantidget;?>" style="font-size:30px;">Go back to restaurant</a>
<form method="POST" id="insert_review">
<div class="form-group">
<h2><b>Review this restaurant</b></h2>

<h4> <b>Your overall rating of this restaurant: </b></h4>
<span class="fa fa-star checked" onmouseover="starmark(this)" onclick="starmark(this)" id="1one" style="font-size:20px;cursor:pointer;" ></span>
<span class="fa fa-star checked" onmouseover="starmark(this)" onclick="starmark(this)" id="2one" style="font-size:20px;cursor:pointer;" ></span>
<span class="fa fa-star checked" onmouseover="starmark(this)" onclick="starmark(this)" id="3one" style="font-size:20px;cursor:pointer;" ></span>
<span class="fa fa-star checked" onmouseover="starmark(this)" onclick="starmark(this)" id="4one" style="font-size:20px;cursor:pointer;" ></span>
<span class="fa fa-star checked" onmouseover="starmark(this)" onclick="starmark(this)" id="5one" style="font-size:20px;cursor:pointer;" ></span>
<input type="hidden" class="form-control" id="ratingValue" name="ratingValue" value="5" required>
<input type="hidden" class="form-control" id="restaurantId" name="restaurantId" value="<?php echo $restaurantid;?>">
</div>
<div class="form-group">
<h4> <b>Price of the restaurant:</b></h4>
<span class="fa fa-euro checked" onmouseover="starmarkEuro(this)" onclick="starmarkEuro(this)" id="1two" style="font-size:20px;cursor:pointer;" ></span>
<span class="fa fa-euro checked" onmouseover="starmarkEuro(this)" onclick="starmarkEuro(this)" id="2two" style="font-size:20px;cursor:pointer;" ></span>
<span class="fa fa-euro checked" onmouseover="starmarkEuro(this)" onclick="starmarkEuro(this)" id="3two" style="font-size:20px;cursor:pointer;" ></span>
<span class="fa fa-euro checked" onmouseover="starmarkEuro(this)" onclick="starmarkEuro(this)" id="4two" style="font-size:20px;cursor:pointer;" ></span>
<input type="hidden" class="form-control" id="ratingValueEuro" name="ratingValueEuro" value="4" required>
</div>
<div class="form-group">
<label for="usr">Title*</label>
<input type="text" class="form-control" id="title" name="title" required>
</div>
<div class="form-group">
<label for="comment">Comment*</label>
<textarea class="form-control" rows="5" id="comment" name="comment" required></textarea>
</div>
<div class="form-group">
<label><b>Recommendation</b></label>
<div id="sliderRecommendation" class="slidecontainer">
  <input type="range" min="1" max="100" value="50" class="slider" id="RangeReccomendation">
<p>Percentage: <span id="percentageReccomendation"></span>%</p>
  </div>
</div>
<div class="form-group">
<label><b>Food</b></label>
<div id="sliderFood" class="slidecontainer">
  <input type="range" min="1" max="100" value="50" class="slider" id="RangeFood">
<p>Percentage: <span id="percentageFood"></span>%</p>
  </div>
</div>
<div class="form-group">
<label><b>Location</b></label>
<div id="sliderLocation" class="slidecontainer">
  <input type="range" min="1" max="100" value="50" class="slider" id="RangeLocation">
<p>Percentage: <span id="percentageLocation" ></span>%</p>
  </div>
</div>
<div class="form-group">
<label><b>Service</b></label>
<div id="sliderService" class="slidecontainer">
  <input type="range" min="1" max="100" value="50" class="slider" id="RangeService">
<p>Percentage: <span id="percentageService"></span>%</p>
  </div>
</div>
<div class="form-group">
<input type="submit" name="submitReview" id="submitReview" style="margin-top:10px;margin-left:5px;" value="Save Review" />
</div>
</form>
<div id="confirmationmessage"><label id="confirmationMessagelabel"></label><div>
</div>
</div>
        </div>

    </div>
</div>


<div class="row">
		<?php $id = $_GET['id'];
		if (isset($_POST['submitReview'])){
			 $restaurantid = $_POST['ButtonReview'];
			 $ratingvalue = $_POST['ratingValue'];
			 $title=$_POST['title'];
			 $comment=$_POST['comment'];
			 $current_user = wp_get_current_user();
			$user_id = $current_user->ID;
			global $wpdb;
$query1="Insert into wp_rating (iduser,idrestaurant,staroverall,title,comment)
VALUES ($user_id,$restaurantid,$ratingvalue,'$title','$comment');";

if ($ratingvalue=1){
	$query2="INSERT INTO wp_overallrating (idrestaurant,staroverall1,staroverall2,staroverall3,staroverall4,staroverall5)
	VALUES ($restaurantid,(staroverall1+$ratingvalue),(staroverall2+0),(staroverall3+0),(staroverall4+0),(staroverall5+0));";
}
else if ($ratingvalue=2){
	$query2="INSERT INTO wp_overallrating (idrestaurant,staroverall1,staroverall2,staroverall3,staroverall4,staroverall5)
	VALUES ($restaurantid,(staroverall1+0),(staroverall2+$ratingvalue),(staroverall3+0),(staroverall4+0),(staroverall5+0));";
}
else if ($ratingvalue=3){
	$query2="INSERT INTO wp_overallrating (idrestaurant,staroverall1,staroverall2,staroverall3,staroverall4,staroverall5)
	VALUES ($restaurantid,(staroverall1+0),(staroverall2+0),(staroverall3+$ratingvalue),(staroverall4+0),(staroverall5+0));";
}			
else if ($ratingvalue=4){
	$query2="INSERT INTO wp_overallrating (idrestaurant,staroverall1,staroverall2,staroverall3,staroverall4,staroverall5)
	VALUES ($restaurantid,(staroverall1+0),(staroverall2+0),(staroverall3+0),(staroverall4+$ratingvalue),(staroverall5+0));";
}			
	else if ($ratingvalue=5){
	$query2="INSERT INTO wp_overallrating (idrestaurant,staroverall1,staroverall2,staroverall3,staroverall4,staroverall5)
	VALUES ($restaurantid,(staroverall1+0),(staroverall2+0),(staroverall3+0),(staroverall4+0),(staroverall5+$ratingvalue));";
}		
		}
}
		?>
<script type="text/javascript">
var sliderRecommendation = document.getElementById("RangeReccomendation");
var outputRecommendation = document.getElementById("percentageReccomendation");


outputRecommendation.innerHTML = sliderRecommendation.value;


sliderRecommendation.oninput = function() {
  outputRecommendation.innerHTML = this.value;

  
}
var sliderFood = document.getElementById("RangeFood");
var outputFood = document.getElementById("percentageFood");

outputFood.innerHTML = sliderFood.value;


sliderFood.oninput = function() {
  outputFood.innerHTML = this.value;

}
var sliderLocation = document.getElementById("RangeLocation");
var outputLocation = document.getElementById("percentageLocation");

outputLocation.innerHTML = sliderLocation.value;

sliderLocation.oninput = function() {
  outputLocation.innerHTML = this.value;

}

var sliderService = document.getElementById("RangeService");
var outputService = document.getElementById("percentageService");

outputService.innerHTML = sliderService.value;


sliderService.oninput = function() {
  outputService.innerHTML = this.value;
 
}
	
var rating="";
function starmark(item)
{
var count=item.id[0];
rating=count;
var subid=item.id.substring(1);	
for (var i=0;i<5;i++)
{
	if (i<count)
	{
		document.getElementById((i+1)+subid).style.color="orange";
	}else{
		document.getElementById((i+1)+subid).style.color="black";
	}
}
jQuery(document).ready(function($){
  $('input[name="ratingValue"]').val(rating);
});
}
var ratingEuro="";
function starmarkEuro(item)
{
var count=item.id[0];
ratingEuro=count;
var subid=item.id.substring(1);	
for (var i=0;i<4;i++)
{
	if (i<count)
	{
		document.getElementById((i+1)+subid).style.color="orange";
	}else{
		document.getElementById((i+1)+subid).style.color="black";
	}
}
jQuery(document).ready(function($){
  $('input[name="ratingValueEuro"]').val(ratingEuro);
});
}
jQuery(document).ready(function($) {
$('#submitReview').click(function(){
var overallratingvalue=$('#ratingValue').val();
var restaurantid=$('#restaurantId').val();
var ratingvalueEuro=$('#ratingValueEuro').val();
var titleReview=$('#title').val();
var commentReview=$('#comment').val();
var percentageReccomendation=$('#percentageReccomendation').text();
var percentageFood=$('#percentageFood').text();
var percentageService=$('#percentageService').text();
var percentageLocation=$('#percentageLocation').text();

if (overallratingvalue!='' && restaurantid!= ''
&&ratingvalueEuro!=''&&titleReview!=''
&&commentReview!='' && percentageReccomendation!= ''
&& percentageFood!='' &&percentageService!=''  &&percentageLocation!=''  ){
	$.ajax({
		url:"<?php echo get_template_directory_uri();?>/WriteReview.php",
		method:"POST",
		data:{
			overallratingvalue:overallratingvalue,
			restaurantid:restaurantid,
			ratingvalueEuro:ratingvalueEuro,
			titleReview:titleReview,
			commentReview:commentReview,
			percentageReccomendation:percentageReccomendation,
		percentageFood:percentageFood,
percentageService:percentageService,
percentageLocation:percentageLocation
},
		success:function(data){
			confirmationMessagelabel.innerHTML = data.value;
			alert (data);			
		}
		
		
	});
}else{
	alert ("Please note that all fields are required");
}
	});

});

</script>


<?php get_footer(); ?>