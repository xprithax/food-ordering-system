<?php
  include('partials/nav.php');
?>

<?php
  if(isset($_GET['id'])){
    $id=$_GET['id'];
    $current_image=$_GET['image_name']; //change made here
    $sql="SELECT * FROM tab_menuitem WHERE id=$id";
    $res=mysqli_query($conn, $sql);
    $row=mysqli_fetch_assoc($res);
    $title=$row['title'];
    $description=$row['description'];
    $price=$row['price'];
    $nonorveg=$row['nonorveg'];

  }
  else{
    header('location:'.SITEURL.'admin/menu.php');
    
  }

?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <form action="" method="post" enctype="multipart/form-data">
            <table class="tabb30">
                <tr>    
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" value=><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>
                        Price:
                    </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                    <img src="<?php echo SITEURL; ?>food/<?php echo $current_image; ?>" width="100px">
                    </td>
                </tr>

                <tr>
                    <td>Select New Image:</td>
                    <td>
                        <input type="file" name="image" >
                    </td>
                </tr>

                <tr>
                    <td>Non veg or Veg</td>
                    <td>
                        <input <?php if($nonorveg=="N") {echo "checked";} ?>type="radio" name="nonorveg" value="N">non veg
                        <input <?php if($nonorveg=="V") {echo "checked";} ?>type="radio" name="nonorveg" value="V">veg
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" value="submit" name="Update food" class="btn-secondary">
                        <input type="submit" value="goback" name="Update food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
            if(isset($_POST['submit']))
            {
                $id=$_POST['id'];
                $title=$_POST['title'];
                $description=$_POST['description'];
                $price=$_POST['price'];
                $current_image=$_POST['current_image'];
                $nonorveg=$_POST['nonorveg'];

                if(isset($_FILES['image']['name'])){
                    $image_name=$_FILES['image']['name'];
                    if($image_name!="")
                    {
                        $ext=end(explode('.',$image_name));
                        $image_name="food_name".rand(0000.9999).'.'.$ext;
                        $src=$_FILES['image']['tmp_name'];
                        $dest="../food/".$image_name;
                        $upload=move_uploaded_file($src,$dest);
                        if($upload==FALSE)
                        {
                            $_SESSION['upload']="Failed to upload image.";
                            header('location:'.SITEURL.'admin/menu.php');
                            die();
                        }
                        if($current_image!="")
                        {
                            $remove_pth="../food/".$current_image;
                            $remove=unlink($remove_pth);
                            if($remove==FALSE)
                            {
                                $_SESSION['remove-failed']="Failed to remove current image.";
                                header('location:'.SITEURL.'admin/menu.php');
                            }
                        }
                    }
                    else
                    {
                        $image_name=$current_image;
                    }
                }

                $sql3="UPDATE tab_menuitem SET
                      title='$title',
                      description='$description',
                      price=$price,
                      image_name='$image_name',
                      nonorveg='$nonorveg'
                      WHERE id=$id;
                ";

                $res3=mysqli_query($conn, $sql3);

                if($res3==TRUE)
                {
                    $_SESSION['update']="Food updated successfully.";
                    header('location:'.SITEURL.'admin/menu.php');
                }
                else
                {
                    $_SESSION['update']="Food updating was unsuccessful.";
                    header('location:'.SITEURL.'admin/menu.php');
                }


            }
        ?>
    </div>
</div>
<br><br>
<?php include('partials/footer.php'); ?>