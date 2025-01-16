<?php include('../config/constants.php'); ?>

<html>

<head>
    <title>Login - FoodRecord system</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="login">

        <h1 class="text-center">login</h1>
        <br><br>
        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
          if(isset($_SESSION['no-login-message']))
          {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
          }
        ?>
        <br><br>



        <!-- login form starts here -->

        <form action="" method="POST" class="text-center">
            username: <br>
            <input type="text" name="username" placeholder="Enter username"><br><br>

            password: <br>
            <input type="password" name="password" placeholder="Enter Password"><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>

        </form>

        <!-- login form ends here -->

        <p class="text-center">created By - <a href="linkedin.com/in/aman-rajbhar-401520313" target="_blank" style="text-decoration: none; color: blue;">Aman Rajbhar</a></p>
    </div>
</body>

</html>

<?php

//check whether the submit btn is clickd or not!
if (isset($_POST['submit'])) {
    //process for login 
    //1.get the data from login form
    echo $username = $_POST['username'];
    echo $password = md5($_POST['password']);

    //2. sql to check whether the user with username and password exists or not!
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    //3. execute the query 
    $res = mysqli_query($conn, $sql);


    //4. count rows to check whether the user exists or not 
    $count = mysqli_num_rows($res);

    if ($count == true) {
        //user available and login succesfull
        $_SESSION['login'] = "<div class='sucess'>Login sucessful.</div>";
        $_SESSION['user'] = $username; //tp check wheter the user loged in or not logout will unset it 
        //redirect to dash page
        header('location:' . SITEURL . '/admin/index.php');
    } else {
        //user not available and login fails
        $_SESSION['login'] = "<div class='error text-center'>username or password did not match.</div>";
        //rediect to dashboard 
        header('location:' . SITEURL . '/admin/login.php');
    }
}

?>