<?php





if(isset($_POST['id']))
{
	
	require_once('../../../wp-config.php');
global $wpdb;
$current_user = wp_get_current_user();
	$hf_username = $current_user->ID;
	
$tableid=$_POST['id'];


	 $sql="DELETE FROM wp_table where ID=$tableid";
     $sql1=  "DELETE FROM wp_bookingtable where IDbooking=$tableid";   
			
			
			$delete = $wpdb->query($sql);
			$delete1=$wpdb->query($sql1);
	 echo 'Deleted successfully.';
}


?>