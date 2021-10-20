<?php

    include('config/constants.php');

    if(isset($_GET['item_id'])){
        //get the list id value
        $item_id = $_GET['item_id'];
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

        //sql query to get the values from database
        $sql = "SELECT * FROM stock
                WHERE item_id=$item_id";

        $res = mysqli_query($conn, $sql);

        //to check execution of query
        if($res == true){
            //get the value from database
            //value in array format
            $row = mysqli_fetch_assoc($res);
            //print_r($row);

            //create indvidual variable to save the data
            $item_id=$row['item_id'];
            $item_name=$row['item_name'];
            $count=$row['quantity'];
            $date_up=$row['date_of_update'];
            $status=$row['status'];
            
        }
        else{
            //go back to manage list page
            header('location:'.SITEURL.'stock.php');
        }
    }
?>

<html>
<head>
    <title>Go Corona Go</title>
     <!-- Font Awesome -->
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

        <link rel="stylesheet" href="<?php echo SITEURL;?>css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
    <ul>
        <li><h1 class="menu-h1">GO CORONA GO</h1></li>
        <li style="float:right"><a class="menu-h1" href="<?php echo SITEURL; ?>stock.php">Go back to stock list</a></li>
        <li style="float:right"><a class="menu-h1" href="<?php echo SITEURL; ?>">Home</a></li>
    </ul>
    
    <div class="side-space">
    <h3 style="text-align:center">Update stock information</h3>
    <p class="neg-para">
        <?php
            //wheather session is set or not
            if(isset($_SESSION['update_fail'])){
                echo $_SESSION['update_fail'];
                unset($_SESSION['update_fail']);
            }
        ?>
    </p>
    
    <!-- form to update list starts here -->
    <form method="POST" action="">
    <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Item Name: </label>
            <input type="text" name="item_name"  class="form-control" id="exampleFormControlInput1" value="<?php echo $item_name; ?>" required="required" >
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Quantity</label>
            <input type="number" name="quantity" class="form-control" id="exampleFormControlTextarea1" value="<?php echo $count; ?>" rows="3">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Status</label>
            <select class="form-control" id="exampleFormControlInput1" name="status">
                <option value="sufficient" <?php echo $status=="sufficient"? "selected" : "sufficient"?>>Sufficient</option>
                <option value="deficient"<?php echo $status=="deficient"? "selected" : ""?>>Deficient</option>
                <option value="urgently required" <?php echo $status=="urgently required"? "selected" : ""?>>Urgently required</option>
            </select>    
        </div>
            <button type="submit" name="submit" value="Submit" type="button" class="btn btn-primary btn-cust">Save</button>
    </form>
    <!-- form to add list ends here -->
</body>
</html>

<?php
    //check wheather submit btn clicked or not
    if(isset($_POST['submit'])){
        //echo "Button Clicked";
        //get the updated values from form

        $item_name = $_POST['item_name'];
        $qty = $_POST['quantity'];
        $status = $_POST['status'];
        $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        $db_select2 = mysqli_select_db($conn2, DB_NAME);

        $sql2 = "UPDATE stock SET 
                item_name='$item_name',
                quantity=$qty,
                date_of_update = '".gmdate("Y-m-d")."',
                status='$status'
                WHERE item_id=$item_id
        ";
        $res2 = mysqli_query($conn2, $sql2);
        

        // //to check query execution
        if($res2 == true){
             $_SESSION['update']="List Updated Successfully";
            header("location:".SITEURL.'stock.php');
        }
        else{
            $_SESSION['update_fail']="Failed to List Update";
            header('location'.SITEURL.'update-stock.php?item_id='.$item_id);
        }
    }

?>