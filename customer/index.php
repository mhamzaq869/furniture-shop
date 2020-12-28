<?php include('include/header.php'); 

if(!isset($_SESSION['email'])){
    header('location:../sign-in.php');
}
?>
   
    <div class="jumbotron bg-secondary">
        <h1 class="text-center text-white mt-5">Account</h1>
    </div>
     
     <div class="container mt-5 mb-5">
      
      <div class="row">

         <div class="col-md-3">
         <?php include('include/sidebar.php');?>
        </div>

         <div class="col-md-9">
          <h3>My Account:</h3><hr>

          <a href="orders.php"> <h6 class="text-primary">ORDERS</h6></a>
           <p>Check the status and information regarding your online orders</p>

           <a href="personal-detail.php"> <h6 class="text-primary">PERSONAL DETAILS</h6></a>
           <p>You can access and modify your personal details (name, billing address, telephone number, etc.) in order to speed up your
              future purchases and notify us of changes in your contact details.</p>

           <a href="access-detail.php"> <h6 class="text-primary">ACCESS DETAILS</h6></a>
           <p>You can change your access details (password ).</p>

         </div>
       </div>

     </div>
      
   

<?php include('include/footer.php') ?>