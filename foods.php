<?php include('partials-front/menu.php'); ?>
    <!-- Navbar Section Ends Here -->

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
              $sql2="SELECT * FROM tbl_food  where active='yes' and featured='yes' LIMIT 6";
              $res2= mysqli_query($con,$sql2);
              $count2= mysqli_num_rows($res2);
               if($count2>0){
                   while($row2=mysqli_fetch_assoc($res2)){
                       $id=$row2['id'];
                       $title=$row2['title'];
                       $price=$row2['price'];
                       $description=$row2['description'];
                       $image_name=$row2['image_name'];
                       ?>
                       <div class="food-menu-box">
                <div class="food-menu-img">
                    <?php 
                    if($image_name == ""){
                        echo "<div class='error'>image not avaliable.</div>";

                    }
                    else{
                        ?>
                         <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                        <?php
                    }
                    
                    ?>
                   
                </div>

                <div class="food-menu-desc">
                    <h4> <?php echo $title; ?></h4>
                    <p class="food-price"> <?php echo $price; ?></p>
                    <p class="food-detail">
                        <?php echo $description; ?>
                    </p>
                    <br>

                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>
                       <?php
                   }


               }
               else{
                   echo "<div class='error'>NOT FOOD FOUND.</div>";

               }
              ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <!-- social Section Starts Here -->
<?php include('partials-front/footer.php'); ?>