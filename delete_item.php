<?php 
include('Admin/config.php');
	if($_POST['pizza'] && $_POST['customer']){
		$query = "DELETE FROM `cart` WHERE `customer_id` = ".$_POST['customer']." AND `pizza_id` = ".$_POST['pizza'];
		if(mysqli_query($con,$query)){
			echo 1;
		}else{
			echo 0;
		}
	}
 ?>