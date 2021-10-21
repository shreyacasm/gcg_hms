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
    <h3>Add Report</h3>
    <p  class="neg-para">
        <?php
            if(isset($_SESSION['r_add_fail'])){
                echo $_SESSION['r_add_fail'];
                unset($_SESSION['r_add_fail']);
            }
        ?>
    </p>
    <form method="POST" action="" >

        <label for="exampleFormControlTextarea1" class="form-label">Result :</label>
        <select class="form-select mb-3" name="result" placeholder="---Select an option---" required>
            <option value="0" disabled selected>---Select Option---</option>
            <option value="positive">Positive</option>
            <option value="negative">Negative</option>
        </select>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Remarks :</label>
            <textarea type="text" name="remarks" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>    
        <button type="submit" name="submit" value="Save" type="button" class="btn btn-primary btn-cust">Save</button>
        
    </form>
    </div>
</body>
</html>
<?php

    // check wheather the form is submitted or not
    if(isset($_POST['submit'])){
        // to get the value from the table 

        $result= $_POST['result'];
        $remarks=$_POST['remarks'];
        if(isset($_GET['p_id'])){
            //get the p_id value
            $p_id_url = $_GET['p_id'];
        }
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
        echo $sql = "INSERT INTO report SET
            result = '$result' ,
            remarks = '$remarks',
            date_of_report = '".gmdate("Y-m-d")."',
            p_id = $p_id_url
        ";

        //execute query and insert into database

        $res = mysqli_query($conn, $sql);

        $sql2 = "UPDATE patient SET
            report_status='Generated'
            WHERE p_id = $p_id_url
        ";
        $res2 = mysqli_query($conn, $sql2);

        if($res == true){
            
            //echo "Query executed and data inserted into database";

            // create a session to display message
            $_SESSION['r_add'] = "Report added successfully";

            //redirect to manage list page

           header('location:'.SITEURL.'patient.php');
            
            
        }
        else{
           //echo "Query failed";

            $_SESSION['r_add_fail'] ="Report adding, failed";

            header('location:'.SITEURL.'add-report.php');
        }

    }

?>