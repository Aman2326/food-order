<?php
//inclde constant.php for siterul
include('../config/constants.php');
//1.destroy the session 
session_destroy(); //unset $_session['user']

//2.redirect to login page 
header('location:' . SITEURL . '/admin/login.php');
?>
