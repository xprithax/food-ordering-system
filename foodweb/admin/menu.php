<?php include('partials/nav.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <br><br>
        <?php
        

           if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
           }

           if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
           }

           if(isset($_SESSION['unauth'])){
            echo $_SESSION['unauth'];
            unset($_SESSION['unauth']);
           }

           if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
           }

           if(isset($_SESSION['remove-image'])){
            echo $_SESSION['remove-image'];
            unset($_SESSION['remove-image']);
           }

           if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
           }
        ?>
        <br/><br/>
        <a href="add-food.php" class="btn-primary">Add Food</a>
        <br/></br>
        
        <table class="tabb">
            <tr>
                <th>S.no</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Non Veg or Veg</th>
            </tr>
            <?php
               $sql="SELECT * FROM tab_menuitem";
               $res=mysqli_query($conn,$sql);
               if($res==TRUE)
               {
                 $count=mysqli_num_rows($res);
                 $sn=1;
                 if($count>0)
                 {
                    while($rows=mysqli_fetch_assoc($res))
                    {
                        $id=$rows['id'];
                        $title=$rows['title'];
                        $price=$rows['price'];
                        $image_name=$rows['image_name'];
                        $nonorveg=$rows['nonorveg'];
                        ?>

                        <tr>
                           <td><?php echo $sn++; ?></td>
                           <td><?php echo $title; ?></td>
                           <td><?php echo $price; ?></td>
                           
                           <td>
                                <?php 
                                  if($image_name=="")
                                  {
                                    echo "Image not added";
                                  }
                                  else{
                                    ?>
                                    <img src="<?php echo SITEURL;?>food/<?php echo $image_name; ?>" width="100px">
                                    <?php
                                  }
                                ?>
                           </td>
                           <td><?php echo $nonorveg; ?></td>
                           <td>
                              <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">update food</a>
                              <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?> &image_name=<?php echo $image_name; ?> " class="btn-danger">delete food</a>
                            </td>
                        </tr>
                        <?php
                    }
                 }
                 else{
                    echo "<tr> <td colspan='7' class='error'> Food not added yet. </td> </tr>";
                 }
               }

            ?>
            
        </table>
    </div>
</div>
<?php include('partials/footer.php'); ?>