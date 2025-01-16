<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add food</h1>

        <br><br>

        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl_30">

                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the food">
                    </td>
                </tr>

                <tr>
                    <td>Description</td>
                    <td>
                        <textarea name="description" cols="30" rows="10" placeholder="DESCRIPTION OF THE FOOD"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php

                            //creatye the php code to display categories from db
                            //create the sql to get all the active categories from db
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                            $res = mysqli_query($conn, $sql);

                            //count the rows to check whether we have categories or not 
                            $count = mysqli_num_rows($res);

                            //if count is greater thn zero ,we have categories else we dont hAVE categories
                            if ($count > 0) {
                                //we have categories
                                while ($row = mysqli_fetch_assoc($res)) {
                                    //get the values deatils fo categories 
                                    $id = $row['id'];
                                    $title = $row['title'];

                            ?>

                                    <option value="1"><?php echo $id; ?> <?php echo $title; ?></option>

                                <?php
                                }
                            } else {
                                //we do not have categories
                                ?>
                                <option value="0">No category found</option>
                            <?php
                            }

                            ?>


                            <option value="1">Food</option>
                            <option value="2">Snacks</option>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>


        </form>

        <?php
        //check whewter the button is clicked ot not
        if (isset($_POST['submit'])) {
            
            //echo "clicked";

            //1. get the data from the from
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            //check whetrr radio button for featured and active are chhecked or not 
            if (isset($_POST['featured'])) {
                $Featured = $_POST['featured'];
            } else {
                $Featured = "No"; // setting the default value
            }
            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No"; //setting default value
            }

            //2. upload the image if selected
            //check whether the selected img is clicked or not and upload the img only if the the image is selected
            if (isset($_FILES['image']['name'])) {
                //get the details of the selected image 
                $image_name = $_FILES['image']['name'];

                //check wheter the image is seleced or not and upload img only if selected
                if ($image_name != ""); {
                   
                    //a. rename the img
                    //get the extension of selected img (jpg,pnh, gif etc)
                    $ext = end(explode('.', $image_name));
                    var_dump($ext);
                    //create a new name fr img 
                    $image_name = "Food-Name" . rand(0000, 9999) . "." . $ext;  

                    //b. upload the img
                    //get the src path and destination path

                    //soucrce path is current location of the img
                    $src = $_FILES['image']['tmp_name'];

                    //destination path for the image to be uploaded
                    $dst = "../images/food/" . $image_name;
                   
                    //now upload the food img
                    $upload = move_uploaded_file($src, $dst);

                    //check whetr the img upload or not
                    if ($upload == false) {
                        //failed to upload img
                        //redirect to add  food page with error msg
                        $_SESSION['upload'] = "<div class='error' >failed to upload image.</div>";
                        header('location:' . SITEURL . '/admin/add-food.php');
                        //stop the process
                        die();
                    }
                }
            } else {
                $image = ""; //setting  default value as blank
            }

            //3.insert into db
            //create a sql query to save or add 
            //for numericl value we do nto need to pass value inside quotes '' but for string value it is compulsory to add quote''

            $sql2 = "INSERT INTO tbl_food SET
            title = '$title',
            description = '$description',
            price = '$price',
            image_name = '$image_name',
            category_id = '$category',
            Featured = '$Featured',
            active = '$active'
            ";
            
            //execute the query 
            $res2 = mysqli_query($conn, $sql2);
            //check wheter data insertd or not

            if($res2 == true)
            {
                //data inseerted successfully 
                $_SESSION['add'] = "<div class='sucsess'>Data Added Successfully</div>";
                header('location:'.SITEURL.'/admin/manage-food.php');
                echo "data is inserted";

            }
            else{
                //failed to insert data 
                $_SESSION['add'] = "<div class='error'>Failed to add Data.</div>";
                header('location:'.SITEURL.'/admin/manage-food.php');
                 
            }

            
        }



        ?>






    </div>
</div>

<?php include('partials/footer.php') ?>