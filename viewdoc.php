<?php
include 'classes.php';
include 'db.php';

$conn = new db();

$sql = "SELECT * FROM `Doctor`";
$stmt = $conn->connect()->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();

$colcountt = count($result);

?>
<html>

<body>
    <div class="container justify-content-center" style="padding-top: 20%; margin-left:40%;">
        <?php
        for ($i = 0; $i < $colcountt; $i++) {
            $doc = unserialize($result[$i]['data']);

        ?>
            <p> <?php $doc->printINFo(); ?></p>
        <?php } ?>
    </div>
</body>

</html>