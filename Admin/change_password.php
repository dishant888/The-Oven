<?php 
include('config.php');
$status = false;
$message = '';
session_start();
$currentPage = 'change_password';
	if(isset($_POST['update'])){
		$new = $_POST['confirm'];
		$query = "UPDATE `admins` SET `password` = '$new' WHERE `id` = ".$_SESSION['admin_id']."";
		mysqli_query($con,$query);
		$status = true;
		$message = 'Password Updated!';
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
</head>
<body>
<?php include('header.php'); ?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Change Password</h1>
          </div>
          <div class="container">
          	<form action="change_password.php" method="post">
          	<div class="row">
          		<div class="col-4">
          			<div class="form-group">
          				<label>Enter Current Password:</label>
          				<input type="text" placeholder="Password" id="current" class="form-control form-control-sm">
          				<div style="color: #ce3e3e;display: none;" id="old_err">
          				</div>
          			</div>
          		</div>
          	</div>
          	<div class="row">
          		<div class="col-4">
          			<div class="form-group">
          				<label>New Password</label>
          				<input type="text" disabled id="new" placeholder="New Password" class="form-control form-control-sm">
          			</div>
          		</div>
          	</div>
          	<div class="row">
          		<div class="col-4">
          			<div class="form-group">
          				<label>Confirm Password</label>
          				<input type="password" disabled id="confirm" name="confirm" placeholder="Confirm Password" class="form-control form-control-sm">
          				<div id="pass_err" style="color: #ce3e3e;display: none;">
          					
          				</div>
          			</div>
          		</div>
          	</div>
          	<div class="row">
          		<div class="col-4 mt-3">
          			<div class="form-group">
          				<button name="update" style="cursor: not-allowed;" disabled class="btn-sm border-0 rounded-0 btn-success w-100" id="btn">Update</button>
          			</div>
          		</div>
          	</div>
          </form>
          <div class="row">
          	<div class="col-4">
          		<?php if($status){ ?>
          			<div class="alert alert-success"><?=$message?></div>
          		<?php } ?>
          	</div>
          </div>
          </div>
</main>
<?php include('footer.php'); ?>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
	$('#current').keyup(function(event) {
		var value = $(this).val();
		if(value!=''){
			$.ajax({
				url: 'check_password.php',
				type: 'POST',
				data: {value: value},
				success:function(data){
					if(data == 1){
						$('#old_err').slideUp('fast');
						$('#new').removeAttr('disabled');
						$('#confirm').removeAttr('disabled');
					}else{
						$('#old_err').slideDown('fast', function() {
							$(this).text("Password Didn't Match!");
						});
						$('#new').attr('disabled', true);
						$('#new').val('');
						$('#confirm').attr('disabled', true);
						$('#confirm').val('');
					}
				}
			});
		}else{
			$('old_err').text('');
			$('#new').attr('disabled', true);
			$('#new').val('');
			$('#confirm').attr('disabled', true);
			$('#confirm').val('');
		}
	});
	$('#new').blur(function(event) {
		$(this).attr('type','password');
	});
	$('#new').focus(function(event) {
		$(this).attr('type', 'text');
	});
	$('#confirm').keyup(function(event) {
		if($(this).val() != $('#new').val()){
			$('#pass_err').slideDown('fast', function() {
				$(this).text('Please enter same password as New Password');
			});
			$('#btn').css('cursor', 'not-allowed');
			$('#btn').attr('disabled', true);
		}else{
			$('#pass_err').hide();
			$('#btn').css('cursor', 'pointer');
			$('#btn').removeAttr('disabled');
		}
	});
</script>
</body>
</html>