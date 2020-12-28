<?php
  require('../include/header.php');
  if(!isset($_SESSION['email'])){
    header('location: signin.php');
}
?>
<div class="container">
<section style="margin-top:100px;">
      <div class="row mt-5">
          <div class="col-md-6">
              <h3><b>Purpose of Author Account</b></h3>
              <br>
              <p style="font-size:20px;">
                  
                   This is Login Section That is for Authors who can sign in through it they can also post their new post on this blog.So,Basically we are giving you a right to submit your new journey or travel post to share your experience of your tours and tours guide like "How they can travel around the world without any interruption" So Let's Join Our Team By Registering Yourself and Get Access of Admin Panel By Sig in.
              </p>              
              
          </div>
          
          <div class="col-md-6">
            <!-- Default form login -->
            <?php
              
              if(isset($_POST['submit']))
              {
                  $name     = $_POST['name'];
                  $email    = $_POST['email'];
                  $number   = $_POST['number'];
                  $password = $_POST['password'];
                  
                  
                  $check_query = "SELECT * FROM user WHERE email='$email' LIMIT 1   ";
                 $check_run = mysqli_query($con,$check_query);
                 $row = mysqli_fetch_array($check_run);
                 $db_email = $row['email'];
                 $db_number = $row['p_number'];
                 
               
                if(empty($name) or empty($email) or empty($number) or empty($password)){
                    
                    $error = "All Fields Are Required"; 
                }  
            else{
                      
                   if($email != $db_email)
                          { 
                    if(filter_var("$email",FILTER_VALIDATE_EMAIL)){
                        
                       $query = "INSERT INTO user (name,email,password,p_number,role) VALUES('$name','$email','$password','$number','author')";
                          if(mysqli_query($con,$query)){
                        $msg = "<span style='color:green; font-weight:bold;'>You Have Been Registered! Now</span>";
                              
                                    } 
                               }
                       else{
                           $email_error = "This is invalid email";
                               }
                          }
             
                      else{
                        
                           $email_error="<span style='color:red; font-weight:bold;'>This Email is Already Exist </span>";
                      }
                    
             
                     
                  
                  }
              }
              
              ?>
        <form class="text-center border border-light p-5" method="post" action="#!">
           
           <p class="h4 mb-4">Sign up</p>
            <?php if(isset($error)){
               echo "<span style='color:red; font-weight:bold;'><i style='color:red; font-weight:bold;' class='fas fa-frown'></i> $error</span>";
                    }
               else if(isset($msg)){
               echo $msg;
                    }
            ?>
            <div class="form-row mb-4">
                <div class="col-12">
                    <!-- First name -->
                    <input type="text"  name="name"  id="defaultRegisterFormFirstName" class="form-control" placeholder="Full Name">
                </div>

            </div>

    <!-- E-mail -->
    <?php 
            if(isset($email_error)){
                echo "<span style='color:red; font-weight:bold;'>$email_error</span>";
            }
            ?>
    <input type="email"  name="email" id="defaultRegisterFormEmail" class="form-control mb-4" placeholder="E-mail">
     
    <!-- Password -->
    <input type="password"  name="password" id="defaultRegisterFormPassword" class="form-control" placeholder="Password" aria-describedby="defaultRegisterFormPasswordHelpBlock">
    <small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
        At least 8 characters and 1 digit
    </small>

    <!-- Phone number -->
    <input type="number" name="number" id="defaultRegisterPhonePassword" class="form-control" placeholder="Phone number" aria-describedby="defaultRegisterFormPhoneHelpBlock">
    <small id="defaultRegisterFormPhoneHelpBlock" class="form-text text-muted mb-4">
        Optional - for two step authentication
    </small>

    <input class="btn btn-info my-3 btn-block" type="submit"  name="submit" value="Sign up">

     <p>Already Member
        <a href="../login.php">Sign in</a>
    </p>

        </form>

          </div>
      </div>
</section>
</div>
<?php
  require('../include/footer.php');
?>

