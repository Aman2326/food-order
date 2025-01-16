<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>change password</h1>
        <br><br>

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>
                <tr>
                    <td>Confrim Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm password">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="change password" class="btn-secondary">

                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php
//check whether the submit button is cliked or not
if (isset($_POST['submit'])) {
    //echo "clickedd";
    //1. get the data from forms
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);
    
    //2. check wheter the user with curret id and current pasword exists or not
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
    //exectuion of qurey here!
    $res = mysqli_query($conn, $sql);

    // var_dump($id,$current_password,$new_password,$confirm_password,$sql,$res );
    // exit();
    

    if ($res == true) {
        //check whether data is available or not!
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            //user exists and password can be chgned
            // echo "user found";
            //check whether the new password & confirm match or not 
            if ($new_password == $confirm_password) {
                //update the password 
                $sql2 = "UPDATE tbl_admin SET
                        password='$new_password'
                        WHERE id=$id
                        ";

                //ececute the query
                $res2 = mysqli_query($conn, $sql2);

                //chexk whter the query is executed or not 
                if ($res2 == true) {
                    //redirect to manage admin page with error msg 
                    $_SESSION['change-paswrd'] = "<div class='error'>passsword change sucesfully. </div>";
                    //redirect the user 
                    header('location:' . SITEURL . '/admin/manage-admin.php');
                } else {
                    //display error msg
                    //redirect to manage admin page with error msg 
                    $_SESSION['change-paswrd'] = "<div class='error'>passsword change sucesfully. </div>";
                    //redirect the user 
                    header('location:' . SITEURL . '/admin/manage-admin.php');
                }
            } else {
                //redirect to manage admin page with error msg 
                $_SESSION['change-paswrd'] = "<div class='error'>failed to change the password</div></div>";
                //redirect the user 
                header('location:' . SITEURL . '/admin/manage-admin.php');
            }
        } else {
            //user does not exist set message & redirect 
            $_SESSION['user-not-found'] = "<div class='error'>user Not Found</div>";
            //redirect the user 
            header('location:' . SITEURL . '/admin/manage-admin.php');
        }
    }

    //3. check whether the new pasword and confrim password are mathing with each other 
    //4. change Password if all above is true 
}
?>
<?php include('partials/footer.php'); ?>