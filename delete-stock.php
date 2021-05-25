<?php
    include('config/constants.php');

    // to check value of task_id is passed or not
    if(isset($_GET['item_id'])){
        //if true thn only we'll proceed further

        // get the task_id
        $item_id = $_GET['item_id'];

        //connect the database
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
        //select db
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
        //query to dekete list
        $sql = "DELETE FROM stock WHERE item_id=$item_id";
        //execute the query
        $res = mysqli_query($conn, $sql);

        //to check if delete executed well or not
        if($res == true){
            //echo "list is deleted successfully";
            $_SESSION['delete']="Stock Deleted Successfully";
            header('location:'.SITEURL.'stock.php');
        }
        else{
            //echo "list delete failed";
            $_SESSION['delete_fail']="Stock Deletion Failed";
            header('location:'.SITEURL.'stock.php');
        }

    }
    else{
        //redirect 
        header('location:'.SITEURL);
    }

    
?>