<?php include("include/header.php");
if(!isset($_SESSION['email'])){
    header('location: signin.php');
}
?>

<div class="container-fluid mt-2">
    <div class="row">
        <div class="col-md-3">
            <?php include("include/sidebar.php");?>
        </div>
        
        <div class="col-md-9">

            <div class="row">
              <div class="col-md-1">
                <i class="fad fa-truck fa-6x text-primary"></i>
              </div>
              <div class="col-md-11 text-left mt-4">
               <h1 class="ml-5 display-4 font-weight-normal">Delivered Orders:</h1>
              </div>
            </div>
           <hr>

        <table class="table table-responsive table-hover ">
                      <thead class="thead-light">
                          <tr>
                              <th>#Invoice No.</th>
                              <th>Order ID</th>
                              <th>Product_id</th>
                              <th>Product Image</th>
                              <th>Product Category</th>
                              <th>Customer Id</th>
                              <th>Customer Email</th>
                              <th>Price (Pkr)</th>
                              <th>Quantity</th>
                              <th>Order_Status</th>
                              <th>Order_Date</th>
                             
                              
                          </tr>
                      </thead>
                        <tbody class="text-center">
                          <?php
                                    $order_query = "SELECT * FROM customer_order WHERE order_status='delivered'";
                                    $run = mysqli_query($con,$order_query);
                        
                                    if(mysqli_num_rows($run) > 0){
                                        while($order_row = mysqli_fetch_array($run)){
                                            $order_invoice = $order_row['invoice_no'];
                                            $order_id      = $order_row['order_id'];
                                            $cust_id       = $order_row['customer_id'];
                                            $cust_email    = $order_row['customer_email'];
                                            $order_pro_id  = $order_row['product_id'];
                                            $order_qty     = $order_row['products_qty'];
                                            $order_amount  = $order_row['product_amount'];
                                            $order_date    = $order_row['order_date'];
                                            $order_status  = $order_row['order_status'];


                                            $pr_query = "SELECT * FROM furniture_product fp INNER JOIN categories cat ON fp.category = cat.id WHERE pid = $order_pro_id ";
                                                $pr_run   = mysqli_query($con,$pr_query);
                                                
                                                if(mysqli_num_rows($pr_run) > 0){
                                                    while($pr_row = mysqli_fetch_array($pr_run)){
                                                    $pid   = $pr_row['pid'];
                                                    $image = $pr_row['image'];
                                                    $category = $pr_row['category'];
                                              
                            ?> 
                             <tr>
                                 <td>
                                 <?php echo $order_invoice;?>
                                 </td>
                                 <td>
                                 <?php echo $order_id;?>
                                 </td>
                                 <td>
                                     <?php echo $order_pro_id;?>
                                 </td>
                                 <td width="120px">
                                     <img src="img/<?php echo $image;?>" width="100%">
                                 </td>
                                 <td>
                                     <?php echo $category;?>
                                 </td>
                                 <td>
                                    <?php echo $cust_id;?>
                                 </td>
                                 <td>
                                    <?php echo $cust_email;?>
                                 </td>
                                 <td>
                                    <?php echo $order_amount;?>
                                 </td>

                                 <td><?php echo $order_qty;?></td>

                                <td><?php echo"<i class='fad fa-truck text-primary'></i> ".ucfirst($order_status);?></td>
                                <td><?php echo $order_date;?></td>
                             </tr>   
                           <?php 
                                  }
                                }
                              }

                            }else {
                                echo "<tr><td colspan='12'><h2 class='text-center text-secondary'>You have not delivered any order</h2></td></tr>";
                               
                                }
                        
                     
                    
                    ?>
                              
                          
                      </tbody>
                    </form>
                  </table>

        </div>



    </div>
</div>
<?php include("include/footer.php"); ?>