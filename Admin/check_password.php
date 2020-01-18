<?php 
include('config.php');
session_start();
if($_POST['value']){

	$query = "SELECT * FROM `admins` WHERE `id` = ".$_SESSION['admin_id']." AND `password` = '".$_POST['value']."'";
	$result = mysqli_query($con,$query);
	if(mysqli_num_rows($result) == 1){
		echo 1;
	}else{
		echo 0;
	}
}
 ?>
