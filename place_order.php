<?php 
include('Admin/config.php');
session_start();
if(isset($_POST['order'])){
	$last = "SELECT * FROM `orders` ORDER BY `id` DESC";
	$result = mysqli_query($con,$last);
	if(mysqli_num_rows($result) == 0){
		$order_no = "PZ/19-20/1";
	}else{
		$last_id = mysqli_num_rows($result);
		$last_id++;
		$order_no = "PZ/19-20/".$last_id;
	}
	$customer_id = $_SESSION['customer_id'];
	$grand_total = $_POST['grand_total'];
	$date = date('d-m-Y');

	$insert_order = "INSERT INTO `orders`(`order_no`, `customer_id`, `grand_total`, `date`) VALUES ('$order_no',$customer_id,$grand_total,'$date')";
	//echo $insert_order;

	if(mysqli_query($con,$insert_order)){
		$order_id = mysqli_insert_id($con);
		foreach ($_POST['order_rows'] as $row) {
			$pizza_id = $row['pizza_id'];
			$price = $row['price'];
			$qty = $row['qty'];
			$total = $row['sub_total'];

			$insert_order_rows = "INSERT INTO `order_rows`(`order_id`, `pizza_id`, `price`, `qty`, `total`) VALUES ($order_id,$pizza_id,$price,$qty,$total)";

			$empty_cart = "DELETE FROM `cart` WHERE `pizza_id` = $pizza_id AND `customer_id` = $customer_id";
			mysqli_query($con,$empty_cart); 

			if(mysqli_query($con,$insert_order_rows)){
				header('location:orders.php');
			}
		}
	}
}
 ?>
