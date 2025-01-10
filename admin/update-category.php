<?php include('partials/menu.php'); ?> 

<div class="main-content">
    <div class="main-content">
        <div class="wrapper">
            <h1>Update Category</h1>  <!-- Fixed the h1 tag closing -->

            <br><br>

            <?php
            // Check if the ID is set
            if (isset($_GET['id'])) {
                // Get the ID and all the details
                $id = $_GET['id'];
                
                // Create SQL query to get the other details
                $sql = "SELECT * FROM tbl_category WHERE id=$id";
                
                // Execute the query
                $res = mysqli_query($conn, $sql);

                // Count the rows to check whether the ID is valid or not
                $count = mysqli_num_rows($res);

                if ($count == 1) {
                    // Get all details 
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $Featured = $row['featured'];
                    $active = $row['active'];
                } else {
                    // Redirect to manage category with session message
                    $_SESSION['no-category-found'] = "<div class='error'>Category not found.</div>";
                    header('location:' . SITEURL . '/admin/manage-category.php');
                }
            } else {
                // Redirect to manage category
                header('location:' . SITEURL . '/admin/manage-category.php');
            }
            ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" value="<?php echo $title; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Current image: </td>
                        <td>
                            <?php
                            if ($current_image != "") {
                                // Display image
                                ?>
                                <img src="<?php echo SITEURL; ?>/images/category/<?php echo $current_image; ?>" width="390px">
                            <?php
                            } else {
                                echo "<div class='error'>Image not added.</div>";
                            }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>New image: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>

                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input <?php if ($Featured == "Yes") echo "checked"; ?> type="radio" name="Featured" value="Yes">Yes
                            <input <?php if ($Featured == "No") echo "checked"; ?> type="radio" name="Featured" value="No">No
                        </td>
                    </tr>

                    <tr>
                        <td>Active:</td>
                        <td>
                            <input <?php if ($active == "Yes") echo "checked"; ?> type="radio" name="active" value="Yes">Yes
                            <input <?php if ($active == "No") echo "checked"; ?> type="radio" name="active" value="No">No
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>

            <?php
            if (isset($_POST['submit'])) {
                // Get all the values from the form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $Featured = $_POST['Featured'];
                $active = $_POST['active'];

                // Handle image upload if a new image is selected
                if (isset($_FILES['image']['name'])) {
                    // Get the image details
                    $image_name = $_FILES['image']['name'];

                    // Check if the image is available
                    if ($image_name != "") {
                        // Image is available
                        $ext = end(explode('.', $image_name));
                        $image_name = "Food-Category_" . rand(000, 999) . '.' . $ext;
                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/category/" . $image_name;

                        // Upload the image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        if ($upload == false) {
                            $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                            header('location:' . SITEURL . '/admin/manage-category.php');
                            die();
                        }

                        //B. Remove the old image
                        $remove_path = "../images/category/" . $current_image;
                        $remove = unlink($remove_path);

                        if ($remove == false)
                         {
                            //Failed to remove img
                            $_SESSION['failed-remove'] = "<div class='error'>Failed to remove the current image.</div>";
                            header('location:' . SITEURL . '/admin/manage-category.php');
                            die();
                        }
                    } else {
                        $image_name = $current_image;
                    }
                } else {
                    $image_name = $current_image;
                }

                // Update the database
                $sql2 = "UPDATE tbl_category SET
                            title = '$title',
                            featured = '$Featured',
                            active = '$active',
                            image_name = '$image_name'
                          WHERE id = $id";

                $res2 = mysqli_query($conn, $sql2);

                if ($res2 == true) {
                    $_SESSION['update'] = "<div class='success'>Category updated successfully.</div>";
                    header('location:' . SITEURL . '/admin/manage-category.php');
                } else {
                    $_SESSION['update'] = "<div class='error'>Failed to update category.</div>";
                    header('location:' . SITEURL . '/admin/manage-category.php');
                }
            }
            ?>
        </div>
    </div>
</div>

<?php include('partials/footer.php'); ?>
