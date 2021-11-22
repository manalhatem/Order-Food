<?php
//get id of admin to be deleted
// create sql query to delete admin'
// redirect to manage page with msg 
 include('../config/constants.php');
$id=$_GET['id'];

$sql="DELETE FROM tbl_admin WHERE id =$id";
$res=mysqli_query($con,$sql);

if($res==TRUE){
    $_SESSION['deleted']="<div class='success'>Admin deleted Successfully.</div>";
    header("location:".SITEURL.'admin/manage-admin.php');

}
else{
   $_SESSION['deleted']="<div class='error'>Failed to delete Admin ,try again later.</div>";
   header("location:".SITEURL.'admin/manage-admin.php');
 

}



