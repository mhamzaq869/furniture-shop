<?php include('include/header.php'); ?>
        
        <div class="jumbotron bg-primary">
            <h2 class="text-center mt-5 text-white">Edit Cart</h2>
        </div>
        
        <div class="container">
        <?php  
        if(isset($_SESSION['id'])){
            $customer_id = $_SESSION['id'];
            
            if(isset($_GET['cart_id'])){
                $edit_cart = $_GET['cart_id'];
            
                //update Query
                if(isset($_POST['update'])){
                
                    $qty = $_POST['Qty'];

                    $up_query = "UPDATE cart SET quantity=$qty  WHERE product_id = $edit_cart";
                    $run = mysqli_query($con,$up_query);
                }
                //end update Query

            //cart Query
            $cart = "SELECT * FROM cart WHERE cust_id='$customer_id' and product_id ='$edit_cart'";
            $run  = mysqli_query($con,$cart);
            
          
            $sub_total=0;
            $shipping_cost = 0;
            $total = 0;

            ?>
          <div class="row">
               <!--shopping cart-->
            <div class="col-md-9 p-3">
                  <h5>Shopping Cart</h5>
                  <p class="text-right" style="margin-top:-30px"><a href="cart.php"><i class="fas fa-shopping-cart"></i> Go to Cart</a> </p>
                  <hr>
                  <form  method="post">

                    <table class="table table-responsive ">
                        <thead class="thead-light">
                            <tr>
                                <th colspan="2">Product Detail</th>
                                <th>Quantity</th>
                                <th>Price (Pkr)</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        
                            <tbody>
                            <?php

                                    if(mysqli_num_rows($run) > 0){
                                        while($cart_row = mysqli_fetch_array($run)){
                                            $db_cust_id = $cart_row['cust_id'];
                                            $db_pro_id  = $cart_row['product_id'];
                                            $db_pro_qty  = $cart_row['quantity'];
                                
                                            $pr_query = "SELECT * FROM furniture_product WHERE pid=$db_pro_id";
                                            $pr_run   = mysqli_query($con,$pr_query);
                                            
                                            if(mysqli_num_rows($pr_run) > 0){
                                                $pr_row = mysqli_fetch_array($pr_run);

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
                                        <input type="number" class="form-control" name="Qty" value="<?php echo $db_pro_qty;?>"> 
                                    </td>
                                    <td><?php echo $pr_row['price'];?></td>

                                    <td><?php echo $single_pro_total_price;?> </td>
                                    
                                </tr>   
                            <?php 
                                

                                }
                            }
                        }
                       
                        
                        
                        ?>
                        
                            
                        </tbody>
                        
                    
                    </table>

                   <input type="submit" name="update" class="btn btn-primary float-right" value="update">

                  </form>
            </div>
                <!--end cart--->

                <!---total price-->
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
                <!---end total price-->

           </div>
           <!----end Row---->
           
           
                <?php  }
                } 
                ?>
        </div>

  <?php include('include/footer.php');?>