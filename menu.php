<?php 
include('Admin/config.php');
$page = 'menu';
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>The Oven | Menu</title>
</head>
<body style="font-family: cursive;">

<?php include('header.php'); ?>
	<main role="main">
      <div class="container-fluid">
        <div class="row" style="margin-top: 14px;background-image: url('images/bg_1.jpg');background-attachment: fixed;">
        	<div class="col-12 text-center">
        		<p style="font-family: cursive;" class="h3 text-light">Menu</p>
        		<hr>
        	</div>
          <?php 
            $query = "SELECT * FROM `pizzas` ORDER BY `id` DESC";
            $result = mysqli_query($con,$query);
            ?>
        <?php foreach($result as $card): ?>
          <div class="col-lg-3  mb-3">
          <div class="card m-auto border" style="width: 18rem;height: 500px;box-shadow: 10px 7px 14px 4px rgba(0,0,0,1);">
            <img style="width: 100%" src="Admin/<?=$card['image']?>" alt="Pizza" height="160">
          <div class="card-body">
            <h5 class="card-title"><?=$card['name']?></h5>
            <p class="card-text">
            	<?php
            	echo substr($card['description'],0,100);
            	echo strlen($card['description'])>100?'...':'';
            	?>		
            </p>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item text-center">
              <b class="price">₹<?=$card['medium']?></b>
            </li>
            <li class="list-group-item">
              <select class="form-control form-control-sm size">
                <option value="<?=$card['regular']?>">Regular</option>
                <option value="<?=$card['medium']?>" selected>Medium</option>
                <option value="<?=$card['large']?>">Large</option>
              </select>
            </li>
            <li class="list-group-item text-center">
            	<?php $check = "SELECT * FROM `cart` WHERE `customer_id` = ".$_SESSION['customer_id']." AND `pizza_id` = ".$card['id']; 
            			$response = mysqli_query($con,$check);
            			$flag = 0;
            		if(mysqli_num_rows($response) == 1){
            			$flag = 1;
            		}
            	?>
              <button style="height: 50px;display: <?php echo $flag==0?'block':'none';?>;" data-price="<?=$card['medium']?>" data-pizza_id="<?=$card['id']?>" class="btn btn-primary add_to_cart w-100">
             	 <div class="text">Add To Cart &raquo;</div>
             	 <div style="display: none;" class="spinner-grow text-light" role="status">
				  <span class="sr-only">Loading...</span>
				</div>
          	  </button>
          	  <button disabled style="display: <?php echo $flag==1?'block':'none';?>;cursor: not-allowed;height: 50px;" class="w-100 btn btn-success disabled-btn">
          	  	Added to Cart
          	  </button>
            </li>
          </ul>
        </div>
        </div>
        <?php endforeach; ?>
        </div>
    </main>
    <div class="m-5"></div>
<?php include('footer.php'); ?>
</body>
</html>