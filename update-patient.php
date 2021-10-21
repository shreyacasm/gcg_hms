<?php

    include('config/constants.php');

    if(isset($_GET['p_id'])){
        //get the list id value
        $p_id = $_GET['p_id'];
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

        //sql query to get the values from database
        $sql = "SELECT * FROM patient
                WHERE p_id=$p_id";

        $res = mysqli_query($conn, $sql);
        
        //to check execution of query
        if($res == true){
            //get the value from database
            //value in array format
            $row = mysqli_fetch_assoc($res);
            //print_r($row);

            //create indvidual variable to save the data
            $p_name=$row['p_name'];
            $age=$row['p_age'];
            $address=$row['p_address'];
            $contact=$row['p_contact'];
            $item_id=$row['item_id'];
            
        }
        else{
            //go back to manage list page
            header('location:'.SITEURL.'patient.php');
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
        <li style="float:right"><a class="menu-h1" href="<?php echo SITEURL; ?>patient.php">Go back to Patient List</a></li>
        <li style="float:right"><a class="menu-h1" href="<?php echo SITEURL; ?>">Home</a></li>
    </ul>
    <div class="side-space">
    <h3>Add Patient Details</h3>
    <p  class="neg-para">
        <?php
            if(isset($_SESSION['update_fail'])){
                echo $_SESSION['update_fail'];
                unset($_SESSION['update_fail']);
            }
        ?>
    </p>
    <form method="POST" action="" >
            <label for="exampleFormControlInput1" class="form-label">Patient Name: </label>
            <input type="text" name="p_name" class="form-control mb-3" id="exampleFormControlInput1"  value="<?php echo $p_name; ?>" required>
            <label for="exampleFormControlInput1" class="form-label">Age(in yrs): </label>
            <input type="text" name="p_age" class="form-control mb-3" id="exampleFormControlInput1"  value="<?php echo $age; ?>" required>
            <label for="exampleFormControlTextarea1" class="form-label">Address:</label>
            <textarea name="p_address" class="form-control" id="exampleFormControlInput1"  required><?php echo $address;?></textarea>
            <label for="exampleFormControlInput1" class="form-label">Contact No: </label>
            <input type="text" name="p_contact" class="form-control mb-3" id="exampleFormControlInput1"  value="<?php echo $contact; ?>" required>
            
            <label for="exampleFormControlTextarea1" class="form-label">Select Requirement (Most Urgent):</label>
            <select class="form-control" id="exampleFormControlInput1"  name="item_id">
            <option value="0" selected>None</option>
                        <?php
                            //connect db
                            $conn3 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
                            //select db
                            $db_select3 = mysqli_select_db($conn3, DB_NAME) or die(mysqli_error());
                            //query
                            $sql3 = "SELECT * FROM stock";

                            $res3 = mysqli_query($conn3, $sql3);

                            if($res3==true){
                                //count res rows
                                $count_rows=mysqli_num_rows($res3);
                                //if any data is there in DB display all in dropdown
                                if($count_rows>0){
                                    //display all lists on dropdown from database
                                    while($row3=mysqli_fetch_assoc($res3)){
                                        $fitem_id = $row3['item_id'];
                                        $item_name = $row3['item_name'];
                                        ?>
                                        <option value="<?php echo $fitem_id ?>" <?php echo $fitem_id==$item_id?"selected":""?> ><?php echo $item_name ?></option>
                                        <?php
                                        
                                    }
                                }
                                else{
                                    ?>
                                    <option value="0">None</option>
                                    <?php
                                }
                            }
                        ?>
                    </select>
                <button type="submit" name="submit" value="Save" type="button" class="btn btn-primary btn-cust">Save</button>
            
        
    </form>
    </div>
</body>
</html> 
<?php
    //check wheather submit btn clicked or not
    if(isset($_POST['submit'])){
        //echo "Button Clicked";
        //get the updated values from form

        $p_name=$_POST['p_name'];
        $age=$_POST['p_age'];
        $address=$_POST['p_address'];
        $contact=$_POST['p_contact'];
        $item_id=$_POST['item_id'];

        $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        $db_select2 = mysqli_select_db($conn2, DB_NAME);

        echo $sql2 = "UPDATE patient SET 
                p_name='$p_name',
                p_age=$age,
                p_address='$address',
                p_contact=$contact,
                item_id=$item_id
                WHERE p_id=$p_id
        ";
        $res2 = mysqli_query($conn2, $sql2);
        

        //to check query execution
        if($res2 == true){
             $_SESSION['update']="Patient Details Updated Successfully";
            header("location:".SITEURL.'patient.php');
        }
        else{
            $_SESSION['update_fail']="Failed to Patient Details Update";
            header('location'.SITEURL.'update-patient.php?p_id='.$p_id);
        }
    }

?>