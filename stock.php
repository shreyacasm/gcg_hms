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
    <ul>
        <li><h1 class="menu-h1">GO CORONA GO</h1></li>
        <li style="float:right"><a class="menu-h1" href="<?php echo SITEURL; ?>add-stock.php">Add New Stock</a></li>
        <li style="float:right"><a class="menu-h1" href="<?php echo SITEURL; ?>">Home</a></li>
    </ul>
    
    <p class="pos-para">
        <?php
            // check if the session created or not
            if(isset($_SESSION['add'])){

                //display session message
                echo $_SESSION['add'];
                //remove the message after displaying once
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
        ?>
    </p>
    <p class="neg-para">
    <?php
        if(isset($_SESSION['delete_fail'])){
            echo $_SESSION['delete_fail'];
            unset($_SESSION['delete_fail']);
        }
    ?>
    </p>
    <div class="side-space">
    <h1 style="text-align:center">Stock Details</h1>
    <div class="all-lists">
            <table class="table table-info cust-table">
                <thead>
                    <tr class="table-dark cust-dark">
                        <th scope="col">S No.</th>
                        <th scope="col">Item Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Date Of Update</th>
                        <th scope="col">Status</th>                        
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <?php
                    //connect the database

                    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
                    //select dataBASE
                    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

                    //SQL query to display all list
                    $sql = "SELECT * FROM stock";

                    $res = mysqli_query($conn, $sql);

                    //check wheather query executed or not
                    if($res == true){
                        //echo "Query working";

                        //count the number of data in db 
                        $count_row = mysqli_num_rows($res);
                        $sn = 1;
                        if($count_row > 0){
                            //there data will be displayed

                            while($row=mysqli_fetch_assoc($res)){
                            //data is present as an array
                            
                                //getting data from database
                                $item_id=$row['item_id'];
                                $item_name=$row['item_name'];
                                $count=$row['quantity'];
                                $date_up=$row['date_of_update'];
                                $status=$row['status'];
                                
                                
                                ?>
                                <tr class="cust-light">
                                    <td> <?php echo $sn++; ?>. </td>
                                    <td> <?php echo "$item_name"; ?> </td>
                                    <td> <?php echo "$count"; ?> </td>
                                    <td> <?php echo "$date_up"; ?> </td>
                                    <td> <?php echo "$status"; ?> </td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>update-stock.php?item_id=<?php echo $item_id; ?>"><i class="fas fa-edit"></i></a>
                                        <a href="<?php echo SITEURL; ?>delete-stock.php?item_id=<?php echo $item_id; ?>"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>

                                <?php
                            }

                        }
                        else{
                             ?>
                                <tr>
                                    <td>NO List to display, Add List Now</td>
                                </tr>

                            <?php   
                        }
                    }

                ?>
            </table>

        </div>
        

    </div>
    </body>
</html>