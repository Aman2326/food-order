<?php

//start session 
session_start();


// Here, creating constants to store non-repeating values

define('SITEURL','http://localhost/food-Order');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'foodorder');


$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); 

$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn)); 
?>
