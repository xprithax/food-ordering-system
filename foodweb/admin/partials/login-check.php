<?php
  include('constants.php'); 
  if(!isset($_SESSION['user']))
  {
    $_SESSION['no-login-message']="Login to access admin";
    header('location:'.SITEURL.'admin/login.php');
  }

?>