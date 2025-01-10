<?php   include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add food</h1>

        <br><br>

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
                        <option value="1">Food</option>
                        <option value="2">Snacks</option>
                        
                    </select>
                </td>
             </tr>

          </table>


        </form>
    </div>
</div>

<?php include('partials/footer.php')?>