<?php 
$currentPage = 'index';
include('config.php');
$order_query = "SELECT COUNT(`id`) FROM `orders`";
$order_query_result = mysqli_query($con,$order_query);
$order_count = mysqli_fetch_array($order_query_result);
$earning_query = "SELECT SUM(`grand_total`) FROM `orders`";
$earning_query_result = mysqli_query($con,$earning_query);
$earning = mysqli_fetch_array($earning_query_result);
$pizza_query = "SELECT COUNT(`id`) FROM `pizzas`";
$pizza_query_result = mysqli_query($con,$pizza_query);
$pizza_count = mysqli_fetch_array($pizza_query_result);
$customer_query = "SELECT COUNT(`id`)  FROM `customers`";
$customer_query_result = mysqli_query($con,$customer_query); 
$customer_count = mysqli_fetch_array($customer_query_result);
 ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>DASHBOARD</title>

  </head>

  <body>
      <?php include('header.php'); ?>
      <style type="text/css">
  .box{
    padding: 0px;
  }
  .box-head{
    color: white;
    padding-left: 10px;
  }
</style>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
          </div>
          <div class="container">
            <div class="row">
              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <td><b>Order Placed:</b></td>
                    <td align="center">
                      <?php echo $order_count[0]; ?>
                    </td>
                  </tr>
                  <tr>
                    <td><b>Total Earnings:</b></td>
                    <td align="center">
                      <?php echo '₹'.$earning[0]; ?>
                    </td>
                  </tr>
                  <tr>
                    <td><b>Pizzas:</b></td>
                    <td align="center">
                      <?php echo $pizza_count[0]; ?>
                    </td>
                  </tr>
                  <tr>
                    <td><b>Total Customers:</b></td>
                    <td align="center">
                      <?php echo $customer_count[0]; ?>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </main>
      <?php include('footer.php'); ?>
  </body>
</html>
