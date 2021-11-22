<?php include ('partials/menu.php');?>
<!-- main content section starts-->
<div class="main-content">
    <div class="wrapper">
        <h1> Manage Category</h1>
        <br><br>
        <?php
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['remove'])){
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }
        if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['updata'])){
            echo $_SESSION['updata'];
            unset($_SESSION['updata']);
        }
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if(isset($_SESSION['failed_remove'])){
            echo $_SESSION['failed_remove'];
            unset($_SESSION['failed_remove']);
        }
        ?>
        <br><br>
        <a href="<?php echo SITEURL;?>admin/add-category.php" class="btn-primary">Add Category</a>
        <br><br> <br>
        <table class="tbl-full" >
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>
            </tr>
            <?php
            $sql="SELECT * FROM tbl_category";
            $res=mysqli_query($con,$sql);
            $count=mysqli_num_rows($res);
            $sn=1;
            if($count>0){
                while($row=mysqli_fetch_assoc($res)){
                    $id=$row['id'];
                    $title=$row['title'];
                    $image_name=$row['image_name'];
                    $featured=$row['featured'];
                    $active=$row['active'];
            ?>
            <tr>
                <td><?php echo $sn++?></td>
                <td><?php echo $title?></td>

                <td><?php 
                //echo $image_name
                //check whether image name is avalible or not 
                if($image_name!=''){
                    ?>
                    <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" width="100">
                <?php

                }
                else{
                    echo "<div class='error'>IMAGE NOT Added. </div>";
                }
                
                ?></td>
                <td><?php echo $featured ?></td>
                <td><?php echo $active ?></td>
                <td>

                    <a href="<?php echo SITEURL;?>admin/updata-category.php?id=<?php echo $id;?>" class="btn-secondery">update Category</a>
                    <a href="<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
                </td>
            </tr>
            <?php

                }

            }
            else{
                //we dont hava data wewill display message
        
            ?>
            <tr> <td colspan="4"><div class='error'> No Category Added. </div></td></tr>
            <?php } 
            ?>
            
        </table>
    </div>
</div>
<!-- main content section ends-->

<?php include ('partials/footer.php'); ?>
