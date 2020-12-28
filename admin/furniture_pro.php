<?php 
 require_once('include/header.php');
 if(!isset($_SESSION['email'])){
  header('location: signin.php');
}
if(isset($_SESSION['email'])){
    $session_id = $_SESSION['id'];
    $session_email = $_SESSION['email'];
    $session_name = $_SESSION['name'];
}
?>



<div class="container-fluid mt-2">
    <script src="ckeditor/ckeditor.js"></script>
      <div class="row">
        <div class="col-md-3 col-lg-3">
            <?php require_once('include/sidebar.php'); ?>
        </div>
        
        <div class="col-md-9 col-lg-9">
          <form method="post" enctype="multipart/form-data">
             <?php
                    if(isset($_POST['submit'])){ 
                    $title      = $_POST['title'];
                    $size       = $_POST['size'];
                    $price      = $_POST['price'];
                    $date       = date("d-m-Y");
                    $status     = $_POST['status'];
                    $category   = $_POST['category'];
                    $detail     = $_POST['detail'];
                    $image      = $_FILES['upload']['name'];
                    $tmp_image  = $_FILES['upload']['tmp_name'];
                        
                    if(!empty($title) or !empty($size) or !empty($price) or !empty($status) or !empty($category) or !empty($detail) or !empty($image)){
                     $query = "INSERT INTO furniture_product(`title`, `category`, `size`, `price`, `detail`, `image`, `date`, `status`)
                      VALUES('$title',$category,'$size',$price,'$detail','$image','$date','$status')";
                     
                        if(mysqli_query($con,$query)){
                            $path = "img/".$image;
                            
                            if(move_uploaded_file($tmp_image,$path) == true){
                                copy($path,"../".$path);
                              
                                $msg = "Furniture Product Has Been Published";
                            }
                        }
                                              
                    }
                                   
                }

                 if(isset($msg)){
                  echo "<span class='mt-3 mb-4' style='color:green; font-weight:bold;'><i style='color:green; font-weight:bold;' class='fas fa-smile'></i> $msg</span>";
                 }
                    ?>
       
            <div class="row">
                <?php if(isset($message)){
                        echo "<p style='color:green; font-weight:bold;'>$message</p>";
                    } else if(isset($error)){
               echo "<span style='color:red; font-weight:bold;'><i style='color:red; font-weight:bold;' class='fas fa-frown'></i> $error</span>";
                    }?>
                    <!-- Grid column -->
                    <div class="col-md-12">
                      <div class="form-group">
                       <label for="furniture">Furniture Product Title:</label>
                       <input type="text" class="form-control" name="title" id="inputEmail4MD" placeholder="Title">
                      </div>
                    </div>
                  
            </div>
                  
              <div class="row">
                    <div class="col-md-3">
                      <label for="category">Category:</label>
                      <select class="form-control" name="category">
                        <?php
                       $cat_query = "SELECT * FROM categories ORDER BY id ASC";
                       $cat_run   = mysqli_query($con,$cat_query);
                        if(mysqli_num_rows($cat_run) > 0){
                          While($cat_row = mysqli_fetch_array($cat_run)){
                            $cat_id   = $cat_row['id']; 
                            $cat_name = ucfirst($cat_row['category']);
                            echo "<option value='$cat_id'>$cat_name</option>";
                          }

                        }
                        else{
                          echo " <option> No Category </option>";
                        }
                        ?>
                         
                       </select>
                      
                    </div>
                    <!-- Grid column -->
                    <div class="col-md-3">
                      <div class="form-group">
                      <label for="size">Product Size:</label>
                       <input type="text" class="form-control" name="size"  placeholder="Size: 25w X 25h">
                      </div>
                    </div>
                    <!-- Grid column -->
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="size">Product Price:</label>
                        <input type="text" class="form-control" name="price"  placeholder="Price: 25000">
                      </div>
                    </div>

                    <div class="col-md-3">
                     <label for="size">Product Status:</label>
                      <select class="form-control" name="status">
                        <option value="publish" selected>Publish</option>
                        <option value="draft">Draft</option>
                      </select>
                    </div>
                    
              </div> 
                       
              <div class="row">
                <div class="col-md-12">
                  <textarea name="detail" ></textarea>
                </div>
              </div>
                  
              <div class="row mt-3">
                <div class="col-md-6">      
                  <span>Choose files</span>
                     <input type="file" name="upload" class="form-control-file border" >
                </div>

                <div class="col-md-6">
                  <img src="img/<?php echo $image;?>" min-width="50%"  height="100px">
                </div>
              </div>
              
              <input type="submit" name="submit" class=" mt-3 btn btn-primary btn-md" value="Submit">
                  
            </form>
        </div>
        
     </div>
        
<script>
 CKEDITOR.replace('detail', {
    filebrowserBrowseUrl: '/brows.php',
    filebrowserUploadUrl: '/upload.php'
});
</script>
      </div>
      <?php 
 require_once('include/footer.php');
?>