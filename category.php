<?php 
include 'header.php';
$limit=5;
if(isset($_GET['category-id'])){
    $cat_id=$_GET['category-id'];
}
    if(isset($_GET['page'])){
        $page=$_GET['page'];
    }
    else{
        $page=1;
    }

 ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container --> 
                <?php
                    include "connection.php";
                    $offset=($page-1)*$limit;
                    $sql="SELECT * FROM post LEFT JOIN category ON post.category=category.category_id LEFT JOIN user ON post.author=user.user_id WHERE category='{$_GET['category-id']}' LIMIT {$offset},{$limit}";
                    $result=mysqli_query($conn,$sql) or die ("Query Failed! 1");
                    if(mysqli_num_rows($result)>0){
                ?>
                <div class="post-container">
                    <?php
                    $sql1="SELECT * FROM category WHERE category_id={$_GET['category-id']}";
                    $result1=mysqli_query($conn,$sql1) or die("query Failed! 2");
                    $row1=mysqli_fetch_assoc($result1);
                    ?>
                  <h2 class="page-heading"><?php echo $row1['category_name']." News"; ?></h2>
                  <?php  while($row=mysqli_fetch_assoc($result)){  ?>
                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?post-id=<?php echo $row['post_id']; ?>"><img src="admin/upload/<?php echo $row['post_img']; ?>" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href='single.php?post-id=<?php echo $row['post_id']; ?>'><?php echo $row['title']; ?></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?category-id=<?php echo $row['category_id']; ?>'><?php echo $row['category_name']; ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php?author-id=<?php echo $row['author']; ?>'><?php echo $row['username']; ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $row['post_date']; ?>
                                        </span>
                                    </div>
                                    <p class="description">
                                    <?php echo substr($row['description'],0,150)."....."; ?>
                                    </p>
                                    <a class='read-more pull-right' href='single.php?post-id=<?php echo $row['post_id']; ?>'>read more</a>
                                </div>
                            </div>
                        </div>
                    </div>  
                
                <!-- pagination coding-->
                <?php  } } 
                         include "connection.php";
                         $sql2="SELECT * FROM post WHERE category='{$cat_id}'";
                         $result2=mysqli_query($conn,$sql2) or die("Query Failed. 3");
                         if(mysqli_num_rows($result2)>0){
                             $total_records=mysqli_num_rows($result2);                          
                             $total_pages=ceil($total_records/$limit);
                             echo "<ul class='pagination'>";
                             if($page>1){
                                 echo "<li><a href='category.php?category-id={$cat_id}&page=".($page - 1 )."'>PREV</a></li>";
                             }
                             for($i=1;$i<=$total_pages;$i++){
                                 if($i==$page){
                                     $active="active";
                                 }else{
                                     $active="";
                                 }
                                     echo " <li class=".$active."><a href='category.php?category-id={$cat_id}&page=$i'>$i</a></li>";
                             }
                             if($page<$total_pages){
                                 echo "<li><a href='category.php?category-id={$cat_id}&page=".($page + 1 )."'>NEXT</a></li>";
                             }
                             echo " </ul>";
                         }
             
                        ?>


                    <!-- <ul class='pagination'>
                        <li class="active"><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                    </ul> -->
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
