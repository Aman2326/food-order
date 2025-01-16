<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add category</h1>

        <br><br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <br><br>

        <!-- add category from starts-->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>



                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="Featured" value="Yes"> Yes
                        <input type="radio" name="Featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active:
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>


            </table>

        </form>
        <!-- add category from ends -->
        <?php

        //check wheter the submit button is clicked or not

        if (isset($_POST['submit'])) {
            //echo 'clicked'; // & its woking

            //1. get the value from category form 
            $title = $_POST['title'];

            //for radio input tag we need to check whter the btn is selected or not!...
            if (isset($_POST['Featured'])) {
                //get the value from form 
                $Featured = $_POST['Featured'];
            } else {
                //set the default value
                $Featured = "No";
            }

            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No";
            }

            //check whether the images is selected or not & set the value for img name accordingly.
            
            if (isset($_FILES['image']['name'])) {
                //upload the image 
                //to uplod image we need img name & source path and destination path
                $image_name = $_FILES['image']['name'];
                
                 //upload the image only if the image is selected
                 if($image_name != "")
                 {

                 
                    //auto rename our image 
                    //get the extension of our img (jpg,png,gif,) eg "specialfood1.jpg"
                    $ext = end(explode('.', $image_name));

                    //rename the image name 
                    $image_name = "Food-Category_" . rand(000, 999) . '.' . $ext; //eg food_Category_834.jpg
                    
                    $source_path = $_FILES['image']['tmp_name'];


                    $destination_path = "../images/category/" . $image_name;

                    //finally upload the img
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //check whether the image upload or !
                    //& if the img ! upload then stop and redirect with error msg. 
                    if ($upload == false) {
                        //set msg
                        $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                        //redierct to add category page
                        header('loaction:' . SITEURL . '/admin/add-category.php');
                        //stop process
                        die();
                    }
                }
            } else {
                //do nto upload the image and set the image_name value as blank
                $image_name = "";
            }

            //2.create sql query to insert category into database
            $sql = "INSERT INTO tbl_category SET
               title='$title',
               image_name='$image_name',
               Featured='$Featured',
               active='$active'
               ";

            //3. execute the query in db & save
            $res = mysqli_query($conn, $sql);

            //4. check whther the query executed or not 
            if ($res == true) {
                //query executede and category added 
                $_SESSION['add'] = "<div class='sucess'>Added sucessfully.</div>";
                //redirect to manage category page
                header('location:' . SITEURL . '/admin/manage-category.php');
            } else {
                //failed to add 
                $_SESSION['add'] = "<div class='sucess'>failed to add category.</div>";
                //redirect to manage category page
                header('location:' . SITEURL . '/admin/manage-category.php');
            }
        }

        ?>

    </div>
</div>


<?php include('partials/footer.php'); ?>