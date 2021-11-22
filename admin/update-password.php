<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br>
        <?php 
        if(isset($_GET['id'])){
           $id=$_GET['id'];
    
    }

        ?>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td> current password</td>
                    <td> <input type="password" name="current_password" placeholder="current password">
                 </tr>
                 <tr>
                    <td> New password</td>
                    <td> <input type="password" name="new_password" placeholder="new password">
                 </tr>
                 <tr>
                    <td> confirm password</td>
                    <td> <input type="password" name="confirm_password" placeholder="confirm password">
                 </tr>
                 <tr colspan="2">
                     <td >
                     <input type="hidden" value="<?php echo $id;?>" name="id"> 
                         <input type="submit" name="submit" value="change password" class="btn-primary">
                     </td>
                 </tr>
            </table>


        </form>


    </div>
</div>
<?php 
if(isset($_POST['submit'])){
    $id=$_POST['id'];
    $current_password=md5($_POST['current_password']);
    $new_password=md5($_POST['new_password']);
    $confirm_password=md5($_POST['confirm_password']);


    $sql="SELECT * FROM tbl_admin where id=$id AND password=$current_password";
    $res=mysqli_query($con,$sql);
    if($res==TRUE){
        $count=mysqli_num_rows($res);
        if($count==1){
            if($new_password==$confirm_password){
                $sql2="UPDATE tbl_admin SET
                password='$new_password'
                where id =$id";
                $res2=mysqli_query($con,$sql2);
                 if($res2==true){
                   $_SESSION['pwd_changed']="<div class='success'> password updated Successfully</div>";
                   header("location:".SITEURL.'admin/manage-admin.php');
                   }
                  else{
                  $_SESSION['pwd_changed']="<div class='error'> failed to update password.</div>";
                  header("location:".SITEURL.'admin/manage-admin.php');
                   }


            }
            else{
                $_SESSION['pwd-not-match']="<div class='error'> password not match </div>";
                header("location:".SITEURL.'admin/manage-admin.php');

            }


        }
        else{
            $_SESSION['user-not-found']="<div class='error'> user NOT FOUND </div>";
            header("location:".SITEURL.'admin/manage-admin.php');
        }


    }
}
?>
<?php include('partials/footer.php');?>