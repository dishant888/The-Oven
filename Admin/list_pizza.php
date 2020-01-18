<?php 
include('config.php');
$currentPage = 'list_pizza';
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>LIST</title>
</head>
<body>
<?php include('header.php') ?>
	<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">LIST</h1>
          </div>
          <div class="container">
          	<div class="col-12 table-responsive">
          		<table class="table table-bordered table-hover">
          			<thead>
          				<tr>
          					<td style="width: 3%">#</td>
          					<td style="width: 18%">Name</td>
          					<td style="width: 35%">Description</td>
          					<td style="width: 13%">Price</td>
          					<td>Image</td>
          					<td style="width: 4%">Actions</td>
          				</tr>
          			</thead>
          			<tbody>
          				<?php 
          					$query = "SELECT * FROM `pizzas`";
          					$i=0;
          					$result = mysqli_query($con,$query);
                                   if(mysqli_num_rows($result)>0){
          					foreach($result as $row):
          				 ?>
          				 <tr>
          				 	<td><?=++$i?></td>
          				 	<td><?= $row['name'] ?></td>
          				 	<td><?= $row['description'] ?></td>
          				 	<td>
          				 		<?php 
          				 			echo '₹'.$row['regular'].' <i>(Regular)</i>'.'<br>'; 
          				 			echo '₹'.$row['medium'].' <i>(Medium)</i>'.'<br>'; 
          				 			echo '₹'.$row['large'].' <i>(Large)</i>'; 
          				 		?>	
          				 	</td>
          				 	<td align="center">
          				 		<img src="<?= $row['image'] ?>" height="75" width="170">
          				 	</td>
          				 	<td align="center">
          				 		<a href="edit_pizza.php?id=<?=$row['id']?>">Edit</a><br>
          				 		<a onclick="return confirm('Are you Sure?')" href="delete_pizza.php?id=<?=$row['id']?>">Delete</a>
          				 	</td>
          				 </tr>
          				<?php endforeach;}else{ ?>
                                   <tr>
                                        <td colspan="10" align="center"><h2 class="display-4" style="font-size: 35px;">No Data</h2></td>
                                   </tr>
                              <?php } ?>
          			</tbody>
          		</table>
          		<br>
          	</div>
          </div>
    </main>
<?php include('footer.php') ?>
</body>
</html>