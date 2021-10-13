<?php 
//Restricting.

include "header.php";
include "config.php";
    if($_SESSION['role']==0){
        header("Location: http://localhost/news-template/admin/post.php");
    }


if(isset($_POST['submit'])){
    $category_name=$_POST['cat_name'];
    $category_id=$_POST['cat_id'];
    $sql="UPDATE category SET category_name='{$category_name}' WHERE category_id={$category_id} ";
    if(mysqli_query($conn,$sql)){
        header("Location:http://localhost/news-template/admin/category.php");
    }
}
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="1" placeholder="">
                      </div>
                      <?php 
                        include "config.php";
                        $id=$_GET['id'];
                        $sql1="SELECT category_name,category_id FROM category WHERE category_id={$id}";
                        $result1=mysqli_query($conn,$sql1) or die("Hello brother Query Failed.");
                        if(mysqli_num_rows($result1)>0){
                            while($row=mysqli_fetch_assoc($result1)){

                      ?>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="hidden" name="cat_id" class="form-control" value="<?php  echo $row['category_id']?>"  placeholder="" required>
                          <input type="text" name="cat_name" class="form-control" value="<?php  echo $row['category_name']?>"  placeholder="" required>
                      </div>
                      <?php  } } ?>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
