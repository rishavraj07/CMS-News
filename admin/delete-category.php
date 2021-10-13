<?php
   $user_id=$_GET['id'];
   include "config.php";
   $sql="DELETE FROM category WHERE category_id={$user_id}";
   if(mysqli_query($conn,$sql)){
       header("Location: http://localhost/news-template/admin/category.php");
   }
   else{
       echo "Cant delete the Data.";
   }

   mysqli_close($conn);
?>