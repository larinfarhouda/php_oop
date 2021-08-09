<?php
include 'classes.php';
include 'db.php';

$conn = new db();
$sql = "SELECT * FROM `Patient`";
$stmt = $conn->connect()->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();

$colcount = count($result);


if (isset($_POST['editbtn'])) {

    $Patindex = $_POST['Pat'];
    $at = $_POST['at'];
    $data = $_POST['data'];

    $conn = new db();

    $sql = "SELECT * FROM `Patient`";
    $stmt = $conn->connect()->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();


    $oldPat = $result[$Patindex]['data'];
    $delsql = "DELETE FROM `Patient` WHERE data = '$oldPat'";
    $stmt1 = $conn->connect()->prepare($delsql);
    $stmt1->execute();



    $Pat = unserialize($result[$Patindex]['data']);

    if ($at == "name") {
        $Pat->setName($data);
    } elseif ($at == "age") {
        $Pat->setAge($data);
    } elseif ($at == "ssn") {
        $Pat->setssn($data);
    }



    //Serialize the object into a string value that we can store in our database.
    $serializedObject = serialize($Pat);
    //Prepare our INSERT SQL statement.
    $stmt = $conn->connect()->prepare("INSERT INTO Patient (data) VALUES (?)");
    //Execute the statement and insert our serialized object string.
    $stmt->execute(array(
        $serializedObject
    ));
}

if (isset($_POST['delbtn'])) {
    $Patindex = $_POST['Pat'];

    $sql = "SELECT * FROM `Patient`";
    $stmt = $conn->connect()->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();

    $delPat = $result[$Patindex]['data'];

    $delsql = "DELETE FROM `Patient` WHERE data = '$delPat'";
    $stmt1 = $conn->connect()->prepare($delsql);
    $stmt1->execute();
}

?>

<html lang="en">

<head>
    <title>OOP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
    <div class="container justify-content-center" style="padding-top: 20%;">
        <h1 style="padding-bottom: 35px;">choose a Patient to edit or delete</h1>
        <form action="" method="post">
            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="Pat">
                <option>select Patient</option>
                <?php
                for ($i = 0; $i < $colcount; $i++) {
                    $Pat = unserialize($result[$i]['data']);

                ?>
                    <option value="<?php echo $i; ?>"><?php echo $Pat->printINFO(); ?></option>
                <?php } ?>
            </select>
            <button type="submit" name="delbtn" class="btn btn-warning ">delete</button> <strong>OR</strong>
            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="at">
                <option>select what to edit</option>

                <option value="name">name</option>
                <option value="age">age</option>
                <option value="ssn">ssn</option>


            </select>
            <label for="data">new data:</label>
            <input type="text" id="data" name="data">
            <button type="submit" name="editbtn" class="btn btn-warning ">Submit</button>
        </form>
    </div>
</body>

</html>