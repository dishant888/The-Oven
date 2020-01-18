<?php 
include('Admin/config.php');
session_start();
unset($_SESSION['customer_id']);
unset($_SESSION['customer_name']);
$status = false;
$msg = '';
	if(isset($_POST['login'])){
		$query = "SELECT * FROM `customers` WHERE `username` = '".$_POST['username']."' AND `password` = '".$_POST['pass']."'";
		//echo $query;exit;

		$result = mysqli_query($con,$query);
		if(mysqli_num_rows($result) != 0){

        while($row = mysqli_fetch_array($result)){
          $_SESSION['customer_id'] = $row['id'];
          $_SESSION['customer_name'] = $row['f_name'];
        }

      }else{

        $status = true;
        $msg = 'Invalid Credentials';

      }

      if(isset($_SESSION['customer_id']))
      {
        header('location:index.php');
      }
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>TheOven | Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class=""><!--container-login100-->
			<div style="padding-top: 80px;margin-left: 170px;" class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="Admin/images/logo.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" action="login.php" method="post">
					<span style="padding-bottom: 0px;" class="login100-form-title">
						Welcome to The Oven!
					</span><br>	
					<center><i style="margin-bottom: 5px;">Please Login to Continue</i></center><br>

					<div class="wrap-input100 validate-input" data-validate = "Username is required">
						<input class="input100" autocomplete="off" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" autocomplete="off" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="login">
							Login
						</button>
					</div>
					<?php if($status){ ?>
						<div class="col-12 mt-3 text-center">
							<div class="alert alert-danger">
								<?=$msg?>
							</div>
						</div>
					<?php } ?>
					<div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#">
							Password?
						</a>
					</div>

					<div class="text-center p-t-30">
						<a class="txt2" href="create_account.php">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>