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
</head>
<body>
    <div class="menu">
        <h1>GO CORONA GO</h1>
        <a href="index.php">Home</a>
    </div>
    <a href="add-stock.php">Add New Stock</a>
    <div class="all-lists">
            <table class="table table-info cust-table">
                <thead>
                    <tr class="table-dark cust-dark">
                        <th scope="col">S No.</th>
                        <th scope="col">Item Name</th>
                        <th scope="col">Total No. of Items</th>
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
                                $item_name=$row['item_name'];
                                $count=$row['count'];
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
                                        <a href="<?php echo SITEURL; ?>update-list.php?list_id=<?php echo $list_id ?>"><i class="fas fa-edit"></i></a>
                                        <a href="<?php echo SITEURL; ?>delete-list.php?list_id=<?php echo $list_id ?>"><i class="fas fa-trash-alt"></i></a>
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
        
</body>
</html>