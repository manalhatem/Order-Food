<?php include ('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>
        <?php
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="Category title"></td>
                </tr>
                <tr>
                    <td><input type="file" name="image"></td>
                </tr> 
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="yes"> Yes
                        <input type="radio" name="featured" value="no"> No
                
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="yes"> Yes
                        <input type="radio" name="active" value="no"> No
                
                    </td>
                </tr>   
                <tr>
                    <td colspan="2"> <input type="submit" name="submit" value="Add Category" class="btn-primary"></td> 
                </tr>    
            </table>
        </form>
<?php if(isset($_POST['submit'])){
    $title=$_POST['title'];
    if(isset($_POST['featured'])){
        $featured=$_POST['featured'];  }
    else{ $featured='no';}
    if(isset($_POST['active'])){
        $active=$_POST['active'];  }
    else{ $active='no';}
    if(isset($_FILES['image']['name'])){
        $image_name=$_FILES['image']['name'];//specialfood.jpg
        if($image_name !=""){

        $ext=end(explode('.',$image_name));//rename image
        $image_name="category_food_".rand(000,999).'.'.$ext;//food_category_987.jpg

        $source_path=$_FILES['image']['tmp_name'];
        $destination_path="../images/category/".$image_name;
        $upload=move_uploaded_file($source_path,$destination_path);
        if($upload==false){
            $_SESSION['upload']="<div class='error'>Failed to upload image. </div>";
            header("location:".SITEURL.'admin/add-category.php');
            die();//stop the process
        }
    }
}
    else{
        $image_name='';
    }
    $sql="INSERT INTO tbl_category SET
    title='$title',
    image_name='$image_name',
    featured='$featured',
    active='$active'";
    $res=mysqli_query($con,$sql);
    if($res==TRUE){
        $_SESSION['add']="<div class='success'> Category Added Successfully</div>";
        header("location:".SITEURL.'admin/manage-category.php');
    }
    else{
        $_SESSION['add']="<div class='error'> Failed to add Category</div>";
        header("location:".SITEURL.'admin/manage-category.php');
    }
    

    
}

?>
    </div>
</div>

<?php include ('partials/footer.php');?>