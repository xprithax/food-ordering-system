<?php include('partials/nav.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br/><br/>
        <?php
          if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
          }
        ?>
        <form action="" method="POST">
            <table class="tabb30">
                <tr>
                    <td>Full name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter your name."></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="Enter User name"></td>

                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Enter password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>


<?php include('partials/footer.php'); ?>

<?php
  if(isset($_POST['submit']))
  {
    $full_name=$_POST['full_name'];
    $username=$_POST['username'];
    $password=md5($_POST['password']);
    
    $sql="INSERT INTO tab_admin SET
        full_name='$full_name',
        username='$username',
        password='$password'
    ";

    $res=mysqli_query($conn,$sql) or die(mysqli_error());

    if($res==TRUE)
    {
        //echo "data inserted";
        $_SESSION['add']="Admin added successfully.";
        header("location:".SITEURL.'admin/manage-admin.php');
    }
    else{
       // echo "data entry failed";
       $_SESSION['add']="Failed to add admin.";
       header("location:".SITEURL.'admin/add-admin.php');
    }


  }

?>
