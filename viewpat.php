<?php
include 'classes.php';
include 'db.php';

$conn = new db();

$sql = "SELECT * FROM `Patient`";
$stmt = $conn->connect()->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();

$colcount = $colcountt = count($result);

?>
<html>

<body>
    <div class="container justify-content-center" style="padding-top: 20%; margin-left:40%;">
        <?php
        for ($i = 0; $i < $colcount; $i++) {
            $pat = unserialize($result[$i]['data']);

        ?>
            <p> <?php $pat->printINFo(); ?></p>
        <?php } ?>
    </div>
</body>

</html>