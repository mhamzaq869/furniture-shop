<?php  require_once('include/header.php');
if(!isset($_SESSION['email'])){
  header('location: signin.php');
}
?>
<div class="container-fluid mt-2">
     <div class="row">
           <div class="col-md-3 col-lg-3">
            <?php require_once('include/sidebar.php'); ?>
           </div>

        <?php 
         if(!isset($_SESSION['email']))
         {
            header('location: signin.php');
          }
         ?>
        
              <div class="col-md-9 col-lg-9">
                <div class="row">
                  <div class="col-md-1">
                    <i class="fad fa-users fa-6x text-primary"></i>
                  </div>
                  <div class="col-md-11 text-left mt-4">
                      <h1 class="ml-5 display-4 font-weight-normal">View All Customers:</h1>
                  </div>
                </div>
                 <hr>
                 <table class="table table-responsive table-hover ">
                      <thead class="thead-light">
                          <tr>
                              <th>#Id</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Password</th>
                              <th>Address</th>
                              <th>City</th>
                              <th>Postal code</th>
                              <th>Contact Number</th>
                          </tr>
                      </thead>
                        <tbody>
                          <?php     
                            $query = "SELECT * FROM customer";
                            $run   = mysqli_query($con,$query);
                                        
                            if(mysqli_num_rows($run) > 0){
                              while($row = mysqli_fetch_array($run)){
                                $cust_id         = $row['cust_id'];
                                $cust_name       = $row['cust_name'];
                                $cust_email      = $row['cust_email'];
                                $cust_pass       = $row['cust_pass'];
                                $cust_add        = $row['cust_add'];    
                                $cust_city       = $row['cust_city'];
                                $cust_postalcode = $row['cust_postalcode'];
                                $cust_number     = $row['cust_number'];
                  
                            ?> 
                             <tr>
                                 <td >
                                     <?php echo $cust_id;?>
                                 </td>

                                 <td width="150px">
                                    <?php echo $cust_name;?>
                                 </td>

                                 <td>
                                    <?php echo $cust_email;?>
                                 </td>

                                 <td><input type="password" value="<?php echo $cust_pass;?>" disabled ></td>

                                 <td><?php echo $cust_add;?> </td>
                                 <td> 
                                 <?php echo $cust_city ?>  
                                 </td>
                                 <td><?php echo $cust_postalcode;?></td>
                                
                                 <td> <?php echo $cust_number;?></td>
                             </tr>   
                           <?php 
                               }

                            }else {
                                echo "<h2 class='text-center text-secondary'>Not Any Customer Registered Yet</h2>";
                                }
                    ?>
      
                      </tbody> 
                  </table>   
             </div>
     </div>
  </div>
      <?php 
 require_once('include/footer.php');
?>