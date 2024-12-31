<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name "></td>
                </tr>
                <tr>
                    <td>Usename: </td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username">
                    </td>
                </tr>

                <td>Password: </td>
                <td>
                    <input type="password" name="password" placeholder="Your password ">

                </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">

                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php
// process the value form and save it in databse //
//check whether the button is clicked or not //

if (isset($_POST['submit'])) {
    //button cliked 
    // echo "Button clicked";

    //get the data ffrom form 
    $full_name = $_POST['full_name'];
    
}
?>
<script type="text/javascript">
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
