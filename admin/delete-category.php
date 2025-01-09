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

    //remove the physical image file if available 
    if ($image_name != "") {
        //img is available so remove it 
        $path = "../images/category/" . $image_name;
        //remove the image
        $remove = unlink($path);

        if ($remove == false) { //if failed to remove img then an error msg and stop the process
            //set the session msg
            $_SESSION['remove'] = "<div class='error'>Failed to remove category image.</div>";

            //redirect to manage category page
            header('location:' . SITEURL . 'admin/manage-category.php');

            //stop the process
            die();
        }
    }

    //delete data from the db
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


    //delete data from db
    //sql query delete data from databse
    $sql = "DELETE FROM tbl_category WHERE id=$id";

    //execute the query
    $res = mysqli_query($conn, $sql);

    //check wheter the data is delete from db or not
    if($res==true)
    {
        //set success msg and redirect
        $_SESSION['delete'] = "<div class='sucess'>category deleted sucessfully.</div";
        //redirect to manage category
        header('location:'.SITEURL.'/admin/manage-category.php');
    

    }
    else{
        //set fail msg and direct 
          //set success msg and redirect
          $_SESSION['delete'] = "<div class='sucess'>Failed to delete category.</div>";
          //redirect to manage category
          header('location:'.SITEURL.'/admin/manage-category.php');
    }
    
    } 
    else
     {
        //redirect to manage category page 
        header('location:' . SITEURL . '/admin/manage-category.php');
    }
    
