<?php

    include('config/constants.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Go Corona Go</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

    <link rel="stylesheet" href="<?php echo SITEURL;?>css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
    <div class="menu">
        <h1>GO CORONA GO</h1>
        <a href="index.php">Home</a>
        <a href="stock.php">Go Back to Stock List</a>
    </div>
    <h3>Add New Stock</h3>
    <p class="neg-para">
        <?php
            // check if the session created or not
            if(isset($_SESSION['add_fail'])){

                //display session message
                echo $_SESSION['add_fail'];
                //remove the message after displaying once
                unset($_SESSION['add_fail']);
            }
        ?>
    </p>
    <!-- form to add list starts here -->
    <form method="POST" action="">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Item Name: </label>
            <input type="text" name="item_name"  class="form-control" id="exampleFormControlInput1" placeholder="Example: Remdesvir, oxymeter etc" required="required" >
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Quantity</label>
            <input type="number" name="count" class="form-control" id="exampleFormControlTextarea1" rows="3">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Status</label>
            <input type="text" name="status" class="form-control" id="exampleFormControlTextarea1" rows="3">
        </div>
            <button type="submit" name="submit" value="Submit" type="button" class="btn btn-primary btn-cust">Save</button>
    </form>
    <!-- form to add list ends here -->
</body>
</html>
<?php

    // check wheather the form is submitted or not
    if(isset($_POST['submit'])){
        // to get the value from the table 

        $item_name= $_POST['item_name'];
        $count=$_POST['count'];
        $status=$_POST['status'];
        // echo $list_name, $list_desc;

        //connect database
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

        //check wheather the database connected or not
        // if($conn == true){
        //     echo "database connected";
        // }

        //select database
        $db_select = mysqli_select_db($conn, DB_NAME);
        
        //check if database selected or not
        /*if($db_select==true){
            echo "data base selected is connected";
        }
        */
        //sql query to insert data into database 
        echo $sql = "INSERT INTO stock SET
            item_name = '$item_name' ,
            quantity = $count,
            date_of_update = '".gmdate("Y-m-d")."',
            status='$status'
        ";

        //execute query and insert into database

        $res = mysqli_query($conn, $sql);

        if($res == true){
            
        //     //echo "Query executed and data inserted into database";

            // create a session to display message
            $_SESSION['add'] = "List added successfully";

            //redirect to manage list page

           header('location:'.SITEURL.'stock.php');
            
            
        }
        else{
           //echo "Query failed";

            $_SESSION['add_fail'] ="New item not added, failed";

            header('location:'.SITEURL.'add-stock.php');
        }

    }

?>