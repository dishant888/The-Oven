<?php 
include('Admin/config.php');
	if($_POST['pizza'] && $_POST['customer'] && $_POST['price']){
		$query = "INSERT INTO `cart`(`customer_id`,`pizza_id`,`qty`,`price`,`total`) VALUES(".$_POST['customer'].",".$_POST['pizza'].",1,".$_POST['price'].",".$_POST['price'].")";
		if(mysqli_query($con,$query)){
			echo 1;
		}else{
			echo 0;
		}
	}
 ?>