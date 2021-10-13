<?php
include 'header.php';
$limit=10;
if(isset($_GET['search'])){
     $search_word=$_GET['search'];
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
                <div class="post-container">
                  <h2 class="page-heading">Search : <?php echo $_GET['search']; ?></h2>
                  <?php
                  if(isset($_GET['search'])){
                    $search_word=$_GET['search'];
                  
                  include "connection.php";
                  $offset=($page-1)*$limit;
                  $sql="SELECT * FROM post LEFT JOIN user ON post.author=user.user_id LEFT JOIN category ON post.category=category.category_id WHERE post.title LIKE '%{$search_word}%' LIMIT {$offset},{$limit}";
                  $result=mysqli_query($conn,$sql) or die ("Query Failed 1.");
                  if(mysqli_num_rows($result)>0){
                      while($row=mysqli_fetch_assoc($result)){
                  ?>

                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?post-id=<?php echo $row['post_id']; ?>"><img src="admin/upload/<?php echo $row['post_img']; ?>" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href='single.php?post-id=<?php echo $row['post_id']; ?>'><?php echo $row['title']; ?> </a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?category-id=<?php echo $row["category_id"]; ?>'><?php echo $row['category_name']; ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <?php
                                            if($row['role']==1){
                                                $role="Admin";
                                            }else{
                                                $role="Normal User";
                                            }
                                            ?>
                                            <a href='author.php?author-id=<?php echo $row['author']; ?>'><?php echo $role ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $row['post_date']; ?>
                                        </span>
                                    </div>
                                    <p class="description">
                                        <?php echo substr($row['description'],0,150)."....................."; ?>
                                    </p>
                                    <a class='read-more pull-right' href='single.php?post-id=<?php echo $row["post_id"] ?>'>read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                <?php
                  }
                }else{
                    echo '<h2>No Result Found.</h2>';
                }
            } 
                ?>

               <!-- pagination coding-->
               <?php 
                         include "connection.php";
                         $sql2="SELECT * FROM post WHERE title LIKE'%{$search_word}%'";
                         $result2=mysqli_query($conn,$sql2) or die("Query Failed. 3");
                         if(mysqli_num_rows($result2)>0){
                             $total_records=mysqli_num_rows($result2);                     
                             $total_pages=ceil($total_records/$limit);
                             echo "<ul class='pagination'>";
                             if($page>1){
                                 echo "<li><a href='search.php?search={$_GET['search']}&page=".($page - 1 )."'>PREV</a></li>";
                             }
                             for($i=1;$i<=$total_pages;$i++){
                                 if($i==$page){
                                     $active="active";
                                 }else{
                                     $active="";
                                 }
                                     echo " <li class=".$active."><a href='search.php?search={$search_word}&page=$i'>$i</a></li>";
                             }
                             if($page<$total_pages){
                                 echo "<li><a href='search.php?search={$search_word}&page=".($page + 1 )."'>NEXT</a></li>";
                             }
                             echo " </ul>";
                         }
                        ?>
                   <!-- pagination end -->
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
