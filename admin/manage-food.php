<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>

        <br />


        <!-- Button to add admin-->
        <a href="<?php echo SITEURL; ?>/admin/add-food.php" class="btn-primary">Add Food</a>


        <br /><br /><br />

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if(isset($_SESSION['unauthorize']))
        {
            echo $_SESSION['unauthorize'];
            unset($_SESSION['unauthorize']);
        }

        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        ?>

        <table class="tbl-full">
            <tr>
                <th>Sr.No</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
            //create a sql query to get all the food
            $sql = "SELECT * FROM tbl_food";
            //execute the query

            $res = mysqli_query($conn, $sql);

            //count rows to check wheter we have foods or not
            $count = mysqli_num_rows($res);

            //create serial no.and setdefault value 1
            $sn = 1;

            $row = 0;

            if ($count) {
                //we have foods , display them
                //get the food from db and display
                while ($row = mysqli_fetch_assoc($res)) {
                    //get the valus from individual columns
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $Featured = $row['featured'];
                    $active = $row['active'];
                    ?>



                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>
                        <td>₹<?php echo $price; ?></td>
                        <td>
                            <?php
                            //check wheter we have img or not 
                            if ($image_name == "") {
                                //we do nto have img dislpay error msg
                                echo "<div class='error'> Image not added.</div>";
                            } else {
                                //we have img display it
                            ?>

                                <img src="<?php echo SITEURL; ?>/images/food/<?php echo $image_name; ?>" width="150">

                                    <?php
                                }
                                    ?>
                        </td>
                        <td><?php echo $Featured; ?></td>
                        <td><?php echo $active; ?></td>

                        <td>
                            <a href="<?php echo SITEURL; ?>/admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                            <a href="<?php echo SITEURL; ?>/admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>

                        </td>
                    </tr>
            <?php

                }
            } else {
                //food not addes in db
                echo "<tr> <td colspan='7' class='error'>Food NOT Added yet. </td> </tr>";
            }

            ?>

        </table>
    </div>

</div>


<?php include('partials/footer.php'); ?>