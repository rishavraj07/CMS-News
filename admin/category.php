<?php 
include "header.php";
$limit=3;
if(isset($_GET['page'])){
    $page=$_GET['page'];
}
else{
    $page=1;
}
// Restricting .

if($_SESSION['role']==0){
    header("Location: http://localhost/news-template/admin/post.php");
}

 ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
                <h4>Page no:<?php echo " ".$page  ?></h4>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php" style="background-color:green">add category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <?php
                        include "config.php";
                        $offset=($page-1)*$limit;
                        $sql="SELECT * FROM category LIMIT {$offset},{$limit}";
                        $result=mysqli_query($conn,$sql) or die("Query Failed!!!");
                        if(mysqli_num_rows($result)>0){
                            while($row=mysqli_fetch_assoc($result)){

                    ?>
                    <tbody>
                        <tr>
                            <td class='id'><?php echo $row['category_id']; ?></td>
                            <td><?php echo $row['category_name']; ?></td>
                            <td><?php echo $row['post']; ?></td>
                            <td class='edit'><a href='update-category.php?id=<?php echo $row['category_id']; ?>'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-category.php?id=<?php echo $row['category_id']; ?>'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                        
                    </tbody>

                <?php 

                    }
                }

                ?>

                </table>
                <?php
                $sql1="SELECT * FROM category";
                $result1=mysqli_query($conn,$sql1) or die ("Query failed.");
                if(mysqli_num_rows($result1)>0){
                    $records=mysqli_num_rows($result1);
                    $total_page=ceil($records/$limit);
                    echo "<ul class='pagination admin-pagination'>";
                    if($page>1){
                        echo "<li><a href='category.php?page=".($page-1)."'>PREV</a></li>";
                    }

                    for($i=1;$i<=$total_page;$i++){
                        if($i==$page){
                            $active="active";
                        }
                        else{
                            $active="";
                        }
                        echo "<li class=$active><a  href='category.php?page=$i'>$i</a></li>";
                    }
                    if($page<$total_page){
                        echo "<li><a href='category.php?page=".($page + 1 )."'>NEXT</a></li>";
                    }
                    echo " </ul>";
                }
                ?>
                <!-- <ul class='pagination admin-pagination'>
                    <li class="active"><a>1</a></li>
                    <li><a>2</a></li>
                    <li><a>3</a></li>
                </ul> -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
