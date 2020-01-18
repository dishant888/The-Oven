<?php 
include('config.php');
$currentPage = 'add_pizza';
$id = $_GET['id'];
$name='';
$desc='';
$regular='';
$medium='';
$large='';
$image='';

$query = "SELECT * FROM `pizzas` WHERE `id`=$id";
$rows = mysqli_query($con,$query);
foreach ($rows as $row) {
  $name = $row['name'];
  $desc = $row['description'];
  $regular = $row['regular'];
  $medium = $row['medium'];
  $large = $row['large'];
  $image = $row['image'];
}
  if(isset($_POST['save'])){

    $id = $_POST['pizza_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $regular = $_POST['regular'];
    $medium = $_POST['medium'];
    $large = $_POST['large'];
    $source = $_FILES['image']['tmp_name'];
    $destination = 'pizza/'.$_FILES['image']['name'];

    if(!empty($destination) && !empty($source)){
      $query = "UPDATE `pizzas` SET `name`='$name',`description`='$description',`regular`=$regular,`medium`=$medium,`large`=$large,`image`='$destination' WHERE `id`=$id";
      move_uploaded_file($source, $destination);
      //echo $query;exit;
      mysqli_query($con,$query);
      header('location:add_pizza.php?updated=true');
    }else{
      $query = "UPDATE `pizzas` SET `name`='$name',`description`='$description',`regular`=$regular,`medium`=$medium,`large`=$large WHERE `id`=$id";
      //echo $query;exit;
      mysqli_query($con,$query);
      header('location:add_pizza.php?updated=true');
    }
  }
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>EDIT PIZZA</title>
</head>
<body>
<?php include('header.php') ?>
	<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">EDIT PIZZA</h1>
          </div>

          <div class="container">
          	<div class="row">
          		<div class="col-6">
          	<form action="edit_pizza.php" method="post" enctype="multipart/form-data">
          	<div class="row">
          		<div class="col-8">
          			<div class="form-group">
          				<label>Pizza Name:</label>
          				<input type="text" value="<?=$name?>" name="name" class="form-control form-control-sm" required>
                  <input type="hidden" name="pizza_id" value="<?=$id?>">
          			</div>
          		</div>
          		<div class="col-4">
          			<label>Price: <i>(Regular)</i></label>
          			<input value="<?=$regular?>" type="number" name="regular" class="form-control form-control-sm" required>
          		</div>
          	</div>
          	<div class="row">
          		<div class="col-8">
          			<div class="">
          				<label>Description:</label>
          				<textarea  required name="description" class="form-control form-control-sm"><?=$desc?></textarea>
          			</div>
          		</div>
          		<div class="col-4">
          			<label>Price: <i>(Medium)</i></label>
          			<input type="number" value="<?=$medium?>" name="medium" class="form-control form-control-sm" required>
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
						    <input type="file" name="image" class="custom-file-input" id="inputGroupFile01"
						      aria-describedby="inputGroupFileAddon01">
						    <label class="custom-file-label form-control-sm" for="inputGroupFile01">Choose file</label>
						  </div>
						</div>
          			</div>
          		</div>
          		<div class="col-4">
          			<label>Price: <i>(Large)</i></label>
          			<input type="number" value="<?=$large?>" name="large" class="form-control form-control-sm" required>
          		</div>
          	</div>
          	<div class="row">
          		<div class="col-4 mt-3">
          			<div class="form-group">
          				<button type="submit" name="save" class="btn-sm border-0 btn-success"><span data-feather="check" class="mr-1"></span>SAVE</button>
          			</div>
          		</div>
          	</div>
          </form>
      	  </div>
      	  <div class="col-6">
      	  	<div>
      	  		<img id="preview" src="./<?=$image?>" height="220" width="500">
      	  	</div>
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