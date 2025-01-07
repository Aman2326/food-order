<?php
// Include the menu (this will be included once at the top)
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br><br>

        <?php
        if(isset($_SESSION['add'])) //checking whether the session is set or not 
        {
            echo $_SESSION['add']; //diplay the session message if set
            unset($_SESSION['add']); //remove the session message 
        }
        ?>

        <!-- Form to add a new admin -->
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name" required></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" placeholder="Your Username" required></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Your password" required></td>
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

<?php
// Process the form and save data to the database
if (isset($_POST['submit'])) {
    // Get data from the form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);  // Password encryption (e.g., bcrypt, hash)

    // SQL query to save data into the database
    $sql = "INSERT INTO tbl_admin SET
         full_name='$full_name',
         username='$username',
         password='$password'
    ";

    // Create a database connection
    $conn = mysqli_connect('localhost', 'root', '') or die(mysqli_error($conn));

    // Select the database
    $db_select = mysqli_select_db($conn, 'foodorder') or die(mysqli_error($conn));

    // Execute query and save data in the database
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    // Check whether the query was executed successfully
    if ($res == TRUE) {
        $_SESSION['add'] = "Admin Added Successfully";
        header("location:" . SITEURL . '/admin/manage-admin.php');  // Redirect to manage-admin.php page
    }
}
?>

<?php
// Include footer (this is typically the closing part of the page)
include('partials/footer.php');
?>


<script type="text/javascript">
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>