<?php
  include('partials/constants.php');
  $id= $_GET['id'];
  $sql="DELETE FROM tab_admin WHERE id=$id";
  $res=mysqli_query($conn, $sql);
  if($res==TRUE)
  {
    $_SESSION['delete']="<div class='success'>Admin deleted successfully.</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
  }
  else{
    $_SESSION['delete']="<div class='error'>Admin failed to delete.</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');

  }
?>