<?php
//include constants.php file here
include('../config/constants.php');

// 1. get the id of admin to be deleted
echo $id = $_GET['id'];

//2. create sql query to delete admin
$sql = "DELETE FROM tbl_admin WHERE id=$id";

//Execute the query 
$res = mysqli_query($conn, $sql);

//check whether the query executed sucessfully or not 
if ($res == true) {
    //query executed sucessfully and admin deleted
    //echo "ADMIN DELETED";
    //created session variable to display message 
    $_SESSION['delete'] = "Admin Deleted succesfully";
    //Redirect to manage admin page
    header('location:' . SITEURL . '/admin/manage-admin.php');
} else {
    
    // echo "Failed to delete admin";

    $_SESSION['delete'] = "Failed to Delete Admin. try again later.";
    header('location:' . SITEURL . '/admin/manage.php');
}


