<?php

include 'classes.php';
include 'db.php';
if (isset($_POST['newdocbtn'])) {

    $name = $_POST['name'];
    $age = $_POST['age'];
    $ssn = $_POST['ssn'];


    $pat = new Patient($name, $age, $ssn);

    //Serialize the object into a string value that we can store in our database.
    $serializedObject = serialize($pat);
    $conn = new DB();
    //Prepare our INSERT SQL statement.
    $stmt = $conn->connect()->prepare("INSERT INTO Patient (data) VALUES (?)");

    //Execute the statement and insert our serialized object string.
    $stmt->execute(array(
        $serializedObject
    ));
}

?>
<html lang="en">

<head>
    <title>OOP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
    <h1 style="padding-top: 10%; padding-left: 35%;">Add a new Patient</h1>
    <div class="container justify-content-center" style="padding-top: 3%;">
        <form action="" method="post">
            <div class="form-group">
                <label for="formGroupExampleInput">Name</label>
                <input type="text" name="name" class="form-control" id="formGroupExampleInput" aria-describedby="emailHelp" placeholder="Enter Name">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">Age</label>
                <input type="text" name="age" class="form-control" id="formGroupExampleInput" placeholder="Enter age">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">SSN</label>
                <input type="text" name="ssn" class="form-control" id="formGroupExampleInput" placeholder="SSN">
            </div>
            <button type="submit" name="newdocbtn" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>