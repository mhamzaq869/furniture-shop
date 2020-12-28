<?php include('include/header.php');


  if(isset($_GET['page'])){
    $page_id = $_GET['page'];
   }
   else{
    $page_id = 1;
  }

  $required_pro = 12;

  $query = "SELECT * FROM furniture_product Where status = 'publish' ORDER BY pid";
  $run   = mysqli_query($con,$query);
  $count_rows = mysqli_num_rows($run);

  $pages = ceil($count_rows / $required_pro);
  $product_start = ($page_id - 1) * $required_pro;  


  if(isset($_SESSION['id'])){
    $custid = $_SESSION['id'];
  
    if(isset($_GET['cart_id'])){
      $p_id = $_GET['cart_id'];
  
      $sel_cart = "SELECT * FROM cart WHERE cust_id = $custid and product_id = $p_id ";
      $run_cart    = mysqli_query($con,$sel_cart);
    
      if(mysqli_num_rows($run_cart) == 0){
        $cart_query = "INSERT INTO `cart`(`cust_id`, `product_id`,quantity) VALUES ($custid,$p_id,1)";    
        if(mysqli_query($con,$cart_query)){
          header("location:product.php");
        }
      }
     if(mysqli_num_rows($run_cart) > 0){
        while($row = mysqli_fetch_array($run_cart)){
          $exist_pro_id = $row['product_id'];
            if($p_id == $exist_pro_id){
             $error="<script>alert('⚠️ This product is already in your cart  '); </script>";
            }
          }
        }


      }
    }
    else if(!isset($_SESSION['email'])){
     echo "<script> function a(){alert('⚠️ Login is required to add this product into cart');}</script>";
    }
   

?>
      
      
  <div class="jumbotron">
    <h2 class="text-center mt-5">Choose Products</h2>
  </div>

   <div class="container mt-5">
       <div class="row">
            <div class="col-md-3 col-12">
                <div class="list-group">
                 <a href='product.php' class='list-group-item'><i class='fal fa-home ml-2'></i> Products </a>
                <?php  
                   $cat_query = "SELECT * FROM categories ORDER BY id ASC";
                   $cat_run   = mysqli_query($con,$cat_query);
                    if(mysqli_num_rows($cat_run) > 0){
                      While($cat_row = mysqli_fetch_array($cat_run)){
                        $cid      = $cat_row['id'];
                        $cat_name = ucfirst($cat_row['category']);
                        $font     = $cat_row['fontawesome-icon'];
                        echo " <a href='product.php?cat_id=$cid' class='list-group-item'><i class='fal $font ml-2'></i> $cat_name </a>";
                      }

                    }
                    else{
                      echo " <a class='list-group-item'> No Category </a>";
                    }

                   ?>
                </div>
            </div>

            <div class="col-md-9 col-12">
               <div class="row">
                  <div class="col-md-6"></div>
                   <div class="col-md-6">
                   <form method="post">
                    <div class="input-group">
                      <input type="text" class="form-control" name="search" placeholder="Search Products">
                      <div class="input-group-append">
                        <input class="btn btn-primary rounded-left" type="submit" name="sear_submit" vlaue="Search">
                      </div>
                     </div>
                    </form>
                    </div>
               </div>
        
               <?php 
               if(isset($msg)){
                 echo $msg;
               }
                else if(isset($error)){
                  echo $error;
                 }
              ?>
              
               <!----Product list-->
                <div class="row">
                
                <?php   
                   
                  if(isset($_GET['cat_id'])){
                      $catid = $_GET['cat_id'];
                      $cat_query = "SELECT * FROM categories WHERE id=$catid ORDER BY id ASC";
                      $run   = mysqli_query($con,$cat_query);
                      $row   = mysqli_fetch_array($run);
                      $catname=$row['category'];
                      
                      $p_query = "SELECT * FROM furniture_product WHERE category=$catid ORDER BY pid DESC LIMIT $product_start,$required_pro";  
                      
                  } else if(isset($_POST['sear_submit'])){
                      $search = $_POST['search'];
                      $p_query = "SELECT * FROM furniture_product WHERE title LIKE '%$search%' ";
                  }
                else{
                    $p_query = "SELECT * FROM furniture_product WHERE status='publish' ORDER BY pid DESC LIMIT $product_start,$required_pro";
                  }
                 
                  $p_run   = mysqli_query($con,$p_query);
                  
                  if(mysqli_num_rows($p_run) > 0 ){
                      while($p_row = mysqli_fetch_array($p_run)){
                       $pid      = $p_row['pid'];
                       $ptitle  = $p_row['title'];
                       $pcat    = $p_row['category'];
                       $p_price = $p_row['price'];
                       $size    = $p_row['size'];
                       $img1    = $p_row['image'];
                     ?>
                 
                    <div class="col-md-4 mt-4">
                        <img src="img/<?php echo $img1; ?>" class="hover-effect" width="100%" height="190px">
                            <div class="text-center mt-3">
                             <h5 title="<?php echo $ptitle; ?>"><?php echo substr($ptitle,0,20); ?>...</h5>
                              <h6>Rs. <?php echo $p_price; ?></h6>
                            </div>
                              
                             <div class="row">
                                  <div class="col-md-12 col-sm-12 col-12 text-center">
                                 
                                  <a href="product.php?cart_id=<?php echo $pid;?>" type="submit" onclick="a()" class="btn btn-primary btn-sm hover-effect">
                                      <i class="far fa-shopping-cart"></i>
                                  </a>
                                  <a href="product-detail.php?product_id=<?php echo $pid;?>" class="btn btn-default btn-sm hover-effect text-dark" >
                                       <i class="far fa-info-circle"></i> View Details
                                  </a>

                                  </div>
                            
                           </div>
                     </div>
                     
                    <?php  
                         }
                      }
                  else{
                    echo "<h3 class='text-center'> Products Are Not Available Yet </h3>";
                  }

                ?>
                </div>                               
                <!--end product list-->

                <!---Pagination-->
                <ul class="pagination pagination-md mt-5">
                 <?php for($i=1; $i <= $pages; $i++ ){
                            echo "<li class='page-item ".($i == $page_id ? ' active ' : '')."'><a class='page-link' href='product.php?page=$i'>$i</a></li>";
                        }?>
                </ul>
                <!---end pagination-->

             </div>
       </div>
   </div>
 <?php include('include/footer.php'); ?>