<?php
//include constant file 
include('../config/constants.php');

//echo "delete page";
//check whether the id and image_name value is set or not 
if (isset($_GET['id']) AND isset($_GET['image_name'])) {
  
    //get the value and delete
    //echo "get the value and delete";
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
   
    
    if ($image_name != "") {
        //img is available so remove it images\category\Food-Category_39.jpg
        $path = "../images/category/" . $image_name;
        // var_dump(     $remove = unlink($path));die;
        //remove the image
        if($path){
            $remove = unlink($path);
            // var_dump($remove);die;
        
        $sql = "DELETE FROM tbl_category WHERE id=$id";
    
        //execute the query
        $res = mysqli_query($conn, $sql);
    
        //check whether the data is deleted from the database or not
        if ($res == true) {
            //set the success msg and redirect
            $_SESSION['delete'] = "<div class='success'> categoryDeleted successfully.</div>";
            //redirect to manage category
            header('location:' . SITEURL . '/admin/manage-category.php');
        } else {
            //set fail msg and redirect
            $_SESSION['delete'] = "<div class='error'>Failed to delete category.</div>";
            //redirect to manage category
            header('location:' . SITEURL . '/admin/manage-category.php');
        }
    }

}

}
