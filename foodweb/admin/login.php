<?php include('partials/constants.php'); ?>
<html>
    <head>
        <title>Login- Food web</title>
        <link rel="stylesheet" href="../admin.css">
    </head>
    <body>
        <div class="login">
            <h1>Login</h1><br><br>
            <?php
              if(isset($_SESSION['login-unsuccessful'])){
                 echo $_SESSION['login-unsuccessful'];
                 unset($_SESSION['login-unsuccessful']);
              }

              if(isset($_SESSION['no-login-message'])){
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
             }
            ?>
            <form action="" method="POST">
                Username:
                <input type="text" name="username" placeholder="Enter Username"> <br><br>
                Password:
                <input type="password" name="password" placeholder="Enter Password"> <br><br>

                <input type="submit" value="Login" name="submit" class="btn-primary">

            </form>
        </div>
    </body>
</html>

<?php
   if(isset($_POST['submit']))
   {
      $username=$_POST['username'];
      $password=md5($_POST['password']);

      $sql="SELECT * FROM tab_admin WHERE username='$username' AND password='$password' ";
      $res=mysqli_query($conn, $sql);

      $count=mysqli_num_rows($res);
      if($count==1)
      {
        $_SESSION['login-successful']="Login Successful";
        $_SESSION['user']=$username;
        header('location:'.SITEURL.'admin/');
      }
      
      else{
        $_SESSION['login-unsuccessful']="Wrong username and password combination";
        header('location:'.SITEURL.'admin/login.php');
      }
   }

?>