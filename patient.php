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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo SITEURL;?>css/style.css">
        
</head>
<body>
    <div class="menu">
        <h1>GO CORONA GO</h1>
        <a href="<?php echo SITEURL; ?>">Home</a>
    </div>
    <a href="<?php echo SITEURL; ?>add-patient.php">Add New Patient</a>

    <p class="pos-para">
        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>
    </p>
    <!-- Task Starts here  -->
    <div class="all-task">
            <p></p>
            <table class="table table-info cust-table">
                <thead>
                <tr class="table-dark cust-dark">
                    <th scope="col">S. No.</th>
                    <th scope="col">Patient Name</th>
                    <th scope="col">Age</th>
                    <th scope="col">Address</th>
                    <th scope="col">Contact No.</th>
                    <th scope="col">Urgently Requires</th>
                    <th scope="col">Report</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <?php
                    $conn=mysqli_connect(LOCALHOST, DB_USERNAME,DB_PASSWORD) or die(mysqli_error());
                    $db_select=mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

                    $sql="SELECT * FROM patient";
                    
                    $res=mysqli_query($conn,$sql);
                    
                    if($res==true){
                        //display the tasks from the database
                        $count_rows = mysqli_num_rows($res);
                        $sn = 1;    
                        if($count_rows>0){
                            //data is there in db
                            while($row=mysqli_fetch_assoc($res)){
                                $p_id=$row['p_id'];
                                $p_name=$row['p_name'];
                                $age=$row['p_age'];
                                $address=$row['p_address'];
                                $contact=$row['p_contact'];
                                $item_id=$row['item_id'];
                                $report_id=$row['report_id'];
                                if($item_id>0){
                                    $sql2="SELECT * FROM stock WHERE item_id=$item_id";
                                    $res2=mysqli_query($conn, $sql2);
                                    $row2 = mysqli_fetch_assoc($res2);
                                    $item_name=$row2['item_name'];
                                }
                                else{
                                    $item_name='None';
                                }
                                
                            ?>
                            <tr class="cust-light">
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $p_name; ?></td>
                                <td><?php echo $age; ?></td>
                                <td><?php echo $address; ?></td>
                                <td><?php echo $contact; ?></td>
                                <td><?php echo $item_name; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>report.php?task_id=<?php echo $report_id; ?>"><i class="fas fa-edit">Go to Report</i></a>
                                </td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>update-patient.php?p_id=<?php echo $p_id; ?>"><i class="fas fa-edit"></i></a>
                                    <a href="<?php echo SITEURL; ?>delete-patient.php?p_id=<?php echo $p_id; ?>"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>

                            <?php
                            }
                        }
                        else{
                            //no tb
                            ?>
                            <tr>
                                <td scope="row" colspan="5">No Task Added Yet</td>
                            </tr>
                            <?php
                        }
                    }
                ?>
            </table>

        </div>
        <!-- Task Starts here  -->
</body>
</html>
