<?php 
include('config.php');
$currentPage = 'orders';
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>ORDERS</title>
</head>
<body>
<?php include('header.php') ?>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
	<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">ORDERS</h1>
          </div>
          <div class="container">
          	<div class="col-12 table-responsive">
          		<table class="table table-bordered table-hover" id="myTable">
          			<thead>
          				<tr>
          					<td>#</td>
                                   <td>Order No.</td>
                                   <td>Date</td>
                                   <td>Customer</td>
                                   <td align="center">Amount</td>
          				</tr>
          			</thead>
          			<tbody>
          		<?php  
                         $query = "SELECT `customers`.`f_name` AS `f_name`,`customers`.`l_name` AS `l_name`,`customers`.`gender` AS `gender`,`orders`.`id` AS `id`,`orders`.`order_no` AS `order_no`,`orders`.`customer_id` AS `customer_id`,`orders`.`grand_total` AS `grand_total`,`orders`.`date` AS `date` FROM `orders` INNER JOIN `customers` ON `orders`.`customer_id` = `customers`.`id` ORDER BY `orders`.`id` DESC";
                         $i=0;
                         $orders = mysqli_query($con,$query);
                         foreach($orders as $order):
                    ?>
                    <tr>
                         <td><?=++$i?></td>
                         <td>
                              <?=$order['order_no']?>
                         </td>
                         <td>
                              <?=$order['date']?>
                         </td>
                         <td>
                             <?php 
                                   $name = '';
                                   if($order['gender']=='Male'){$name.="Mr.";}else{$name.="Mrs.";}
                                   $name.=" ".ucfirst($order['f_name']);
                                   $name.=" ".ucfirst($order['l_name']);
                              ?>
                              <a href="javascript:void(0)" data-toggle="modal" data-target="#customer<?=$i?>"><?=$name?></a>
                              <!-- Modal -->
                              <div class="modal fade" id="customer<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel"><?=$name?></h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-bordered">
                                       <?php 
                                       $customer_info = "SELECT * FROM `customers` WHERE `id` = ".$order['customer_id'];
                                       $details = mysqli_query($con,$customer_info);
                                       foreach ($details as $detail) {
                                        ?>
                                        <tr>
                                             <th>Address:</th>
                                             <td><?=$detail['address']?></td>
                                        </tr>
                                        <tr>
                                             <th>Contact:</th>
                                             <td><?=$detail['mobile']?></td>
                                        </tr>
                                   <?php } ?>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                         </td>
                         <td align="center">
                              <a href="javascript:void(0)" data-toggle="modal" data-target="#view<?=$i?>">₹<?=$order['grand_total']?></a>
                              <!-- Modal -->
                              <div class="modal fade" id="view<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                       <table class="table">
                                        <thead>
                                             <tr>
                                                  <th>Pizza</th>
                                                  <td align="center"><b>Price</b></td>
                                                  <td align="center"><b>Qty</b></td>
                                                  <td align="center"><b>total</b></td>
                                             </tr>
                                        </thead>
                                        <?php 
                                        $order_row = "SELECT `pizzas`.`name` AS `name`,`order_rows`.`price` AS `price`,`order_rows`.`qty` AS `qty`,`order_rows`.`total` AS `total` FROM `order_rows` INNER JOIN `pizzas` ON `order_rows`.`pizza_id` = `pizzas`.`id` WHERE `order_rows`.`order_id` = ".$order['id'];
                                        $rows = mysqli_query($con,$order_row);
                                        foreach($rows as $row):
                                       ?>
                                            <tr>
                                                  <td>
                                                       <?=$row['name']?>
                                                  </td>
                                                  <td align="center">
                                                       ₹<?=$row['price']?>
                                                  </td>
                                                  <td align="center">
                                                       <?=$row['qty']?>
                                                  </td>
                                                  <td align="center">
                                                       ₹<?=$row['total']?>
                                                  </td>
                                              </tr>
                                              <?php endforeach; ?>
                                              <tr>
                                                  <td></td>
                                                  <td align="right" colspan="2">
                                                       <b>Grand:</b>
                                                  </td>
                                                  <td align="center">
                                                       ₹<?=$order['grand_total']?>
                                                  </td>
                                             </tr>
                                       </table>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                         </td>
                    </tr>
               <?php endforeach; ?>
          			</tbody>
          		</table>
          		<br>
          	</div>
          </div>
    </main>
<?php include('footer.php') ?>
<script type="text/javascript" src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
     $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
</body>
</html>