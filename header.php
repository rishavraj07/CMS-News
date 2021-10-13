<?php
include "connection.php";
$page_name=basename($_SERVER['PHP_SELF']);
switch($page_name){
    case "single.php":
        if(isset($_GET['post-id'])){
            $sql="SELECT * FROM post WHERE post_id={$_GET['post-id']}";
            $result=mysqli_query($conn,$sql) or die ("Query Failed 1.");
            $row=mysqli_fetch_assoc($result);
            $page_title=$row['title'];
        }else{
            $page_title="News";
        }
        break;
    case "category.php":
        if(isset($_GET['category-id'])){
            $sql="SELECT * FROM category WHERE category_id={$_GET['category-id']}";
            $result=mysqli_query($conn,$sql) or die ("Query Failed 1.");
            $row=mysqli_fetch_assoc($result);
            $page_title=$row['category_name'];
        }else{
            $page_title="News";
        }
        break;
    case "author.php":
        if(isset($_GET['author-id'])){
            $sql="SELECT * FROM user WHERE user_id={$_GET['author-id']}";
            $result=mysqli_query($conn,$sql) or die ("Query Failed 1.");
            $row=mysqli_fetch_assoc($result);
            $page_title=$row['username'];
        }else{
            $page_title="News";
        }
        break;
    case "search.php":
        if(isset($_GET['search'])){
            $sql="SELECT * FROM post WHERE title LIKE '%{$_GET['search']}%' ";
            $result=mysqli_query($conn,$sql) or die ("Query Failed 1.");
            $row=mysqli_fetch_assoc($result);
            $page_title=$_GET['search'];
        }else{
            $page_title="News";
        }
        break;

    default :
    $page_title="Home";
    break;        
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo "News : ".$page_title ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <style>
        #header{
        background: #333;
        text-align: center;
        padding: 15px;
        }
        #footer{
            color: #fff;
            padding:15px 0;
            text-align:center;
            background-color:#333!important;
        }
        .menu{
            background-color:#d76d6d;
            margin-bottom:18px;
        }
        #footer_media{
            background-color: #d76d6d;
        }
    </style>
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
                <a href="index.php" id="logo"><img src="images/news.png"></a>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class='menu'>                   
                    <?php
                    $active="";
                    $home_active="";
                    if(isset($_GET['category-id'])){
                        $cat_id=$_GET['category-id'];
                    }else{
                        $home_active="active";
                    }
                    include "connection.php";
                    $sql="SELECT * FROM category";
                    $result=mysqli_query($conn,$sql) or die ("Query Failed");
                    echo "<li><a class='{$home_active}' href='index.php'>HOME</a></li>";
                    if(mysqli_num_rows($result)>0){
                        while($row=mysqli_fetch_assoc($result)){
                            if(isset($_GET['category-id'])){
                                if($cat_id==$row['category_id']){
                                    $active="active";
                                }else{
                                    $active="";
                                }
                            }
                            echo "<li><a class='{$active}' href='category.php?category-id={$row['category_id']}'>{$row['category_name']}</a></li>";
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
