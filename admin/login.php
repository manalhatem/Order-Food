<?php include ('../config/constants.php');?>
<html>
    <head> 
        <title> Login -food order system </title>
       <link href="../css/admin.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="login">
            <h1 class="text-center"> login </h1>
            <br><br>
            <?php
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset ($_SESSION['login']);
            }
            if(isset($_SESSION['no-login-message'])){
                echo $_SESSION['no-login-message'];
                unset ($_SESSION['no-login-message']);
            }
            ?>
            <br><br>
            <form action="" method="post" class="text-center">
                UserName:<br> 
                <input type="text" name="username" placeholder="Enter your username"><br><br>
                Password:<br>
                <input type="password" name="password" placeholder="Enter your password"><br><br>
                <input type="submit" name="submit" value="Login" class="btn-primary"><br><br>
            <p class="text-center"> WOW Food <a href='#'> food order system</a></p>
         </div>
     </body>
</html>
<?php
if (isset($_POST['submit'])){
    $username=mysqli_real_escape_string($con,$_POST['username']);
    $raw_pass=md5($_POST['password']);
    $pass=mysqli_real_escape_string($con,$raw_pass);

    $sql="SELECT * FROM tbl_admin where username='$username' AND password='$pass'";
    $res=mysqli_query($con,$sql);
    $count=mysqli_num_rows($res);
    if($count==1){
        $_SESSION['login']="<div class='success'> Login Successfully.</div>";
        $_SESSION['user']=$username;
        header("location:".SITEURL.'admin/');
    }
    else{
        $_SESSION['login']="<div class='error text-center'>username or password not matched </div>";
        header("location:".SITEURL.'admin/login.php');
    }


}
?>