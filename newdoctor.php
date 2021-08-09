<?php

include 'classes.php';
include 'db.php';


if (isset($_POST['newdocbtn'])) {

    $name = $_POST['name'];
    $age = $_POST['age'];
    $officefee = $_POST['officefee'];
    $specialty = $_POST['specialty'];

    $doctor = new Doctor($name, $age, $officefee, $specialty);

    //Serialize the object into a string value that we can store in our database.
    $serializedObject = serialize($doctor);
    $conn = new DB();
    //Prepare our INSERT SQL statement.
    $stmt = $conn->connect()->prepare("INSERT INTO Doctor (data) VALUES (?)");

    //Execute the statement and insert our serialized object string.
    $stmt->execute(array(
        $serializedObject
    ));
}

if (isset($_GET['error'])) {
    if ($_GET['error'] == "invalidspecialty") {
        echo '<p class = "errormsg"> invalid specialty </p>';
    }
} else if (isset($_GET['signin']) == "invalidofficeFee") {
    echo '<script>alert("invalid office Fee")</script>';
}

?>



<html lang="en">

<head>
    <title>OOP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
    <h1 style="padding-top: 10%; padding-left: 35%;">Add a new Doctor</h1>
    <div class="container justify-content-center" style="padding-top: 2%;">
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
                <label for="formGroupExampleInput">Office Fee</label>
                <input type="text" name="officefee" class="form-control" id="formGroupExampleInput" placeholder="Office Fee">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">Specialty</label>
                <input type="text" name="specialty" class="form-control" id="formGroupExampleInput" placeholder="Enter Specialty">
            </div>
            <button type="submit" name="newdocbtn" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>