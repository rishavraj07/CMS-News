<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: http://localhost/news-template/admin");
    }
    $page_name=basename($_SERVER['PHP_SELF']);
    $post="";
    $category="";
    $user="";
    switch($page_name){
        case "post.php":
            $page_title="Post";
            $post="post";
            break;
        case "add-post.php":
            $page_title="Add Post";
            break;
        case "category.php":
            $page_title="Category";
            $category="category";
            break;
        case "add-category.php":
            $page_title="Add Category";
            break;
        case "users.php":
            $page_title="Users";
            $user="user";
            break;
        case "add-user.php":
            $page_title="Add User";
            break;
        default :
            $page_title="Admin";
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
        <title><?php echo "ADMIN : ".$page_title; ?></title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
       
        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="../css/font-awesome.css">
        <!-- Custom stlylesheet -->
        <link rel="stylesheet" href="../css/style.css">
        <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
        <style>
            a.name{
                color:white;
                margin-right:5px;
                font-size:20px;
            }
            #header-admin{
                background-color: #333;
                padding: 15px 0;
            }
            #admin-menubar{
                background-color:#d76d6d;
                margin-top:15px;
            }
            #admin-menubar .admin-menu li a {
                color:white;
            }
            .admin-logout{
                color:red!important;
            }
            #footer_media{
                background-color:#d76d6d;
            }
        </style>
    </head>
    <body>
        <!-- HEADER -->
        <div id="header-admin">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-md-2">
                        <a href="post.php"><img class="logo img-fluid" id="logo_img" src="images/news.png"></a>
                    </div>
                    <!-- /LOGO -->

                    <!-- LOGO-Out -->
                    <div class="col-md-offset-9  col-md">
                        <a class="name" ><?php echo "( ".$_SESSION['username']." )"; ?></a>
                        <a href="logout.php" class="admin-logout">LOGOUT</a>
                    </div>
                    <!-- /LOGO-Out -->
                </div>
                <!-- menubar -->
                <div id="admin-menubar">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                            <ul class="admin-menu">
                                    <li>
                                        <a href="post.php">Post</a>
                                    </li>
                                    <?php if($_SESSION['role']==1){ ?>
                                        <li>
                                            <a  href="category.php">Category</a>
                                        </li>
                                        <li>
                                            <a  href="users.php">Users</a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /HEADER -->
       
