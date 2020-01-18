<?php 
include('Admin/config.php');
	if($_POST['pizza']){
		$query = "SELECT * FROM `pizzas` WHERE `id` = ".$_POST['pizza'];
		$result = mysqli_query($con,$query);
		foreach ($result as $row) {
			echo json_encode($row);
		}
	}
 ?>