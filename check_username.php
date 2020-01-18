<?php 
include('Admin/config.php');
	if($_POST['username']){
		$username = $_POST['username'];
		$query = "SELECT * FROM `customers` WHERE `username` = '$username'";
		$result = mysqli_query($con,$query);
		if(mysqli_num_rows($result) == 0){
			echo 1;
		}else{
			echo 0;
		}
	}
 ?>