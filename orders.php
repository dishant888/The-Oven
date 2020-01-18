<?php 
include('Admin/config.php');
$page = 'order_history';
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>The Oven | Orders</title>
</head>
<body>
<?php include('header.php'); ?>
	<main role="main" style="margin-top: 30px;margin-bottom: 15px;">
		<div class="container">
			<div class="row"> 
				<?php 	
					$orders = "SELECT * FROM `orders` WHERE `customer_id` = ".$_SESSION['customer_id']." ORDER BY `id` DESC";
					$order_rows = mysqli_query($con,$orders);
					if(mysqli_num_rows($order_rows) == 0){
					?>
						<div class="col-12 text-center">
							<b class="h2">NO ORDERS YET</b>
						</div>
					<?php
					}
					foreach($order_rows as $order_row):
				 ?>	
					<div class="col-4">
						<div class="container border border-dark shadow p-2">
							<div class="row">
								<div class="col-8 bg-primary text-white rounded shadow">
									Order no:- <?=$order_row['order_no']?>
								</div>
								<div class="col-4">
									<?=$order_row['date']?>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<hr class="border border-info">
									
									<table class="w-100">
										<tbody>
											<tr>
												<th>Name</th>
												<td align="center"><b>Price</b></td>
												<td align="center"><b>Qty</b></td>
												<td align="center"><b>total</b></td>
											</tr>
											<?php 
												$items = "SELECT `pizzas`.`name` AS `name`,`order_rows`.`price` AS `price`,`order_rows`.`qty` AS `qty`,`order_rows`.`total` AS `total` FROM `order_rows` INNER JOIN `pizzas` ON `order_rows`.`pizza_id` = `pizzas`.`id` WHERE `order_rows`.`order_id` = ".$order_row['id'];
												$result = mysqli_query($con,$items);
												foreach($result as $item):
											 ?>	
											 <tr>
											 	<td>
											 		<?=$item['name']?>
											 	</td>
											 	<td align="center">
											 		₹<?=$item['price']?>
											 	</td>
											 	<td align="center">
											 		<?=$item['qty']?>
											 	</td>
											 	<td align="center">
											 		₹<?=$item['total']?>
											 	</td>
											 </tr>
											<?php endforeach; ?>
											<tr>
												<td></td>
												<td align="right" colspan="2">
													<b>Grand:</b>
												</td>
												<td align="center">
													₹<?=$order_row['grand_total']?>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</main>
<?php include('footer.php'); ?>
</body>
</html>