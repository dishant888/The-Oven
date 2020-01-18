<?php 
session_start();
unset($_SESSION['admin_id']);
include('config.php');
$status=false;
$message='';

  if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username == '' || $password == ''){

      $status = true;
      $message = 'Please Fill All Fields';

    }else{

      $query = "SELECT * FROM `admins` WHERE `username` = '$username' AND `password` = '$password'";
      // echo $query;exit;
      $result = mysqli_query($con,$query);
      if(mysqli_num_rows($result) != 0){

        while($row = mysqli_fetch_array($result)){
          $_SESSION['admin_id'] = $row['id'];
        }

      }else{

        $status = true;
        $message = 'Invalid Credentials';

      }

      if(isset($_SESSION['admin_id']))
      {
        header('location:index.php');
      }

    }

  }

 ?>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Signin</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="./css/sign-in.css" rel="stylesheet">
  </head>

  <body class="text-center" style="background-color: white">

    <form class="form-signin border rounded shadow" method="post" action="login.php" style="background-color: ">

      <img class="mb-4" src="./images/logo.png" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Admin Sign-in</h1>
      <label for="inputEmail" class="sr-only">Username</label>

      <input type="text" id="inputEmail" name="username" class="form-control" placeholder="Username"  autofocus>

      <label for="inputPassword" class="sr-only">Password</label>

      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" >

      <button class="mb-3 btn btn-lg btn-primary btn-block" name="login" type="submit">Sign in</button>

      <?php if($status){
        ?>
        <div class="alert alert-danger"><?=$message?></div>
        <?php
      } ?>

      <p class="mt-2 mb-3 text-muted">Welcome to The Oven!</p>

    </form>

  </body>
</html>
