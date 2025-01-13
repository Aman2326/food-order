<?php
//session_start();
include('../config/constants.php');

//echo "redirect";

if (isset($_GET['id']) && isset($_GET['image_name'])) {
  
   // echo "process to delete";

   //1.get id and image name
   $id = $_GET['id'];
   $image_name = $_GET['image_name'];

   //2.remove the image if available
   //check whether the image is available or not and delete only if available
   if($_image_name !="");
   {
     //it has image and need to remove from folder
     //get the image is availble or not and delete only if available
     $path = "../image/food".$image_name;

     //remove img file from folder
     $remove = unlink($path);

     //check whter tyhe img rmoved or not 
     if($remove==false)
     {
        //failed to remove img
        $_SESSION['upload']= "<div class='error'>failed to remove img file.</div>";
        //redirect to manage food
        header('location:'.SITEURL.'/admin/manage-food.php');
        //stop the process of deleting food
        die();
     }
   }

   //3.delete food from database

   $sql = "DELETE FROM  tbl_food WHERE id=$id";
   //excute the query
   $res = mysqli_query($conn, $sql);

   //check the query executed or not and set the session msg respectively
   //4.redirect to manage food with session msg

   if($res==true)
   {
    //food deleted
    $_SESSION['unauthorize'] = "<div class ='sucess'>food deleted sucessfully .</div>";
    header('location:'.SITEURL.'/admin/manage-food.php');

   }
   else
   {
      //failed to delete food
   }

   

} else {
    // Redirect to manage food page
    //echo "redirect";

    $_SESSION['delete'] = "<div class='error'>Unauthorized Access.</div>";
   
    header('location:'.SITEURL.'/admin/manage-food.php');
}
