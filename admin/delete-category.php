<?php
include('../config/constants.php');
//echo "Delete";
if (isset ($_GET['id']) AND isset($_GET['image_name'])){
    //echo "get value and deleted";
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];
    if($image_name !="")
    {
        $path="../images/category/".$image_name;
        $remove=unlink($path);
        if($remove==false){
            $_SESSION['remove']="<div class='error'> Failed to remove image_category. </div>";
            header("location:".SITEURL.'admin/manage-category.php');
            die();
        }
    }
    $sql="DELETE from tbl_category where id=$id";
    $res=mysqli_query($con,$sql);
    if($res==true){
        $_SESSION['delete']="<div class='success'> Category Deleted Successfully</div>";
        header("location:".SITEURL.'admin/manage-category.php');

    }
    else{  
        $_SESSION['delete']="<div class='error'> Failed to delete Category. </div>";
        header("location:".SITEURL.'admin/manage-category.php');

    }
}
else{
    header("location:".SITEURL.'admin/manage-category.php');
}
?>