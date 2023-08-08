<?php include('partial-host/nav.php'); ?>

<div class="main-content">
    <h1>Add to Cart?</h1>
    <br><br>
    <?php
          $id = $_GET['id'];
          $sql="SELECT * FROM tab_menuitem WHERE id=$id";
          $res=mysqli_query($conn, $sql);
          if($res==TRUE)
          {
            $count=mysqli_num_rows($res);
            if($count==1)
            {
                $row=mysqli_fetch_assoc($res);
                $title=$row['title'];
                $image=$row['image_name'];
                $price=$row['price'];
            }
            else{
                header('location:'.SITEURL.'menu.php');
            }
          }
        
    ?>
        <form action="" method="post">
            <table class="tabb30">
                <tr>
                    <td><?php echo $title; ?></td>
                </tr>
                <tr>
                    <td>
                      <img  src="<?php echo SITEURL; ?>food/<?php echo $image; ?>" width="300px">
                    </td>
                </tr>
                <tr>
                    <td>₹<?php echo $price; ?></td>
                </tr>
                <tr>
                    <td colspan="4">

                        <input type="submit" name="submit" value="Add to cart" class="btn btn-menu">
                        
                            <input type="hidden" name="title" value="<?php echo $title; ?>">
                            <input type="hidden" name="image" value="<?php echo $image; ?>">
                            <input type="hidden" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>
            </table>
        </form>
        <?php
  if(isset($_POST['submit'])){
    $title=$_POST['title'];
    $image=$_POST['image'];
    $price=$_POST['price'];
    $quantity=1;

    $sql="INSERT INTO tab_addtocart SET
      title='$title',
      image='$image',
      price=$price,
      quantity=$quantity
    ";

    $res=mysqli_query($conn, $sql);
    if($res==TRUE)
    {
        $_SESSION['added']="<div class='success'>Food successfully added to cart.</div>";
        header('location:'.SITEURL.'menu.php');
    }
    else{

        $_SESSION['added']="<div class='error'>Try again! Adding food was unsuccessful.</div>";
        header('location:'.SITEURL.'menu.php');
    }

  }
?>
</div>