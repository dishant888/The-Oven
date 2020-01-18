<?php 
include('Admin/config.php');
session_start();
unset($_SESSION['customer_id']);
unset($_SESSION['customer_name']);

	if(isset($_POST['create'])){
		$query = "INSERT INTO `customers`(`f_name`, `l_name`, `address`, `mobile`, `gender`, `username`, `password`) VALUES ('".$_POST['f_name']."','".$_POST['l_name']."','".$_POST['address']."','".$_POST['mob']."','".$_POST['gender']."','".$_POST['username']."','".$_POST['confirm']."')";
		//echo $query;exit;
		mysqli_query($con,$query);
		$last_id = mysqli_insert_id($con);
		$_SESSION['customer_id'] = $last_id;
		$_SESSION['customer_name'] = $_POST['f_name'];
		header('location:index.php');
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>TheOven | Sign-Up</title>
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
		<div class="container">
			<div style="padding-top: 25px;" class="offset-2 col-8">
				<div class="col-12 text-center">
					<span style="padding-bottom: 0px;" class="login100-form-title">
						Welcome to The Oven!
					</span><br>
					<p>Sign-Up</p>
					<hr>
				</div>
				<div class="col-12">
					<form action="create_account.php" method="post">
						<div class="row">
							<div class="col-6">
								<div class="form-group">
									<label>First Name:</label>
									<input type="text" required class="form-control form-control-sm" name="f_name">
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
									<label>Last Name:</label>
									<input type="text" class="form-control form-control-sm" required name="l_name">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-6">
								<div class="form-group">
									<label>Address:</label>
									<textarea style="resize: none;" required name="address" class="form-control form-control-sm"></textarea>
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
									<label>Mobile Number:</label>
									<input type="text" class="form-control form-control-sm" required name="mob">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-6">
								<div class="form-group">
									<label>Gender:</label>
									<br>
									<input type="radio" checked name="gender" value="Male">&nbsp;Male
									<input type="radio" class="ml-5" name="gender" value="Female">&nbsp;Female
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
									<label>Username:</label>
									<input type="text" required class="form-control form-control-sm" name="username" id="username">
									<i id="username_err" style="display: none; color: red; font-size: 14px;">
										
									</i>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-6">
								<div class="form-group">
									<label>Password:</label>
									<input type="text" class="form-control form-control-sm" required name="pass" id="pass">
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
									<label>Confirm Password:</label>
									<input type="password" class="form-control form-control-sm" required name="confirm" id="confirm">
									<i id="pass_err" style="display: none; color: red; font-size: 14px;">
								</i>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12 text-center mt-3">
								<button id="btn" name="create" class="btn rounded-0 btn-success">Create Account</button>
							</div>
							<br>
							<div class="col-12 text-center p-t-12">
								<span class="txt1">
									Already have an Account?
								</span>
								<a class="txt2" href="login.php">
									<i class="fa fa-long-arrow-left m-l-5" aria-hidden="true"></i> Login
								</a>
							</div>
						</div>
					</form>
				</div>
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
	<script type="text/javascript">
		$(document).ready(function() {
			$('#username').blur(function(event) {
				var username = $(this).val();
				if(username != ''){
					$('#username_err').hide();
					$.ajax({
						url: 'check_username.php',
						type: 'POST',
						data: {username: username},
						success:function(data){
							//console.log(data);
							if(data == 1){
								$('#username_err').fadeOut('slow');
								$('#btn').removeAttr('disabled');
								$('#pass').removeAttr('disabled');
								$('#confirm').removeAttr('disabled');
								$('#btn').css('cursor', 'pointer');
							}else{
								$('#username_err').fadeIn('slow', function() {
									$(this).text('This username is not avaliable');
								});
								$('#btn').attr('disabled', true);
								$('#btn').css('cursor', 'not-allowed');
								$('#pass').attr('disabled', true);
								$('#confirm').attr('disabled', true);
							}
						}
					});
					
				}else{
					$('#username_err').fadeIn('slow', function() {
						$(this).text('This Field is required');
					});
				}
			});

			$('#pass').focus(function(event) {
				$(this).attr('type', 'text');
				$('#btn').attr('disabled', true);
				$('#btn').css('cursor', 'not-allowed');
			});
			$('#pass').blur(function(event) {
				$(this).attr('type', 'password');
				$('#btn').attr('disabled', true);
				$('#btn').css('cursor', 'not-allowed');
			});

			$('#confirm').keyup(function(event) {
				if($(this).val() != $('#pass').val()){
					$('#pass_err').fadeIn('slow', function() {
						$(this).text("Password Did'nt Match");
						$('#btn').attr('disabled', true);
						$('#btn').css('cursor', 'not-allowed');
					});
				}else{
					$('#pass_err').fadeOut('slow');
					$('#btn').removeAttr('disabled');
					$('#btn').css('cursor', 'pointer');
				}
			});
		});
	</script>
</body>
</html>