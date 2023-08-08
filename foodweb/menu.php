<?php 
   include('partial-host/nav.php'); 
?>

    <div class="container ">
      <h1 class="primary">Our Menu</h1>
      <br><br>
      <?php
            if(isset($_SESSION['added'])){
                echo $_SESSION['added'];
                unset($_SESSION['added']);
            }
      ?>
      <div class="restaurant-menu">
      <?php
         $sql="SELECT * FROM tab_menuitem";
         $res=mysqli_query($conn, $sql);
         $count=mysqli_num_rows($res);
         if($count>0)
         {
            while($row=mysqli_fetch_assoc($res))
            { 
                ?>
                <div class="food">
                    <img class="menuimage" src="<?php echo SITEURL;?>food/<?php echo $row['image_name']; ?>" style="object-fit=cover;" > 

                    <div class="title"><?php echo $row['title']; ?> <div class="chotaicon" style="width: 20px;"><img  class="chotaicon" src="<?php 
                    if($row['nonorveg']=='N'){
                        echo "nvegg.jpg";
                    }
                    else{
                        echo "vegg.jpg";
                    } ?>"></div></div>
                    <div class="location"><?php echo $row['description']; ?></div><br>

                    <div class="order flex">
                        <div class="price">₹<?php echo $row['price']; ?></div>
                        <div class="">
                            <div class="" id="addtocart3">
                               <!-- <input type="hidden" name="title" value="">
                                <input type="hidden" name="image_name" value="">
                                <input type="hidden" name="price" value=""> -->
                                <a href="<?php echo SITEURL; ?>menu-cart.php?id=<?php echo $row['id']; ?>" class="btn-menu btn">Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
         }
         else{
            echo "Food not found.";
         }
      
               ?>  
            
        </div>
    </div>
    <div>
        <br>
        <br>
        <a href="<?php echo SITEURL;?>cart.php" class="btn" style="margin-left: 50%;">Go To Cart</a>
        <br>
    </div>
</body>
</html>

