<?php
    $server="localhost";
    $username="root";
    $password="";
    $database="news-site";
    //Making the connection to the Database.
    $conn=mysqli_connect($server,$username,$password,$database) or die("Connection failed");
 ?>