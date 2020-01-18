<?php 
include('Admin/config.php');
$page = 'index';
 ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>The Oven</title>
    <style type="text/css">
      .carousel-item:after {
        content:"";
        display:block;
        position:absolute;
        top:0;
        bottom:0;
        left:0;
        right:0;
        background:rgba(0,0,0,0.5);
}
    </style>
  </head>
  <body style="font-family: cursive;">
<?php include('header.php'); ?>
    <main role="main">

      <div style="padding-top: 14px;" id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img style="height: 800px;" class="first-slide" src="images/bg_3.jpg" alt="First slide">
            <div class="container">
              <div class="carousel-caption text-left">
                <h1>We cooked your desired Pizza Recipe.</h1>
                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                <p><a class="btn btn-lg btn-primary" href="menu.php" role="button">Order Today</a></p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img class="second-slide" style="height: 800px;" src="images/bg_1.jpg" alt="Second slide">
            <div class="container">
              <div class="carousel-caption">
                <img src="images/bg_1.png" height="400">
                <h1>Delicious</h1>
                <p>Italian Cuizine</p>
                <p>Unbleached enriched wheat flour,Part-skim mozzarella cheese Fresh vine-ripened tomatoes (our tomatoes are freshly packed from vine to can in the same day),</p>
                <!-- <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p> -->
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img class="third-slide" style="height: 800px;" src="images/bg_1.jpg" alt="Third slide">
            <div class="container">
              <div class="carousel-caption text-left">
                <img src="images/bg_2.png" height="400">
              </div>
              <div class="carousel-caption text-right">
                <h1>Crunchy</h1>
                <p>Italian Pizza</p>
                <!-- <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p> -->
              </div>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>


      <!-- Marketing messaging and featurettes
      ================================================== -->
      <!-- Wrap the rest of the page in another container to center all the content. -->

      <div class="container marketing">

        <!-- Three columns of text below the carousel -->
        <div class="row">
          <?php 
            $query = "SELECT * FROM `pizzas` ORDER BY RAND() LIMIT 3";
            $result = mysqli_query($con,$query);

            if(mysqli_num_rows($result) == 1){
           ?>
           <?php foreach($result as $card): ?>
           <div class="col-lg-12  d-flex align-items-stretch">
            <div class="card m-auto border" style="width: 18rem;height: 500px;box-shadow: 10px 7px 14px 4px rgba(0,0,0,0.5);">
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
              <button style="height: 50px;" data-price="<?=$card['medium']?>" data-pizza_id="<?=$card['id']?>" class="btn btn-primary add_to_cart w-100">
               <div class="text">Add To Cart &raquo;</div>
               <div style="display: none;" class="spinner-grow text-light" role="status">
                  <span class="sr-only">Loading...</span>
                </div>
              </button>
              <button disabled style="display: none;cursor: not-allowed;height: 50px;" class="w-100 btn btn-success disabled-btn">
                Added to Cart
              </button>
            </li>
          </ul>
        </div>
          </div>
        <?php endforeach; ?>
         <?php }else if(mysqli_num_rows($result) == 2) { ?>
          <?php foreach($result as $card): ?>
         <div class="col-lg-6  d-flex align-items-stretch">
            <div class="card m-auto border" style="width: 18rem;height: 500px;box-shadow: 10px 7px 14px 4px rgba(0,0,0,0.5);">
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
       <?php }else if(mysqli_num_rows($result) == 3){ ?>
        <?php foreach($result as $card): ?>
          <div class="col-lg-4  d-flex align-items-stretch">
          <div class="card m-auto border" style="width: 18rem;height: 500px;box-shadow: 10px 7px 14px 4px rgba(0,0,0,0.5);">
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
       <?php }else{ ?>
       <?php } ?>
       <div class="mt-3 col-12 text-right">
        <a class="" href="menu.php"><i>Explore Full Menu &raquo;</i></a>  
       </div>
        </div><!-- /.row -->


        <!-- START THE FEATURETTES -->

        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading">First featurette heading. <span class="text-muted">It'll blow your mind.</span></h2>
            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
          </div>
          <div class="col-md-5">
            <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
          </div>
        </div>

        
        <hr class="featurette-divider">

        <!-- /END THE FEATURETTES -->

      </div><!-- /.container -->


      <!-- FOOTER -->
      
    </main>
    <?php include('footer.php'); ?>
  </body>
</html>
