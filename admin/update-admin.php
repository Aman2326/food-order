<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>update Admin</h1>
        <br><br>

        <?php
        //1. get the id of selected Admi
        $id = $_GET['id'];

        //2. create sql query to get the details 
        $sql = "SELECT * FROM tbl_admin WHERE id=$id";

        //execute the query 
        $res = mysqli_query($conn, $sql);
        //var_dump($res = mysqli_query($conn, $sql)); die;


        //check whether the query is executed or not 
        if ($res == true) {
            
            //check whether the data is available or not 
            $count = mysqli_num_rows($res);
            
            //check whether ew have admin data or not 
            if ($count == 1) {
                
                //get the details 
                //echo "Admin Available";
                $row = mysqli_fetch_assoc($res);
                

                $full_name = $row['full_name'];
                $username = $row['username'];
              
            } else {
                //Redirect to manage Admin Page
                header('location:' . SITEURL . '/admin/manage-admin.php');
            }
        }

        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                </td>

            </table>
        </form>
    </div>
</div>
<?php
//check whether the submit button is clicked or not
if (isset($_POST['submit'])) {
    
    //echo "button clicked";
    //get all the values from form to update
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    

    //create a sql query to update admin
    $sql = "UPDATE tbl_admin SET
    full_name = '$full_name',
    username = '$username'
    WHERE id='$id'
    ";

    //execute the query
    
    $res = mysqli_query($conn, $sql);
    // var_dump($res); die;
   

    //check whether the sql query executed succesfully or not 
    if ($res == true) {
        //query executed and admin updated 
        $_SESSION['update'] = "<div class='success'>Admin updated sucessfully.</div>";
        //redirect to manage admin page
        header('location:' . SITEURL . '/admin/manage-admin.php');
    } else {

        //failed to update admin
        $_SESSION['update'] = "<div class='success'>Admin updated sucessfully.</div>";
        //redirect to manage admin page
        header('location:' . SITEURL . '/admin/manage-admin.php');
    }
}
?>

<?php include('partials/footer.php'); ?>