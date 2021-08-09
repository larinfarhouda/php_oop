<?php
if (isset($_GET['error'])) {
    if ($_GET['error'] == "invalidname") {
        echo '<p class = "errormsg"> invalid name </p>';
    } else if ($_GET['error'] == "invalidage") {
        echo '<p class = "errormsg"> invalid age</p>';
    }
}
?>


<html lang="en">

<head>
    <title>OOP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
    <h1 style="padding-top: 10%; padding-left: 35%;">Hospital Billing System</h1>
    <div class="container justify-content-center" style="padding-top: 10%;">
        <form action="" method="post">
            <a href="docop.php"><button type="button" class="btn btn-primary btn-lg btn-block"> Doctor</button></a>
            <a href="patop.php"><button type="button" class="btn btn-secondary btn-lg btn-block">patient</button></a>
            <a href="newbill.php"><button type="button" class="btn btn-warning btn-lg btn-block">Make a new Bill</button></a>
        </form>
    </div>
</body>

</html>