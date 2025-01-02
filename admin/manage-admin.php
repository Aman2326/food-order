<?php include('partials/menu.php'); ?>

<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br />

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']); // Removing session message 
        }

        // Button to add admin
        ?>
        <a href="add-admin.php" class="btn-primary">Add Admin</a>

        <br /><br /><br />

        <table class="tbl-full">
            <tr>
                <th>Sr.No</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php
            //qurey to get all admin
            $sql = "SELECT * FROM tbl_admin";
            //excuse the query
            $res = mysqli_query($conn, $sql);

            //check whether the query is executed or not
            if ($res ==TRUE) {
                // count rows to check whether we have data in databse or not
                $rows = mysqli_num_rows($res); //function to get all the rows in database

                $sn=1; // create a varaible and assign the values



                //check the num of rows 
                if ($rows > 0) {
                    //we got data in dbase...
                    while ($rows = mysqli_fetch_assoc($res)) {
                        //using while loop to get all the data from database.
                        //And while loop will run as we have data in database.

                        //get individual data 
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];

                        //display the values in our Table...
            ?>

                        <tr>
                            <td><?php echo $sn++;?></td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $username;?></td>
                            <td>
                                <a href="#" class="btn-secondary">Update Admin</a>
                                <a href="#" class="btn-danger">Delete Admin</a>
                            </td>
                        </tr>


            <?php

                    }
                } else {
                    //we dont have data in Dbase...

                }
            }
            ?>

            
        </table>

        <div class="clearfix"></div> <!-- To clear the floats -->
    </div>
</div>
<!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>


