<?php include('partials/menu.php') ?>

<?php

//check whweter id is set or not 
if (isset($_GET['id'])) {
    //get all the details 
    $id = $_GET['id'];

    //sql query to get the selectd food
    $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
    //execute the query
    $res2 = mysqli_query($conn, $sql2);

    //get the value based on query executed
    $row2 = mysqli_fetch_assoc($res2);

    //get the individual values of selected food
    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category = $row2['category_id'];
    $Featured = $row2['featured'];
    $active = $row2['active'];
} else {
    //redirect to manage food
    header('location:' . SITEURL . '/admin/manage-food.php');
}
?>





<div class="main-content">
    <div class="wrapper">
        <h1>Update Data</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>

                </tr>

                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                <tr>
                </tr>
                <td>Price:</td>
                <td>
                    <input type="number" name="price" value="<?php echo $price; ?>">
                </td>
                </tr>
                <tr>
                    <td>current Image: </td>
                    <td>
                        <?php
                        if ($current_image == "") {
                            // Image not available
                            echo "<div class='error'>Image not available.</div>";
                        } else {
                            // Image available
                            echo "<img src='" . SITEURL . "/images/food/" . $current_image . "' alt='Food Image' width='100'>";
                            // http://localhost/food-order-app/images/food/Food-Name1257.jpg
                        }
                        ?>

                    </td>
                </tr>
                <tr>
                    <td>Select New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php
                            //query to get active categories
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            //execute the query
                         
                            $res = mysqli_query($conn, $sql);
                            //count rows 
                            $count = mysqli_num_rows($res);
                            // var_dump($count);die;
                            //chek wwheter the category available or not
                            if ($count > 0) {
                                //category available
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $category_title = $row['title'];
                                    $category_id = $row['id'];

                                    //echo "<option value='$category_id'>$category_title</option>"; 
                            ?>
                            <option value="<?php echo $category_id; ?>" <?php if ($current_category == $category_id) { echo "selected"; } ?>><?php echo $category_title; ?></option>

                            <?php
                                }
                            } else {
                                // var_dump($category_title);
                                //category not available 
                                echo "<option value ='0'>Category not available </opyion>";
                            }


                            ?>




                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if ($Featured == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if ($Featured == "No") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if ($active == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="Yes">Yes
                        <input <?php if ($active == "No") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

                        <input type="submit" name="submit" value="update Food" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>

        <?php

        if (isset($_POST['submit'])) {
            // echo "button clicked";
            // var_dump($_POST);die;
            // 1. get all details from the form
            //var_dump($_POST); 
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            
            $category = $_POST['category'];

            $Featured = $_POST['featured'];
            $active = $_POST['active'];

            //2. upload the image if selected
            //check upload button is clicked or not
            if (isset($_FILES['image']['name'])) {
                //upload buton cklied
                $image_name = $_FILES['image']['name']; //new img name
                // var_dump($image_name);die;
                //check whether th img is available or not 
                if ($image_name != "") {
                    //image is availble
                    //A. uplod new img


                    //rename the image
                    $ext = @end(explode('.', $image_name)); //gets the extension of the image

                    $image_name = "Food-Name-" . rand(0000, 9999) . "." . $ext; //this will be renamed

                    //get the soucre path and destination path
                    $src_path = $_FILES['image']['tmp_name'];         //source path
                    $dest_path = "../images/food/" . $image_name;       //destination path

                    //upload the image
                    $upload = move_uploaded_file($src_path, $dest_path);

                    //check whether the img is uploaded or not 
                    if ($upload == false) {
                        //failed to upload
                        $_SESSION['upload'] = "<div class='error'>failed to upload new image.</div>";
                        //redirect to manage food
                        header('location:' . SITEURL . '/admin/manage-food.php');
                        //stop the process
                        die();
                    }
                    //3. remove the image if new image is uploaded and current image exist
                    //B. remove the current img if available C:\laragon\www\food-order-app\images\food\Food-Name-193.jpg
                    // Remove the current image if available
                    $remove_path = "../images/food/" . $current_image;
                    
                    // echo "<br>Path to remove: " . $remove_path . "<br>";

                    // Check if the file exists before trying to unlink
                    if (file_exists($remove_path)) {
                        // Remove the file
                        $remove = unlink($remove_path);

                        // Check if the file was successfully removed
                        if ($remove) {
                            echo "Image removed successfully.";
                            header('location:' . SITEURL . '/admin/manage-food.php');
                        } 
                    } else {
                        echo "Image not found at path: " . $remove_path;
                    }
                }
            }


            //var_dump($category);die;
            //4. update the food in db
            $sql3 = "UPDATE tbl_food SET
                  title='$title',
                  description='$description',
                  price = $price,
                  image_name ='$image_name',
                  category_id ='$category',
                  featured = '$Featured',
                  active= '$active'
                  WHERE id=$id
                  ";

            //execute the sql query
            $res3 = mysqli_query($conn, $sql3);

           //check whether the query is executed or not 
            if ($res3 == true) {
                //query is executed and food updated
                $_SESSION['update'] = "<div class='success'>Data updated successfully.</div>";
                header('loacation:' . SITEURL . '/admin/manage-food.php');
            } else {
                //   failed to update food
                $_SESSION['update'] = "<div class='error'>failed to update food.</div>";
                header('loacation:' . SITEURL . '/admin/manage-food.php');
            }
        }



        ?>

    </div>
</div>

<?php include('partials/footer.php') ?>