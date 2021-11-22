<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1> Add Food </h1>
        <br><br>
        <?php
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <form action="" method="Post" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>Tittle: </td>
                <td> 
                    <input type="text" name="title" placeholder="Tittle of the food">
                </td>
            </tr>
             <tr>
                 <td> Description: </td>
                 <td>
                     <textarea name='description' cols="30" rows="5" placeholder="Description of the food"></textarea>
                 </td> 
            </tr>      
            <tr>
                <td> Price: </td>
                <td> 
                    <input type="number" name="price" >
               </td>
            </tr>
             <tr>
                     <td>Select image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
             </tr>
             <tr>
                 <td> Category: </td>
                 <td>
                 <select name="category">
                     <?php
                     $sql="SELECT * FROM tbl_category where active='yes'";
                     $res=mysqli_query($con,$sql);
                     $count=mysqli_num_rows($res);
                     if ($count>0){
                         while( $rows=mysqli_fetch_assoc($res)){
                             $id=$rows['id'];
                             $title=$rows['title'];
                             ?>
                             <option value="<?php echo $id;?>"> <?php echo $title; ?></option>
                             <?php

                         }

                     }
                     else{
                         ?>
                         <option value="0">no category found</option>
                      <?php
                     }

                     ?>

                 </select>
                </td>
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
                    <td colspan="2"> <input type="submit" name="submit" value="Add Food" class="btn-primary"></td>
               </tr>
        </table>
       </form>
       <?php
       if(isset($_POST['submit'])){
        
           $title=$_POST['title'];
           $description=$_POST['description'];
           $price=$_POST['price'];
           $category=$_POST['category'];

           if(isset($_POST['featured'])){
            $featured=$_POST['featured'];
           }
           else{
               $featured="No";
           }

           if(isset($_POST['active'])){
            $active=$_POST['active'];
           }
           else{
               $active="No";
           }
           if($_FILES['image']['name']){
               $image_name=$_FILES['image']['name'];
               if($image_name !=""){
                   $ext=end(explode('.',$image_name));
                   $image_name="food-name".rand(000,999).".".$ext;

               $src =$_FILES['image']['tmp_name'];
               $dec="../images/food/".$image_name;
               $upload=move_uploaded_file($src,$dec);
               if($upload==false){
                   $_SESSION['upload']="<div class='error'>Failed to upload image</div>";
                   header("location:".SITEURL.'admin/add-food.php');
                   die();
               }
               }
           }
           else{
               $image_name="";
           }
           $sql2="INSERT INTO tbl_food SET
           title='$title',
           description='$description',
           price='$price',
           image_name='$image_name',
           category_id='$category',
           featured='$featured',
           active='$active'
           ";
           $res2=mysqli_query($con,$sql2);
           if($res2==true){
               $_SESSION['add']="<div class='success'>Food Added Successfuly.</div>";
               header("location:".SITEURL.'admin/manage-food.php');
           }
           else{
            $_SESSION['add']="<div class='error'>Failed to add food</div>";
            header("location:".SITEURL.'admin/manage-food.php');

           }
          




       }
       ?>
    </div>
</div>
<?php include ('partials/footer.php');?>