<?php 
session_start();
if(!$_SESSION['admin_id']){
  header('location:login.php');
}

?>
     <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="./css/dashboard.css" rel="stylesheet">


    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" style="font-size: 23px" href="index.php">
        <img src="./images/logo.png" height="30" width="40">
      The Oven</a>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="logout.php">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link <?php if($currentPage == 'index'){echo 'active'; }?>" href="index.php">
                  <span data-feather="home"></span>
                  Dashboard <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php if($currentPage == 'add_pizza'){echo 'active'; }?>" href="add_pizza.php">
                  <span data-feather="plus"></span>
                  Add Pizza
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php if($currentPage == 'list_pizza'){echo 'active'; }?>" href="list_pizza.php">
                  <span data-feather="list"></span>
                  Pizza List
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php if($currentPage == 'orders'){echo 'active'; }?>" href="orders.php">
                  <span data-feather="file"></span>
                  Orders
                </a>
              </li>
            </ul>
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Account Setting</span>
              <span class="d-flex align-items-center text-muted">
                <span data-feather="plus-circle"></span>
              </span>
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <a class="nav-link <?php if($currentPage == 'change_password'){echo 'active'; }?>" href="change_password.php">
                  <span data-feather="lock"></span>
                  Change Password
                </a>
              </li>
            </ul>
          </div>
        </nav>