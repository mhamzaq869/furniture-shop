<?php
include('include/header.php'); ?>

        <div class="container sign-in-up">
          <div class="row mb-5" >
            <div class="col-md-6" >
              <h1>Online Furniture Store</h1>
              <p>An online furniture shop that allows users to check for various furniture available at the online 
                store and purchase online. The project consists of list of furniture products displayed in various
                 models and designs. The user may browse through these products as per categories. If the user likes 
                 a product he may add it to his shopping cart. Once user wishes to checkout he must 
                register on the site first. He can then login using same id password next time.</p>
            </div>
            
            
            <div class="col-md-6" style="height:66.5vh;">
              <div class="card">
                <div class="card-body">
                  <h1 class="text-center mt-5">Sign in</h1>
                  
                  <form method="post" class="mt-5 p-3">

                   <?php if(isset($_POST['signin'])){
                        $email     = mysqli_real_escape_string($con,$_POST['email']);    
                        $password  = mysqli_real_escape_string($con,$_POST['password']);    
                        
                        $query = "SELECT * FROM customer";
                        $run   = mysqli_query($con,$query);
                        
                        if(mysqli_num_rows($run) > 0 ){
                           while($row = mysqli_fetch_array($run)){

                            $db_cust_id    = $row['cust_id'];
                            $db_cust_name  = $row['cust_name'];
                            $db_cust_email = $row['cust_email'];
                            $db_cust_pass  = $row['cust_pass'];
                            $db_cust_add   = $row['cust_add'];
                            $db_cust_city  = $row['cust_city'];
                            $db_cust_pcode = $row['cust_postalcode'];
                            $db_cust_number= $row['cust_number'];

                            if($email == $db_cust_email && $password == $db_cust_pass){
                                $_SESSION['id']    = $db_cust_id;
                                $_SESSION['name']  = $db_cust_name;
                                $_SESSION['email'] = $db_cust_email;
                                $_SESSION['add']   = $db_cust_add;
                                $_SESSION['city']  = $db_cust_city;
                                $_SESSION['pcode'] = $db_cust_pcode;
                                $_SESSION['number']= $db_cust_number;
                                
                                header('location:customer/index.php'); 

                            } 
                            else{
                              $error="Invalid Email or Password";
                            }
                           }
                          } 
                          else{
                            $error="This account doesn't exist";
                          }
                            
                         
                        
                      }
                        
                      ?>
                      
                         <?php
                      if(isset($error)){
                      
                        echo "<div class='alert bg-danger' role='alert'>
                                <span class='text-white text-center'> $error</span>
                                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                  </button>
                              </div>";
                    
                        }
                      
                      ?>

                      
                    <div class="form-group">
                      <input type="text" name="email" placeholder="Email" class="form-control" required>
                     </div>
                     <div class="form-group">
                    <input type="password" name="password" placeholder="password" class="form-control" required>
                    </div>
                      
                    <a href="#" > Forget Password?</a>

                      <div class="form-group text-center mt-4">
                        <input type="submit" name="signin" class="btn btn-primary" value="Sign in">
                      </div>

                      <div class="text-center mt-4"> Not a Member Yet <a href="register.php"> Register </a></div>

                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
   
  <?php include('include/footer.php'); ?>