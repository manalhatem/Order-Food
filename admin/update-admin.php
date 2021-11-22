<?php include ('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1> Update Admin </h1>
        
<?php 
$id=$_GET['id'];
$sql="SELECT * FROM tbl_admin where id=$id";
$res=mysqli_query($con,$sql);
if($res==TRUE){
    $count=mysqli_num_rows($res);
    if($count==1){
        $row=mysqli_fetch_assoc($res);
        $full_name= $row['full_name'];
        $username=$row['username'];
    }
    else{
        header("location:".SITEURL.'admin/manage-admin.php');

    }
}
?>
        <form action="" method="post" >
         <table class ="tbl-30">
             <tr>
                 <td>Full Name: </td>
                <td><input type="text" name="full_name" value="<?php echo $full_name;?> "></td><br><br>
            </tr>
            <tr>
            <td>username:</td>
               <td> <input type="text" name="username" value="<?php echo $username; ?>"></td><br><br>
            </tr>  
            <tr>
               <td colspan="2"> 
               <input type="hidden" value="<?php echo $id;?>" name="id">    
               <input type="submit" name="submit" value="update Admin" class="btn-secondery">
                 </td>
            </tr>

</table>

        </form>
    </div>
</div>
<?php 
if(isset ($_POST['submit'])){
    $id=$_POST['id'];
    $full=$_POST['full_name'];
    $user=$_POST['username'];

    $sql2="UPDATE tbl_admin SET
    full_name='$full',
    username='$user'
    where id=$id";
    $res2=mysqli_query($con,$sql2);
    if($res==true){
       $_SESSION['update']="<div class='success'> Admin updated Successfully</div>";
       header("location:".SITEURL.'admin/manage-admin.php');
    }
    else{
        $_SESSION['update']="<div class='error'> failed to update Admin</div>";
       header("location:".SITEURL.'admin/manage-admin.php');
    }

}
?>
<?php include ('partials/footer.php');?>