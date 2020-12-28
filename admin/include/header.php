<?php 
ob_start();
session_start();
require_once('include/dbcon.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Furniture Shop Management System | Admin - Dashboard</title>

  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/all.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  
</head>

<body id="page-top">
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <a class="navbar-brand" href="index.php">Admin</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="../index.php" target="_blank"><i class="fas fa-store"></i> Furniture Shop </a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="furniture_pro.php"><i class="fas fa-plus"></i> Add Furniture Product</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="category.php"><i class="fas fa-border-all"></i> Add Categories</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="customers.php"><i class="fas fa-user"></i> View customers</a>
      </li>    
      
       <li class="nav-item">
        <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
      </li>   
       <?php 
         if(isset($_SESSION['email']) )
         {
             $session_email = $_SESSION['email'];
             $query ="SELECT image from admin WHERE email='$session_email'";
             $run = mysqli_query($con,$query);
             $row = mysqli_fetch_array($run);
             $image = $row['image'];
            }
         ?>
       <li class="nav-item">
        <a class="nav-link" href="profile.php"><img src="img/<?php echo $image;?>" alt="user" class="rounded-circle" width="37px" height="32px"></a>
      </li>
      
    </ul>
  </div>  
</nav>