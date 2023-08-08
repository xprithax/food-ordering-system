<?php include('partials/nav.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>
        <br><br>
        <br/></br>
        
        <table class="tabb">
            <tr>
                <th>S.no</th>
                <th>Food</th>
                <th>Price</th>
                <th>Customer name</th>
                <th>Customer phone</th>
                <th>Customer email</th>
                <th>Customer address</th>
                <th>Method</th>
            </tr>
            <?php
               $sql="SELECT * FROM tab_order";
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
                        $food=$rows['total_products'];
                        $price=$rows['total_price'];
                        $customer_name=$rows['name'];
                        $customer_phone=$rows['number'];
                        $customer_email=$rows['email'];
                        $customer_address=$rows['address'];
                        $method=$rows['method'];
                        ?>

                        <tr>
                           <td><?php echo $sn++; ?></td>
                           <td><?php echo $food; ?></td>
                           <td><?php echo $price; ?></td>
                           <td><?php echo  $customer_name; ?></td>
                           <td><?php echo $customer_phone; ?></td>
                           <td><?php echo $customer_email; ?></td>
                           <td><?php echo $customer_address; ?></td>
                           <td><?php echo $method; ?></td>
                           <!--<td>
                              <a href="admin/update-food.php?id=" class="btn-secondary">update food</a>
                              <a href="admin/delete-food.php?id=&image_name=" class="btn-danger">delete food</a>
                            </td>
                        </tr>-->
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