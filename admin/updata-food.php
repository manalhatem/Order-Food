<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Updata Food </h1>
        <br><br>
        <?php
         if(isset($_GET['id'])){
            $id=$_GET['id'];
        $sql="SELECT * FROM tbl_food where id=$id";
        $res=mysqli_query($con,$sql);
           $count=mysqli_num_rows($res);
           if($count==1){
               $row=mysqli_fetch_assoc($res);
               $id=$row['id'];
               $title=$row['title'];
               $description=$row['description'];
               $price=$row['price'];
               $current_image=$row['image_name'];
               $featured=$row['featured'];
               $active=$row['active'];
           }
           else{
            $_SESSION['no-food-found']="<div class='error'>No food Found</div>";
            header("location:".SITEURL.'admin/manage-food.php');
            
        }
    }
    else{
        header("location:".SITEURL.'admin/manage-food.php');
    }
        ?>
        <br><br>
        <form action="" method="post" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td><input name="title" type="text" value="<?php echo $title; ?>"> </td>
            </tr>
            <tr>
                 <td> Description: </td>
                 <td>
                     <textarea name='description' cols="30" rows="5" ><?php echo $description;?></textarea>
                 </td> 
            </tr>      
            <tr>
                <td> Price: </td>
                <td> 
                    <input type="number" name="price"  value="<?php echo $price; ?>">
               </td>
            </tr>
            <tr>
                <td> Current Image: </td>
                <td>
                <?php 
                    if($current_image !=""){
                        ?>
                        <img src="<?php echo SITEURL;?>images/food/<?php echo $current_image; ?>" width='150px'>
                        <?php

                    }
                    else{
                        echo "<div class='error'>Image Not Added</div>";

                    }
                        ?>
                    </td>
            </tr>
            <tr>
                <td> Select New Image: </td>
                <td> <input type="file" name="image"> </td>
            </tr>
            <tr>
                <td> Category: </td>
                <td> 
                    <select name="category">
                        <?php
                        $sql2="SELECT * FROM tbl_category where active='yes'";
                        $res2=mysqli_query($con,$sql2);
                        $count2=mysqli_num_rows($res2);
                        if($count2>0){
                            while($row2=mysqli_fetch_assoc($res2)){
                                $category_title=$row2['title'];
                                $category_id=$row2['id'];
                            
                            echo"<option value=' $category_id'> $category_title </option>" ;
                                
                            }

                        }
                        else{
                           echo "<option value='0'>Category Not Avaliable. </option>";

                        }
                        ?>
                       
                    </select>
                </td>
            </tr>
            <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="yes"){echo "checked";}?>   type="radio" name="featured" value="yes"> Yes
                        <input <?php if($featured=="no"){echo "checked";}?> type="radio" name="featured" value="no"> No
                
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="yes"){echo "checked";}?> type="radio" name="active" value="yes"> Yes
                        <input <?php if($active=="no"){echo "checked";}?> type="radio" name="active" value="no"> No
                
                    </td>
                </tr>
                <tr>

                    <td colspan="2">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="hidden" name="id" value="<?php echo $id;?>">    
                    <input type="submit" name="submit" value="Add Food" class="btn-primary"></td>
               </tr>
         </table>
        </form>
    </div>
</div>
<?php
if(isset($_POST['submit'])){
    $id=$_POST['id'];
    $title=$_POST['title'];
    $description=$_POST['description'];
    $price=$_POST['price'];
    $current_image=$_POST['current_image'];
    $category=$_POST['category'];
    $featured=$_POST['featured'];
    $active=$_POST['active'];
    if(isset($_FILES['image']['name'])){
        $image_name=$_FILES['image']['name'];
        if($image_name !=""){
            $ext=end(explode('.',$image_name));
            $image_name="image-food.".rand(000,9999).'.'.$ext;
            $src=$_FILES['image']['tmp_name'];
            $dest="../images/food/".$image_name;
            $upload=move_uploaded_file($src,$dest);
            if($upload==false){
                $_SESSION['upload']="<div class='error'> Failed to upload new image . </div>";
                header("location:".SITEURL.'admin/manage-food.php');
                die();
            }

        }
        else{
            $image_name=$current_image;
        }
    }
    $sql3="UPDATE tbl_food SET
    title='$title',
    description='$description',
    price='$price',
    image_name='$image_name',
    category_id='$category',
    featured='$featured',
    active='$active'
    where id=$id
    ";
    $res3=mysqli_query($con,$sql3);
    if($res3==true){
        $_SESSION['update']="<div class='success'>FOOD Updated Successfully.</div>";
        header("location:".SITEURL.'admin/manage-food.php');

    }
    else{
        $_SESSION['update']="<div class='error'>Failed to Update Food .</div>";
        header("location:".SITEURL.'admin/manage-food.php');

    }
}



?>
<?php include ('partials/footer.php');?>
