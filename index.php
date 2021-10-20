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
    <div class="add-bg">    
        <div>
            <h1 class="h-main">GO CORONA GO</h1>
        </div>
        <div class="h-main wel-para">
            <h2>Welcome to Go Corona Go Hospital Management System</h2>
            <div class="view-sec">
                <a href="patient.php">View Patients</a>
            </div>
            <div class="view-sec">
                <a href="stock.php">View Stock</a>
            </div>
        </div>
    </div>

</body>
</html>