<?php





if(isset($_POST['id']))
{
	
	require_once('../../../wp-config.php');
global $wpdb;
$current_user = wp_get_current_user();
	$hf_username = $current_user->ID;
	
$bookingid=$_POST['id'];


	 $sql="DELETE FROM wp_booking where ID=$bookingid";
     $sql1=  "DELETE FROM wp_bookingtable where IDbooking=$bookingid";   
			
			
			$delete = $wpdb->query($sql);
			$delete1=$wpdb->query($sql1);
	 echo 'Deleted successfully.';
}


?>