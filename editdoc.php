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


if (isset($_POST['editbtn'])) {

    $docindex = $_POST['doc'];
    $at = $_POST['at'];
    $data = $_POST['data'];

    $conn = new db();

    $sql = "SELECT * FROM `Doctor`";
    $stmt = $conn->connect()->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();


    $olddoc = $result[$docindex]['data'];
    $delsql = "DELETE FROM `doctor` WHERE data = '$olddoc'";
    $stmt1 = $conn->connect()->prepare($delsql);
    $stmt1->execute();



    $doc = unserialize($result[$docindex]['data']);

    if ($at == "name") {
        $doc->setName($data);
    } elseif ($at == "age") {
        $doc->setAge($data);
    } elseif ($at == "officefee") {
        $doc->setofficefee($data);
    } elseif ($at == "specialty") {
        $doc->setspecialty($data);
    }


    //Serialize the object into a string value that we can store in our database.
    $serializedObject = serialize($doc);
    //Prepare our INSERT SQL statement.
    $stmt = $conn->connect()->prepare("INSERT INTO Doctor (data) VALUES (?)");
    //Execute the statement and insert our serialized object string.
    $stmt->execute(array(
        $serializedObject
    ));
}

if (isset($_POST['delbtn'])) {
    $docindex = $_POST['doc'];

    $sql = "SELECT * FROM `Doctor`";
    $stmt = $conn->connect()->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();

    $deldoc = $result[$docindex]['data'];

    $delsql = "DELETE FROM `doctor` WHERE data = '$deldoc'";
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
        <h1 style="padding-bottom: 35px;">choose a doctor to edit or delete</h1>
        <form action="" method="post">
            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="doc">
                <option>select Doctor</option>
                <?php
                for ($i = 0; $i < $colcount; $i++) {
                    $doc = unserialize($result[$i]['data']);

                ?>
                    <option value="<?php echo $i; ?>"><?php echo $doc->printINFO(); ?></option>
                <?php } ?>
            </select>
            <button type="submit" name="delbtn" class="btn btn-warning ">delete</button> <strong>OR</strong>
            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="at">
                <option>select what to edit</option>

                <option value="name">name</option>
                <option value="age">age</option>
                <option value="officefee">office fee</option>
                <option value="specialty">specialty</option>

            </select>
            <label for="data">new data:</label>
            <input type="text" id="data" name="data">
            <button type="submit" name="editbtn" class="btn btn-warning ">Submit</button>
        </form>
    </div>
</body>

</html>