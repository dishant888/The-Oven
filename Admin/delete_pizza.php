<?php 
include('config.php');
$id = $_GET['id'];
$query = "DELETE FROM `pizzas` WHERE `id`=$id";
mysqli_query($con,$query);
header('location:list_pizza.php');
 ?>