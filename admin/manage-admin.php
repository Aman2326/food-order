<?php include('partials/menu.php'); ?>

<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br />

        <!-- Button to add admin -->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>

        <br /><br /><br />

        <table class="tbl-full">
            <tr>
                <th>Sr.No</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <tr>
                <td>1.</td>
                <td>Misogynist 23</td>
                <td>Misogamist 26</td>
                <td>
                    <a href="#" class="btn-secondary">Upadte Admin</a>
                    <a href="#" class="btn-danger">Delete Admin</a>

                </td>
            </tr>

            <tr>
                <td>2.</td>
                <td>Misogynist 23</td>
                <td>Misogamist 26</td>
                <td>
                    <a href="#" class="btn-secondary">Upadte Admin</a>
                    <a href="#" class="btn-danger">Delete Admin</a>
                </td>
            </tr>

            <tr>
                <td>3.</td>
                <td>Misogynist 23</td>
                <td>Misogamist 26</td>
                <td>

                    <a href="#" class="btn-secondary">Upadte Admin</a>
                    <a href="#" class="btn-danger">Delete Admin</a>

                </td>
            </tr>
        </table>



        <div class="clearfix"></div> <!-- To clear the floats -->
    </div>
</div>
<!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>