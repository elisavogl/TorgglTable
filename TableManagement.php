<?php

/* Template Name: TableManagement*/

 ?>

 <?php get_header(); ?>



<?php
if(isset($_POST['saveTableButton'])){
  global $wpdb;
			$current_user = wp_get_current_user();
			$userid = $current_user->ID;
			$noOfTables=$_POST['selectNumberofTable'];
			$seatingsFromInput=$_POST['seatingsFromInput'];
			$seatingsToInput=$_POST['seatingsToInput'];
			$locationTable=$_POST['locationtable'];
		
			
			for ($i=1;$i<=$noOfTables;$i++){
			$sql="INSERT INTO wp_table (ID_Restaurant,SeatingsFrom,SeatingsTo,locationTable) 
			VALUES ($userid,$seatingsFromInput,$seatingsToInput,'$locationTable');";
            $insert = $wpdb->query($sql);
           

			}



}

if(isset($_POST['deleteTableButton'])){


	global $wpdb;
	$current_user = wp_get_current_user();
	$userid = $current_user->ID;
		$sql="DELETE FROM wp_table where idrestaurant=$userid and
	;";
            $delete = $wpdb->query($sql);


}
if(isset($_POST['updateTableButton'])){

	global $wpdb;
	$current_user = wp_get_current_user();
	$userid = $current_user->ID;


}

?>


<div class="container-fluid">
<div class="jumbotron";style="width:100%;">
<h1>Table Management</h1>
<img id="icontable" src="http://www.localhost/torggltable/wp-content/uploads/ultimatemember/temp/tableicon.png" style="width:100px;height:100px;" />
<p> Update, insert or delete tables for the restaurant table booking</p>
</div>
<div class="row">
<div class="mt-5 col-md-3">
<h4 class='page-header'><i class="fa fa-edit"></i>Add Tables </h4>
<form action="" role="form" method="post" id="InsertTablesForm">
<div class="form-group">
<label> NUMBER OF TABLES</label>
<?php
echo "<select class=form-control name=selectNumberofTable>";
echo "<option value=''>--Please select--</option>";
for ($i=1;$i<=11;$i++){
echo "<option value=$i name=$i>$i</option>";
}
?>
</select>
</div>
<div class="form-group">
<label> NUMBER OF SEATINGS</label>
<p> Please insert a range from/to how many tables can at most and at least sit on the table</p>
<label for="seatingsFromInput">From</label>
<input type="number" id="seatingsFromInput" name="seatingsFromInput">
<label for="seatingsToInput">To</label>
<input type="number" id="seatingsToInput" name="seatingsToInput">
<label>people</label>
</div>
<div class="form-group">
<label>LOCATION TABLE</label>
<p>Please choose if the table/s are inside or outside</p>
<select class="form-control" name="locationtable">
<option value=''>--Please select--</option>
<option value="inside">Inside</option>
<option value="outside">Outside</option>
</select>
</div>
<div class="form-group">
<input type="submit" id="saveTableButton" name="saveTableButton" value="Insert tables">
</div>
</form>
</div>

<div class="col-md-9 mt-5">
<h4 class='page-header'> <i class="fa-fa users"></i>
Table details </h4>
<table class="table">
<tr>
<th>NUMBER OF SEATINGS</th>
<th>LOCATION TABLE</th>
<th>DELETE</th>
</tr>

<?php

global $wpdb;
$current_user = wp_get_current_user();
$userid = $current_user->ID;


$sql="SELECT ID,SeatingsFrom,SeatingsTo,locationTable
FROM wp_table
where ID_Restaurant =$userid;";
	$result=$wpdb->get_results($sql);
foreach ( $result as $row ) {

echo "<tr id=".$row->ID .">";
echo "<td name=$row->Seatings>" . $row->SeatingsFrom ."-" .$row->SeatingsTo ." </td>";
echo "<td name=$row->locationTable>" . $row->locationTable ."</td>";
echo "<td><a  type=submit name=deleteTableButton class='btn btn-sm btn-danger remove'><i class='fa fa-trash'></i></a></td>";
echo "</tr>";

}

?>

</table>
</div>
</div>
 <?php
 global $wpdb;
 	$current_user = wp_get_current_user();
	$hf_username = $current_user->ID;
   // File upload configuration
    $targetDir = "C:/Users/elisavogl/Documents/XAMPP/htdocs/torggltable/wp-content/uploads/ultimatemember/temp/";
   $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
	$statusMsg = '';

if(isset($_POST["SubmitImage"]) && !empty($_FILES["file"]["name"])){
	$typeimage=$_POST['main'];
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
			if ($typeimage=='MainPicture'){
			$selectMain=$wpdb->get_results("select count(typeimage) as totaltypeimage from wp_imagesrestaurant where idrestaurant=$hf_username and typeimage='MainPicture'");
			if (!empty($selectMain)){
			foreach ( $selectMain as $row ) {
		if(($row->totaltypeimage)==0){
            $insert = $wpdb->query("INSERT into wp_imagesrestaurant (idrestaurant,file_name, typeimage) VALUES ($hf_username,'".$fileName."', '$typeimage')");

			}else{
			$insert=$wpdb->query("Update wp_imagesrestaurant set file_name='$fileName' where typeimage='MainPicture'");
			}}}


		   }elseif ($typeimage=='PicturesProfile'){
			$insert = $wpdb->query("INSERT into wp_imagesrestaurant (idrestaurant,file_name, typeimage) VALUES ($hf_username,'".$fileName."', '" .$typeimage. "')");
			}
			
			if($insert){
                $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
            }else{
                $statusMsg = "File upload failed, please try again.";
            }
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
}else{
    $statusMsg = 'Please select a file to upload.';
}

// Display status message


?>

<?php

if(isset($_POST['deleteImageButton'])){


	if (!empty ($_POST['imageDelete'])){
	global $wpdb;
	$current_user = wp_get_current_user();
	$hf_username = $current_user->ID;
	foreach ($_POST['imageDelete'] as $selected){
		$sql="DELETE FROM wp_imagesrestaurant where idrestaurant=$hf_username and
		file_name='$selected';";
            $delete = $wpdb->query($sql);
	}
	}
	else{

	}

}

?>


<div class="container-fluid">
<div class="jumbotron">
<h1> Organize your pictures</h1>
</div>


<div class="row">
<div class="mt-5 col-md-4" style="overflow:scroll;height:800px;width:300px;">
<h4 class="page-header">Your main picture for searching</h4>
 <?php
$current_user = wp_get_current_user();
$hf_username = $current_user->ID;
$sqlmainpic="SELECT file_name,idrestaurant FROM wp_imagesrestaurant where
idrestaurant=$hf_username and typeimage='mainpicture'";

$result=$wpdb->get_results($sqlmainpic);
if (!empty($result)){
 foreach ( $result as $row ) {
 $imageURL = 'http://www.localhost/torggltable/wp-content/uploads/ultimatemember/temp/'.$row->file_name;
	echo "<form action='' method=post>";
	echo "<input type=checkbox id=$imageURL name=imageDelete[] value=$row->file_name  />";
	echo "<label for=$imageURL>";
	echo "<img name=$imageURL src=$imageURL style='height:230px;width:370px;'/>";
	echo "</label>";
}
}else{
	echo "<p>No images found</p>";
}


$sql="SELECT file_name,idrestaurant FROM wp_imagesrestaurant where
idrestaurant=$hf_username and typeimage='PicturesProfile'";
$result=$wpdb->get_results($sql);
?>

<h4 class="page-header">Your pictures for the restaurant description</h4>
<?php if (!empty($result)){
 foreach ( $result as $row ) {
 $imageURL = 'http://www.localhost/torggltable/wp-content/uploads/ultimatemember/temp/'.$row->file_name;
	echo "<form action='' method=post>";
	echo "<input type=checkbox id=$imageURL name=imageDelete[] value=$row->file_name  />";
	echo "<label for=$imageURL>";
	echo "<img name=$imageURL src=$imageURL style='height:200px;width:360px;'/>";
	echo "</label>";
}
}else{
	echo "<p>No images found</p>";
}?>
</div>

 <div class="mt-5 col-md-8">
  <h4 class="page-header">Delete your images</h4>
<input type=submit name="deleteImageButton" value='delete selected images' id="deleteImageButton">
</form>


 <h4 class="page-header">Upload your images</h4>
 <form action="" method="post" enctype="multipart/form-data">
    <h3 id="headingUploadImg">Select Image File to Upload:</h3>
	<p> Please choose one picture for the main page and the other pictures
	for your restaurant description</p>
	<input type="radio" name="main" value="MainPicture"> Main Image<br>
	<input type="radio" name="main" value="PicturesProfile" checked>Pictures for profile<br>
    <input type="file" name="file" >
    <input type="submit" name="SubmitImage" id="SubmitImage" value="UPLOAD">
	<p><?php echo $statusMsg; ?></p>
</form>
</div>
</div>
</div>
<script type="text/javascript">
jQuery(document).ready(function($) {
$(".remove").click(function(){

 var id = $(this).parents("tr").attr("id");

if(confirm('Are you sure that you would like to delete the table?'))
{
$.ajax({
               url: '<?php echo get_template_directory_uri();?>/deleteTableRestaurant.php',
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
