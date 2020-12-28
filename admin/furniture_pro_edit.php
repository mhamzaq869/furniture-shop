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
                    if(isset($_GET['pid'])){
                      $Fur_pro_id = $_GET['pid'];

                      $Fur_pr_query = "SELECT * FROM furniture_product WHERE pid=$Fur_pro_id";
                      $Fur_pr_run   = mysqli_query($con,$Fur_pr_query);

                      if(mysqli_num_rows($Fur_pr_run) > 0){
                         $Fur_pr_row = mysqli_fetch_array($Fur_pr_run);
                          $db_pid   = $Fur_pr_row['pid'];
                          $db_title = $Fur_pr_row['title'];
                          $db_category = $Fur_pr_row['category'];
                          $db_size = $Fur_pr_row['size'];
                          $db_price = $Fur_pr_row['price'];    
                          $db_detail  = $Fur_pr_row['detail'];
                          $db_image = $Fur_pr_row['image'];
                          $db_status = $Fur_pr_row['status'];


                          if(isset($_POST['update'])){ 
                            $title      = $_POST['title'];
                            $size       = $_POST['size'];
                            $price      = $_POST['price'];
                            $status     = $_POST['status'];
                            $category   = $_POST['category'];
                            $detail     = $_POST['detail'];
                            $image      = $_FILES['upload']['name'];
                            $tmp_image  = $_FILES['upload']['tmp_name'];
                                
                            if(!empty($title) || !empty($size) || !empty($price) || !empty($status) || !empty($category) || !empty($detail) || !empty($image)){
                              if($image==''){
                                $image=$db_image;
                              }
                              $query = "UPDATE furniture_product SET title='$title', category=$category, size='$size', price =$price, detail='$detail', image='$image', status='$status' Where pid=$Fur_pro_id";                            
                                if(mysqli_query($con,$query)){
                                    $path = "img/".$image;
                                    if(move_uploaded_file($tmp_image,$path) == true){
                                        copy($path,"../".$path);                                                                    
                                    }
                                    header("location:furniture_pro_edit.php?pid=$Fur_pro_id");
                                  
                                }
                                  
                                
                            }else {
                              $error = "All Fields are required!";
                            }
                                           
                        }
                        
                        }
                    }
       
                    ?>
       
                <div class="row">
                <div class="col-md-12">
                  <?php if(isset($error)){
                    echo "<span class='mt-3 mb-4' style='color:red; font-weight:bold;'><i style='color:red; font-weight:bold;' class='fas fa-sad'></i> $error</span>";
                    }?>
                    <!-- Grid column -->
                    
                      <div class="form-group">
                       <label for="furniture">Furniture Product Title:</label>
                       <input type="text" class="form-control" name="title" value="<?php echo $db_title;?>" placeholder="Title">
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
                          ?>
                          <option value='<?php echo $cat_id; ?>' <?php if($cat_id == $db_category){  echo 'selected'; }?> ><?php echo $cat_name;?></option>";
                      <?php
                          }

                        }
                        
                        ?>
                         
                       </select>
                      
                    </div>
                    <!-- Grid column -->
                    <div class="col-md-3">
                      <div class="form-group">
                      <label for="size">Product Size:</label>
                       <input type="text" class="form-control" name="size" value="<?php echo $db_size; ?>" placeholder="Size: 25w X 25h">
                      </div>
                    </div>
                    <!-- Grid column -->
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="size">Product Price:</label>
                        <input type="text" class="form-control" name="price" value="<?php echo $db_price; ?>" placeholder="Price: 25000">
                      </div>
                    </div>

                    <div class="col-md-3">
                     <label for="size">Product Status:</label>
                     <select class="form-control" name="status">
                        <option value="publish" <?php if($db_status=='publish'){ echo 'selected';}?>>Publish</option>
                        <option value="draft" <?php if($db_status=='draft'){ echo 'selected';}?>>Draft</option>
                      </select>
                    </div>
                    
              </div> 
                       
              <div class="row">
                <div class="col-md-12">
                  <textarea name="detail">
                    <?php echo $db_detail; ?>
                  </textarea>
                </div>
              </div>
                  
              <div class="row mt-3">

                <div class="col-md-6">      
                  <span>Choose files</span>
                     <input type="file" name="upload" class="form-control-file border" >
                </div>

                <div class="col-md-6">
                  <img src="img/<?php echo $db_image;?>" min-width="100%"  height="200px">
                </div>
              </div>
              
              <input type="submit" name="update" class=" mt-3 btn btn-primary btn-md" value="Update">
                  
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