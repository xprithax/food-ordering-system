<?php include('partials/nav.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>
        <?php
           if(isset($_SESSION['upload']))
           {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
           }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tabb30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the food">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Enter description"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>
                        Price:
                    </td>
                    <td>
                        <input type="number" name="price" placeholder="Enter price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image" >
                    </td>
                </tr>

                <tr>
                    <td>Veg or Non Veg:</td>
                    <td>
                        <input type="radio" name="nonorveg" value="N">nonveg
                        <input type="radio" name="nonorveg" value="V">veg
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" value="Add food" name="submit" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

        <?php
          if(isset($_POST['submit'])){
            $title=$_POST['title'];
            $description=$_POST['description'];
            $price=$_POST['price'];
            if(isset($_POST['nonorveg'])){
                $nonorveg=$_POST['nonorveg'];

            }
            else{
                $nonorveg="Veg";
            }

            if(isset($_FILES['image']['name'])){
                $image_name=$_FILES['image']['name'];
                if($image_name!="")
                {
                    $ext= end(explode('.',$image_name));

                    $image_name="food_name-".rand(0000,9999).".".$ext;

                    $src=$_FILES['image']['tmp_name'];
                    $dst="../food/".$image_name;
                    $upload=move_uploaded_file($src,$dst);
                    if($upload==false){
                        $_SESSION['upload']="Failed to update image";
                        header('location:'.SITEURL.'admin/add-food.php');
                        die();

                    }

                }

            }
            else{
                $image_name="";
            }

            $sql="INSERT INTO tab_menuitem SET
               title='$title',
               description='$description',
               price=$price,
               image_name='$image_name',
               nonorveg='$nonorveg'
            ";

            $res=mysqli_query($conn, $sql);
            if($res==TRUE)
            {
                $_SESSION['add']="Successfully added food";
                header('location:'.SITEURL.'admin/menu.php');
            }
            else{
                $_SESSION['add']="Food wasnt added, error";
                header('location:'.SITEURL.'admin/menu.php');
            }


          }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>