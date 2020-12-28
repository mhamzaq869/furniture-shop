<?php 
include('include/header.php');

if(!isset($_SESSION['email'])){
    header('location:../sign-in.php');
}

if(isset($_SESSION['email'])){
  
    $customer_id    = $_SESSION['id'];

    $query = "SELECT * FROM customer WHERE cust_id=$customer_id";
    $run   = mysqli_query($con,$query);
    $row = mysqli_fetch_array($run);

    $cust_name = $row['cust_name'];
    $cust_email = $row['cust_email'];
    $cust_add = $row['cust_add'];
    $cust_city = $row['cust_city'];
    $cust_pcode = $row['cust_postalcode'];
    $cust_number = $row['cust_number'];

    
    if(isset($_POST['update'])){
      $fullname = $_POST['fullname'];
     echo $email    = $_POST['email'];
      $address  = $_POST['address'];
      $city     = $_POST['city'];
      $code     = $_POST['code'];
      $number   = $_POST['phone_number'];
       
      $up_query = "UPDATE `customer` SET `cust_name`='$fullname',
     `cust_add`='$address',`cust_city`='$city',`cust_postalcode`='$code',`cust_number`='$number' 
       WHERE cust_id=$customer_id ";
       if(mysqli_query($con,$up_query)){

        $_SESSION['msg']="<div class='alert alert-success alert-dismissible fade show pt-1 pb-1 pl-3'  role='alert'>
          <strong><i class='fas fa-check-circle'></i> Congratulation! </strong>Your Account has been updated.
          <button type='button' class='close p-2' data-dismiss='alert' aria-label='Close'>
           <span  aria-hidden='true'>&times;</span>
          </button>
           </div>";
           header('location:personal-detail.php');
       }
      }
}

?>






<div class="jumbotron bg-secondary">
   <h1 class="text-center text-white mt-5">Personal Detail</h1>
 </div>

<div class="container mt-5">
    <div class="row">

     <div class="col-md-3">
     <?php include('include/sidebar.php');?>
     </div>

     <div class="col-md-9">
       <h3>Personal Details:</h3><hr>
       <h6>CHANGE PERSONAL DETAILS</h6>
        <p>You can access and modify your personal details (name, billing address, telephone number, etc.) 
          in order to facilitate your future
           purchases and to notify us of any change in your contact details.</p>
          
          <?php 
          
               if(isset($_SESSION['msg'])){
                 echo $_SESSION['msg'];
                }
               ?>
            
          <form method="post" class="w-75">
            
            <div class="form-group ">
              <input type="text" name="fullname" placeholder="Full Name" value="<?php echo $cust_name;?>" class="form-control" >
             </div>

            <div class="form-group">
              <input type="text" name="email" placeholder="Email" class="form-control" value="<?php echo $cust_email;?>" disabled>
             </div>
          

              <div class="form-group">
                <input type="text" name="address" placeholder="Address" value="<?php echo $cust_add;?>" class="form-control" >
            </div>
             
            <div class="row">
              <div class="col-md-6 col-6">
                <div class="form-group">
                  <input type="text" name="city" placeholder="City" value="<?php echo $cust_city;?>" class="form-control" >
               </div>
              </div>
              
              <div class="col-md-6 col-6">
                <div class="form-group">
                  <input type="number" name="code" placeholder="Postal code" value="<?php echo $cust_pcode;?>" class="form-control" >
               </div>
              </div>

            </div>

            <div class="form-group">
              <input type="number" name="phone_number" placeholder="Phone Number" value="<?php echo $cust_number;?>" class="form-control" >
           </div>

              <div class="form-group text-center mt-4">
                <input type="submit" name="update" class="btn btn-primary" value="Update">
              </div>

          </form> 
        
      </div>
    </div>
</div>

        
<?php include('include/footer.php');?>