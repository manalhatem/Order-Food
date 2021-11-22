<?php
include("../config/constants.php");
if(isset($_GET['id']) && isset($_GET['image_name'])){
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];

    if($image_name !=""){
        $path="../images/food/".$image_name;
        $remove=unlink($path);
        if($remove==false){
            $_SESSION['remove']="<div class='error'> failed to remove image </div>";
            header("location:".SITEURL.'admin/manage-food.php');
            die();
        }
    }
 $sql="DELETE FROM tbl_food where id=$id";
 $res=mysqli_query($con,$sql);
 if($res==true){
     $_SESSION['delete']="<div class='success'>food deleted Successfuly. </div>";
     header("location:".SITEURL.'admin/manage-food.php');

 }
 else{
    $_SESSION['delete']="<div class='error'>Failed to delete food </div>";
    header("location:".SITEURL.'admin/manage-food.php');
 }
}
else{
    $_SESSION['unauthorized']="<div class='error'>authorized Access. </div>";
    header("location:".SITEURL.'admin/manage-food.php');
}
?>