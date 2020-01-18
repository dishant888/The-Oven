<?php 
include('config.php');
$success = false;
$error = false;
$msg = '';
$currentPage = 'add_pizza';

	if(isset($_POST['add'])){
		$name = $_POST['name'];
		$description = $_POST['description'];
		$regular = $_POST['regular'];
		$medium = $_POST['medium'];
		$large = $_POST['large'];
		$source = $_FILES['image']['tmp_name'];
		$destination = 'pizza/'.$_FILES['image']['name'];
		$query = "INSERT INTO `pizzas`(`name`, `description`, `regular`, `medium`, `large`, `image`) VALUES ('$name','$description',$regular,$medium,$large,'$destination')";
		if(move_uploaded_file($source, $destination)){

			if(mysqli_query($con,$query)){
				$success = true;
				$msg = 'Successfully Added !';
			}else{
				$error = true;
				$msg = 'Error while saving';
			}

		}else{
			$error = true;
			$msg = 'Error while uploading image';
		}
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>ADD PIZZA</title>
</head>
<body>
<?php include('header.php') ?>
	<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">ADD PIZZA</h1>
          </div>

          <div class="container">
          	<div class="row">
          		<div class="col-6">
          	<form action="add_pizza.php" method="post" enctype="multipart/form-data">
          	<div class="row">
          		<div class="col-8">
          			<div class="form-group">
          				<label>Pizza Name:</label>
          				<input type="text" placeholder="Name" name="name" class="form-control form-control-sm" required>
          			</div>
          		</div>
          		<div class="col-4">
          			<label>Price: <i>(Regular)</i></label>
          			<input placeholder="Price (Regular)" type="number" name="regular" class="form-control form-control-sm" required>
          		</div>
          	</div>
          	<div class="row">
          		<div class="col-8">
          			<div class="">
          				<label>Description:</label>
          				<textarea  required placeholder="Description" name="description" class="form-control form-control-sm"></textarea>
          			</div>
          		</div>
          		<div class="col-4">
          			<label>Price: <i>(Medium)</i></label>
          			<input type="number" placeholder="Price (Medium)" name="medium" class="form-control form-control-sm" required>
          		</div>
          	</div>
          	<div class="row">
          		<div class="col-8">
          			<div class="form-group">
          				<label>Image:</label>
          				<div class="input-group">
						  <div class="input-group-prepend">
						  </div>
						  <div class="custom-file">
						    <input type="file" required name="image" class="custom-file-input" id="inputGroupFile01"
						      aria-describedby="inputGroupFileAddon01">
						    <label class="custom-file-label form-control-sm" for="inputGroupFile01">Choose file</label>
						  </div>
						</div>
          			</div>
          		</div>
          		<div class="col-4">
          			<label>Price: <i>(Large)</i></label>
          			<input type="number" placeholder="Price (Large)" name="large" class="form-control form-control-sm" required>
          		</div>
          	</div>
          	<div class="row">
          		<div class="col-4 mt-3">
          			<div class="form-group">
          				<button type="submit" name="add" class="btn-sm border-0 btn-primary"><span data-feather="plus"></span>ADD</button>
          			</div>
          		</div>
          	</div>
          </form>
      	  </div>
      	  <div class="col-6">
      	  	<div>
      	  		<img id="preview" src="./images/preview.png" height="220" width="500">
      	  	</div>
      	  </div>
      	  </div>
      	  <div class="row">
          	<div class="col-10 mt-5">
          		<?php 
          		if($error){
          		 ?>
          		 <div class="alert alert-danger"><?php echo $msg?></div>
          	<?php } ?>
          	<?php 
          		if($success){
          		 ?>
          		 <div class="alert alert-success"><?php echo $msg?></div>
          	<?php } ?>
            <?php 
              if(isset($_GET['updated'])){
               ?>
               <div class="alert alert-success">Successfully Updated!</div>
            <?php } ?>
          	</div>
          </div>
          </div>

    </main>
<?php include('footer.php') ?>
<script type="text/javascript">
	$(document).ready(function() {
		$('input[type="file"]').change(function(event) {
			var image = URL.createObjectURL(event.target.files[0]);
			$('#preview').attr('src', image);
		});
	});
</script>
</body>
</html>