<?php 
session_start();
if(!$_SESSION['customer_id']){
  header('location:login.php');
}
 ?>
<!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="Admin/css/carousel.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <script src="https://unpkg.com/feather-icons"></script>
<header>
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark" style="background-color: #121618 !important;opacity: 0.9;">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" style="font-size: 23px" href="index.php">
        <img src="Admin/images/logo.png" height="30" width="40">
        The Oven</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php if($page == 'index'){echo 'active';}?>">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item <?php if($page == 'menu'){echo 'active';}?>">
              <a  class="nav-link" href="menu.php">Menu</a>
            </li>
            <li class="nav-item <?php if($page == 'order_history'){echo 'active';}?>">
              <a  class="nav-link" href="orders.php">Order History</a>
            </li>
            <li>
              <a id="menu-toggle" href="javascript:void(0)" class="nav-link toggle square"><i data-feather="shopping-cart"></i></a>
            </li>
          </ul>
          <ul class="navbar-nav text-center ml-auto mr-5">
              <li class="dropdown">
                <a href="#" class="nav-link text-white dropdown-toggle" data-toggle="dropdown">Hi! <?php echo ucfirst($_SESSION['customer_name']); ?></a>
                <ul class="dropdown-menu" style="padding:0px;">
                  <li class="dropdown-header">
                    <a href="logout.php" class="dropdown-item text-dark">Sign-out</a>
                  </li>
                </ul>
              </li>
          </ul>
        </div>
      </nav>
      <nav style="margin-top: 14px;" id="sidebar-wrapper">
        <form action="place_order.php" method="post">
        <ul class="sidebar-nav w-100">
            <li class="sidebar-brand">
                <a href="#top" onclick=$("#close-menu").click(); style="color: black">Cart</a>
            </li>
            <li>
              <table class="w-100" id="cart-table">
                <tbody>
                  <?php 
                   $query = "SELECT `cart`.`id`,`cart`.`customer_id`,`cart`.`pizza_id`,`cart`.`price`,`cart`.`qty`,`cart`.`total`,`pizzas`.`name`,`pizzas`.`image` FROM `cart` INNER JOIN `pizzas` ON `cart`.`pizza_id` = `pizzas`.`id` WHERE `cart`.`customer_id` = ".$_SESSION['customer_id'];$f=0;
                   $items = mysqli_query($con,$query);
                   if(mysqli_num_rows($items) > 0){
                    $f=1;$i=0;
                    $total = 0;
                    foreach($items as $item):
                   ?>
                   <tr>
                      <td align='center' style='width:30%'>
                        <input type='hidden' name='order_rows[<?=$i?>][pizza_id]' value="<?=$item['pizza_id']?>">
                        <img class='rounded-pill' height='50' width='50' src="Admin/<?=$item['image']?>">
                        <br><?=$item['name']?>
                      </td>
                      <td style='width:10%'>
                        <input type='hidden' name='order_rows[<?=$i?>][price]' value="<?=$item['price']?>">₹<?=$item['price']?>
                      </td>
                      <td style='width:5%;'>
                      X
                    </td>
                    <td style='width:10%'>
                      <input class='form-control form-control-sm text-center pizza_qty' name="order_rows[<?=$i?>][qty]" value="<?=$item['qty']?>" type='number' value='1' min='1' max='5'>
                    </td>
                    <td style='width:5%;'>
                    =
                  </td>
                  <td style='width:10%'>
                    <input type='number' name="order_rows[<?=$i?>][sub_total]" class='form-control form-control-sm text-center' readonly value="<?=$item['price']?>">
                  </td>
                  <td style='width:10%;' align='center'>
                    <button  data-rem_id="<?=$item['pizza_id']?>" class='page-link rem'>&times;</button>
                  </td>
                </tr>
                 <?php $total+=$item['price']; $i++; endforeach; } ?>
                </tbody>
              </table>
              <table style="display: <?php echo $f==1?'block':'none';?>;" id="total-table" class="w-100">
                <tbody>
                  <tr>
                    <td style="width:67%;" align="right">Total</td>
                    <td align="center">
                      <input type="number" id="cart-total" readonly value="<?=$total?>" style="width:80% ;" class="form-control form-control-sm" name="grand_total">
                    </td>
                  </tr>
                </tbody>
              </table>
            </li>
            <li style="display: <?php echo $f==0?'block':'none';?>" id="empty-msg" class="text-center">
              <h1>Cart is Empty!!</h1>
            </li>
            <li style="display: <?php echo $f==1?'block':'none';?>" id="submit-btn" class="text-center">
              <button type="submit" name="order" class="btn btn-success">Place Order</button>
            </li>
        </ul>
      </form>
    </nav>
    </header>