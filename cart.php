<?php include('include/header.php'); ?>
        
        <div class="jumbotron b">
            <h2 class="text-center mt-5">Cart</h2>
        </div>
        
        <?php  
        if(isset($_SESSION['id'])){
            $customer_id = $_SESSION['id'];
            
              //Delete Query
              if(isset($_GET['pid'])){

                $proid = $_GET['pid'];

            $del_query = "DELETE FROM cart WHERE product_id = $proid and cust_id = $customer_id";
             if(mysqli_query($con,$del_query)){
                header("location:cart.php");
              }
            }
            //end delete Query
            //cart Query
            $cart = "SELECT * FROM cart WHERE cust_id='$customer_id'";
            $run  = mysqli_query($con,$cart);
            
          
            $sub_total=0;
            $shipping_cost = 0;
            $total = 0;
            if(mysqli_num_rows($run) > 0){
            ?>

        <div class="container">
       
          <div class="row">
               <!--shopping cart-->
            <div class="col-md-9 p-3">
                  <h5>Shopping Cart</h5><hr>
                  <table class="table table-responsive table-hover ">
                      <thead class="thead-light">
                          <tr>
                              <th colspan="2">Product Detail</th>
                              <th>Quantity</th>
                              <th>Price (Pkr)</th>
                              <th>Total</th>
                              <th colspan="4">Actions(Edit/Del)</th>
                              <th colspan="4"></th>
                          </tr>
                      </thead>
                      <form >
                        <tbody>
                          <?php

                                
                                    while($cart_row = mysqli_fetch_array($run)){
                                        $db_cust_id = $cart_row['cust_id'];
                                        $db_pro_id  = $cart_row['product_id'];
                                        $db_pro_qty  = $cart_row['quantity'];
                            
                                        $pr_query = "SELECT * FROM furniture_product WHERE pid=$db_pro_id";
                                        $pr_run   = mysqli_query($con,$pr_query);
                                        
                                        if(mysqli_num_rows($pr_run) > 0){
                                            while($pr_row = mysqli_fetch_array($pr_run)){
                                              $pid = $pr_row['pid'];
                                              $title = $pr_row['title'];
                                              $price = $pr_row['price'];
                                              $arrPrice = array($pr_row['price']);    
                                              $size = $pr_row['size'];
                                              $img1 = $pr_row['image'];
                                              
                                              $single_pro_total_price = $db_pro_qty * $price;
                                              $pro_total_price = array($db_pro_qty * $price);  

                                            //   $values = array_sum($arrPrice);
                                              $shipping_cost=0;
                                              $values = array_sum($pro_total_price);
                                              $sub_total +=$values;
                                              $total = $sub_total + $shipping_cost;
                                              
                            ?> 
                             <tr>
                                 <td width="150px">
                                     <img src="img/<?php echo $img1;?>" width="100%">
                                 </td>
                                 <td>
                                    <h5><?php echo $title;?></h5>
                                    <p> Dimension: <?php echo $size;?></p>
                                 </td>
                                 <td>
                                    x <?php echo $db_pro_qty;?>
                                 </td>
                                 <td><?php echo $pr_row['price'];?></td>

                                 <td><?php echo $single_pro_total_price;?> </td>
                                 <td colspan="20" class="text-center"> 
                                 <?php 
                                   
                                   
                                   ?>
                                    <a title="Edit Product" href="edit_cart.php?cart_id=<?php echo $pid; ?> " class="btn btn-primary btn-sm">
                                    <i class="fal fa-edit"></i>
                                    </a>

                                    <a title="Delete Product" href="cart.php?pid=<?php echo $pid; ?> " class="btn btn-danger btn-sm">X </a>  
                                 </td>
                             </tr>   
                           <?php 
                               }

                            }else {
                                echo "<h2 class='text-center text-secondary'>Your Cart is Empty</h2>";
                                }
                        }
                     
                    
                    ?>
                              
                          
                      </tbody>
                    </form>
                  </table>

                   
                </div>
                <!--end cart--->
                
                <!--order Detail-->
            <div class="col-md-3 p-3">
               <h5>Order Detail</h5><hr>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-6">
                        <h6>Subtotal</h6>
                        <h6>Shipping</h6>
                        <h5 class="font-weight-bold">Total</h5>
                        
                    </div>
                    <div class="col-md-6 col-sm-6 col-6">
                        <h6 class="text-right font-weight-normal">PKR <?php echo $sub_total;?></h6>
                        <h6 class="text-right font-weight-normal">PKR <?php echo $shipping_cost;?></h6>
                        <h5 class="text-right font-weight-bold">PKR <?php echo $total;?></h5>
                    </div>
                </div>
                
            </div>
                <!--end order--->
          </div>
               

        <div class="container ">
         
                  <div class="row">
                     <div class="col-md-5 col-6 text-left">
                       <a href="product.php">
                        <input class="btn btn-primary pt-2 pb-2" type="button" style="font-size:12px;" value="Continue Shopping">
                        </a>
                     </div>
                     <div class="col-md-4 col-6 text-right">
                         <a href="checkout.php">
                            <input type="button" name="proceed" value="Proceed checkout" style="font-size:12px;" class="btn btn-success pt-2 pb-2">
                         </a>
                     </div>
                  </div>
       </div>

      </div>
       <?php }
              else{
                echo "<h2 class='text-center text-secondary mt-5' style='height:57vh; font-size:48px;'><i class='fad fa-shopping-cart text-primary'></i> Your Cart is Empty</h2>";
              }
                     
           } else {
            echo " <h2 class='text-center text-secondary mt-5' style='height:57vh; font-size:48px; '><i class='fad fa-shopping-cart text-primary'></i> Your Cart is Empty</h2>";
            }
          ?>
        
       

        
   <?php include('include/footer.php');?>