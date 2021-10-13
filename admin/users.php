<?php
    include "header.php";
    //Restricting.
    if($_SESSION['role']==0){
        header("Location: http://localhost/news-template/admin/post.php");
    }


    $limit=10;
    if(isset($_GET['page'])){
        $page=$_GET['page'];
    }
    else{
        $page=1;
    }
    $_SESSION['page']=$page;
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users  </h1>
                  <h4 ><?php echo"Page no: ".$page ?></h4>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php" style="background-color:green">add user</a>
              </div>
              <div class="col-md-12">
                  <?php
                  include "config.php";
                  
                  $offset=($page-1)*$limit;
                  $sql="SELECT * FROM user ORDER BY user_id DESC LIMIT {$offset},{$limit}";
                  $result=mysqli_query($conn,$sql) or die("Query  Failed !!!");
                  if(mysqli_num_rows($result)>0){

                  ?>
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                          <?php
                          while($row=mysqli_fetch_assoc($result)){
                          ?>

                          <tr>
                              <td class='id'><?php echo $row['user_id']; ?></td>
                              <td><?php echo $row['first_name']. " ". $row['last_name']; ?></td>
                              <td><?php echo $row['username']; ?></td>
                              <td><?php 
                              if($row['role']==0){
                                  echo 'Normal-User'; 
                              }else{
                                echo 'Admin';
                              }

                              ?></td>
                              <td class='edit'><a href='update-user.php?id=<?php echo $row['user_id']; ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-user.php?id=<?php echo $row['user_id']; ?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>

                          <?php } ?>
                          
                      </tbody>
                  </table>

                  
                  <?php  
                    }
                    include "config.php";
                    $sql1="SELECT * FROM user";
                    $result1=mysqli_query($conn,$sql1) or die("Query Failed.");
                    if(mysqli_num_rows($result1)>0){
                        $total_records=mysqli_num_rows($result1);
                       
                        $total_pages=ceil($total_records/$limit);
                        echo "<ul class='pagination admin-pagination'>";
                        if($page>1){
                            echo "<li><a href='users.php?page=".($page - 1 )."'>PREV</a></li>";
                        }
                        for($i=1;$i<=$total_pages;$i++){
                            if($i==$page){
                                $active="active";
                            }else{
                                $active="";
                            }
                                echo " <li class=".$active."><a href='users.php?page=$i'>$i</a></li>";
                        }
                        if($page<$total_pages){
                            echo "<li><a href='users.php?page=".($page + 1 )."'>NEXT</a></li>";
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
