<?php 
include('partial-host/nav.php'); 
if(isset($_POST['order_btn'])){
    $name=$_POST['name'];
    $number=$_POST['number'];
    $email=$_POST['email'];
    $address=$_POST['address'];
    $method=$_POST['method'];

    $res=mysqli_query($conn, "SELECT * FROM tab_addtocart");
    $product_total=0;
    if(mysqli_num_rows($res)>0){
        while($product_item=mysqli_fetch_assoc($res))
        {
            $product_name[]=$product_item['title'].'('.$product_item['quantity'].')';
            $product_price=number_format($product_item['price']*$product_item['quantity']);
            $product_total += $product_price;

        }

    }

    $total_product=implode(',',$product_name);
    $detail_query=mysqli_query($conn, "INSERT INTO tab_order SET name='$name', number='$number', email='$email', address='$address', method='$method', total_products='$total_product', total_price='$product_total'");
    if($res && $detail_query){
        header('location:'.SITEURL.'thanks.php');
    }
}
?>
<div class="main-content">
<h1>COMPLETE YOUR ORDER</h1>
<div class="display-order">
    <?php
      $cart = mysqli_query($conn, "SELECT * FROM tab_addtocart");
      $total=0;
      $grand_total=0;
      if(mysqli_num_rows($cart)>0){
        while($fetch_cart=mysqli_fetch_assoc($cart)){
            $total_price=number_format($fetch_cart['price']*$fetch_cart['quantity']);
            $grand_total= $total+=$total_price;
            ?>
            <span><?=$fetch_cart['title']; ?>(<?=$fetch_cart['quantity']; ?>)</span>
            <?php
        }
        
      }
      else{
        echo "<div class='display-order'> <span> Your cart is empty!!</span></div>";
    }
    ?>
    <span class="grand-total"> Grand Total:<?php echo $grand_total; ?> </span>
</div>
<div class="checkout-form">
<form action="" method="post">
    <div class="flex">
    <div class="checkoutt"><span>Your Name:</span>
    <input type="text" name="name" placeholder="Enter your name"></div>
    <div class="checkoutt"><span>Your Phone:</span>
    <input type="number" name="number" placeholder="Enter your number"></div>
    <div class="checkoutt"><span>Your Email:</span>
    <input type="text" name="email" placeholder="Enter your email"></div>
    <div class="checkoutt"><span>Your Address:</span>
    <input type="textarea" name="address" placeholder="e.g. flat no"></div>
    <div class="checkoutt"><span>Payment Method:</span>
    <select name="method" >
        <option value="Cash on delivery">Cash on delivery</option>
        <option value="paytm">paytm</option>
        <option value="UPI">UPI</option>
        <option value="Credit">Credit card</option>
    </select></div>
    <input type="submit" value="Order now" name="order_btn" class="btn-danger">
</div>
</form>
</div>

</div>


</body>
</html>