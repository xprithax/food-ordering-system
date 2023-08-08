<?php 
include('partial-host/nav.php'); 
if(isset($_POST['update_update_btn']))
{
    $up_quantity=$_POST['update_quantity'];
    $up_id=$_POST['update_quantity_id'];
    $sql2="UPDATE tab_addtocart SET quantity=$up_quantity WHERE id=$up_id";
    $res2=mysqli_query($conn, $sql2);
    if($res2==TRUE)
    {
        
    }
}

if(isset($_GET['remove'])){
    $remove_id=$_GET['remove'];
    $res3=mysqli_query($conn, "DELETE FROM tab_addtocart WHERE id=$remove_id");
}

if(isset($_GET['delete_all'])){
    mysqli_query($conn, "DELETE FROM tab_addtocart");
}
?>
<br><br>
<div class="main-content">
<table class="tabb">
    <tr>
        <th>S.No</th>
        <th></th>
        <th>Item</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total Price</th>
        <th></th>
    </tr>

    <?php
               $sql="SELECT * FROM tab_addtocart";
               $res=mysqli_query($conn,$sql);
               if($res==TRUE)
               {
                 $count=mysqli_num_rows($res);
                 $sn=1;
                 $grand_total=0;
                 if($count>0)
                 {
                    while($rows=mysqli_fetch_assoc($res))
                    {
                        $id=$rows['id'];
                        $title=$rows['title'];
                        $price=$rows['price'];
                        $image=$rows['image'];
                        $quantity=$rows['quantity'];
                        ?>

                        <tr>
                           <td><?php echo $sn++; ?></td>
                           <td><img src="<?php echo SITEURL;?>food/<?php echo $image; ?>" width="100px"></td>
                           <td><?php echo $title; ?></td>
                           <td><?php echo $price; ?></td>
                           <td>
                            <form action="" method="post">
                                <input type="hidden" name="update_quantity_id" value="<?php echo $id; ?>">
                                <input type="number" min="1" name="update_quantity" value="<?php echo $quantity; ?>">
                                <input type="submit" class="btn btn-menu" value="update" name="update_update_btn">
                            </form>
                           </td>
                            <td><?php echo $sub_total=number_format($price*$quantity); ?></td>
                            <td><a href="cart.php?remove=<?php echo $id; ?>" onclick="return confirm('remove item from cart?')" class="btn-danger">Remove</a></td>
                        </tr>
                        <?php
                          $grand_total+=$sub_total;
                    }
                 }
               }
               ?>
               <tr>
                <td colspan="3">Grand Total</td>
                <td><?php echo $grand_total; ?></td>
                <td><a href="cart.php?delete_all" onclick="return confirm('are you sure you want to delete all');" class="btn-danger">Delete All</a></td>
                <td><a href="<?php echo SITEURL; ?>checkout.php" class="btn-danger">Checkout</a></td>
               </tr>
</table>

<div class="checkout-btn">
    <a href="checkout.php" class="btn-danger <?= ($grand_total>1)?'':'disabled';?>">procced to checkout</a>
</div>

</div>
</body>
</html>