<?php
    include('config/constants.php');
?>

<html>
<head>
    <title>Go corona go</title>
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
        <h3 style="text-align:center">Add New Patient</h3>
        <p class="neg-para">
            <?php
                if(isset($_SESSION['add_fail'])){
                    echo $_SESSION['add_fail'];
                    unset($_SESSION['add_fail']);
                }
            ?>
        </p>
        <form method="POST" action="" >
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Patient Name: </label>
                <input type="text" name="p_name"  class="form-control" id="exampleFormControlInput1" placeholder="Full Name" required="required" >
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Age: </label>
                <input type="text" name="p_age"  class="form-control" id="exampleFormControlInput1" placeholder="Age(in yrs)" required="required" >
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Address</label>
                <textarea type="text" name="p_address" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Contact: </label>
                <input type="text" name="p_contact"  class="form-control" id="exampleFormControlInput1" required="required" >
            </div>
                
                <label for="exampleFormControlTextarea1" class="form-label">Select Requirement (Most Urgent):</label>
                        <select class="form-select mb-3"  name="item_id">
                        <option value="0">None</option>
                                            
                            <?php
                                //connect db
                                $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
                                //select db
                                $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
                                //query
                                $sql = "SELECT * FROM stock";

                                $res = mysqli_query($conn, $sql);

                                if($res==true){
                                    //count res rows
                                    $count_rows=mysqli_num_rows($res);
                                    //if any data is there in DB display all in dropdown
                                    if($count_rows>0){
                                        //display all lists on dropdown from database
                                        while($row=mysqli_fetch_assoc($res)){
                                            $item_id = $row['item_id'];
                                            $item_name = $row['item_name'];
                                            ?>
                                            <option value="<?php echo $item_id ?>"><?php echo $item_name; ?></option>
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
    //wheather save button is clicked or not
    if(isset($_POST['submit'])){
        //echo "Button Clicked";
        //get all the values from the form $p_id=$row['p_id'];
        $p_name=$_POST['p_name'];
        $age=$_POST['p_age'];
        $address=$_POST['p_address'];
        $contact=$_POST['p_contact'];
        $item_id=$_POST['item_id'];

        $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

        $db_select2 =mysqli_select_db($conn2, DB_NAME) or die(mysqli_error());

        echo $sql2="INSERT INTO patient set
            p_name='$p_name',
            p_age=$age,
            p_address='$address',
            p_contact=$contact,
            item_id=$item_id,
            report_status='Pending'
        ";
        $res2 = mysqli_query($conn2, $sql2);

        if($res2==true){
            $_SESSION['add'] = "Record Added Successfully.";
            header('location:'.SITEURL.'patient.php');
        }
        else{
            $_SESSION['add_fail'] = "Failed to Add task";
            header('location:'.SITEURL.'add-patient.php');
        }
    }

?>