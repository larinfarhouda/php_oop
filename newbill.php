<?php
include 'classes.php';
include 'db.php';
//session_start();

$conn = new db();

$sql = "SELECT * FROM `Doctor`";
$stmt = $conn->connect()->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();

$colcount = count($result);

$sql1 = "SELECT * FROM `Patient`";
$stmt1 = $conn->connect()->prepare($sql1);
$stmt1->execute();
$result1 = $stmt1->fetchAll();

$colcount1 = count($result1);


?>

<html lang="en">

<head>
    <title>OOP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
    <div class="container justify-content-center" style="padding-top: 20%;">
        <h1 style="padding-bottom: 35px;">Make a new Bill</h1>
        <form action="printbill.php" method="post">
            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="doc">
                <option>select Doctor</option>
                <?php
                for ($i = 0; $i < $colcount; $i++) {
                    $doc = unserialize($result[$i]['data']);

                ?>
                    <option value="<?php echo $i; ?>"><?php echo $doc->printINFO(); ?></option>
                <?php } ?>
            </select>

            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="pat">
                <option>select Patient</option>
                <?php
                for ($i = 0; $i < $colcount1; $i++) {
                    $pat = unserialize($result1[$i]['data']);

                ?>
                    <option value="<?php echo $i; ?>"><?php echo $pat->printINFO(); ?></option>
                <?php } ?>
            </select>
            <label for="date">date:</label>
            <input type="date" id="date" name="date">
            <button type="submit" name="newbillbtn" class="btn btn-warning ">Submit</button>
        </form>
    </div>
</body>

</html>