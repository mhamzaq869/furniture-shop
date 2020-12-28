<?php
  require('../include/header.php');
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
        <form class="text-center border border-light p-5" method="post" action="#!">
          <?php
            // getting input from user
            if(isset($_POST['submit'])){
                $email = $_POST['email'];
                $password = $_POST['password'];
                
                //fetching Data from database
                $query = "SELECT * FROM user WHERE email='$email' ORDER BY id";
                $run = mysqli_query($con,$query);
                $row=mysqli_fetch_array($run);
                $db_email = $row['email'];
                //ending fecthing data from database
                
                if(empty($email) or empty($password)){
                    $error= "Email Or Password Cannot Empty";
                }
                else{
                    if($db_email != $email ){
                        $error = "Wrong! Email Address";
                    }
                    else{
                        $u_query = "UPDATE user SET password='$password' WHERE email='$email' ";
                        if(mysqli_query($con,$u_query) == true)
                        {
                            $msg= "Password Has Been Changes Successfully!";
                        }
                        
                    }
                }
                
            }
            
            
            ?>
           
           <p class="h4 mb-4">Forgot Password</p>

     <?php if(isset($error)){
            echo "<span style='color:red; font-weight:bold;'><i style='color:red; font-weight:bold;' class='fas fa-frown'></i> $error</span>";
            }
            elseif(isset($msg)){
            echo "<span style='color:green; font-weight:bold;'><i style='color:red; font-weight:bold;' class='fas fa-frown'></i> $msg</span>";
            }
            
            ?>
    <!-- E-mail -->
    <input type="email" name="email" id="defaultRegisterFormEmail" class="form-control mb-4" placeholder="E-mail">
    
    <!-- Password -->
    <input type="password" name="password" id="defaultRegisterFormPassword" class="form-control" placeholder="Password" aria-describedby="defaultRegisterFormPasswordHelpBlock">
    <small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
        At least 8 characters and 1 digit
    </small>

  

    <input class="btn btn-info my-3 btn-block" type="submit"  name="submit" value="Sign in">

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

