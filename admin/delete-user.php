<?php

    $user_id=$_GET['id'];
    include "config.php";
    $sql="DELETE FROM user WHERE user_id={$user_id}";
    session_start();
    $page=$_SESSION['page'];
    if(mysqli_query($conn,$sql)){
        header("Location: http://localhost/news-template/admin/users.php?page={$page}");
    }
    else{
        echo "Cant delete the Data.";
    }

    mysqli_close($conn);


?>