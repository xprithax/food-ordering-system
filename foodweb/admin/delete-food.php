<?php
   include('partials/constants.php');

   if(isset($_GET['id']) && isset($_GET['image_name']))
   {
      $id=$_GET['id'];
      $image_name=$_GET['image_name'];
      if($image_name != "")
      {
        $path="../food/".$image_name;
        $remove = unlink($path);
        if($remove==FALSE){
            $_SESSION['upload']="Failed to remove image file";
            header('location:'.SITEURL.'admin/menu.php');
            die();
        }

      }

      $sql="DELETE FROM tab_menuitem WHERE id=$id";
      $res=mysqli_query($conn, $sql);
      if($res==TRUE)
      {
        $_SESSION['delete']="Food Deleted Successfully.";
        header('location:'.SITEURL.'admin/menu.php');
      }
      else{
        $_SESSION['delete']="Food Deletion Unsuccessful.";
        header('location:'.SITEURL.'admin/menu.php');
      }
     
   }
   else{

      $_SESSION['unauth']="Unauthorized access.";
      header('location:'.SITEURL.'admin/menu.php');
   } 
?>