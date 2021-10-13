<?php

include "config.php";
if(empty($_FILES['new-image']['name'])){
    $file_name=$_POST['old-image'];
}
else{
    $error=array();

    $file_name=$_FILES['new-image']['name'];
    $file_size=$_FILES['new-image']['size'];
    $file_type=$_FILES['new-image']['type'];
    $file_tmp=$_FILES['new-image']['tmp_name'];
    $file_ext=end(explode(".",$file_name));

    $extention=array("jpeg","jpg",'png');
    if(in_array($file_ext,$extention)==false){
        $error[]="The extention does not match please use jpeg/jpg or png extention files.";
    }
    if($file_size>2097152){
        $error[]="THE file size must be less than or equal to 2mb.";
    }
    if(empty($error)==true){
        move_uploaded_file($file_tmp,"upload/".$file_name);
    }else{
        echo "<pre>";
        print_r($error);
        echo "</pre>";
        die();
    }

}
    $sql="UPDATE post SET title='{$_POST["post_title"]}',description='{$_POST["postdesc"]}',
    category={$_POST['category']},post_img='{$file_name}' 
    WHERE post_id={$_POST['post_id']};";
    $sql .="UPDATE category SET post=post-1 WHERE category_id={$_POST['old_cat_id']};";
    $sql .="UPDATE category SET post=post+1 WHERE category_id={$_POST['category']}";
    $result1=mysqli_multi_query($conn,$sql);
    if($result1){
        header("Location: http://localhost/news-template/admin/post.php");
    }else{
        echo "You have not Done any changes Please do changes or move back if do not";
    }

    
?>



