<?php

//auth - accesss cntl
//checkwheter the user is logged in or not!

if (!isset($_SESSION['user']))  // ! if useer session is not set

{
    //useer is not logged in 
    //rediect to login page with msg
    $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access Admin opanel.</div>";

    //redirect to login page 
    header('location:' . SITEURL . '/admin/login.php');
}
