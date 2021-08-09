<?php
include 'classes.php';
include 'db.php';

if (isset($_POST['newbillbtn'])) {

    $docindex = $_POST['doc'];
    $patindex = $_POST['pat'];
    $date = $_POST['date'];


    $conn = new db();

    $sql = "SELECT * FROM `Doctor`";
    $stmt = $conn->connect()->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();

    $doc = unserialize($result[$docindex]['data']);


    $sql1 = "SELECT * FROM `Patient`";
    $stmt1 = $conn->connect()->prepare($sql1);
    $stmt1->execute();
    $result1 = $stmt1->fetchAll();

    $pat = unserialize($result1[$patindex]['data']);

    $bill = new Billing($doc, $pat, $date);
    // echo $bill->billINFO();
}
?>

<html>

<head>
    <title>Simple invoice in PHP</title>
    <style type="text/css">
        body {
            font-family: Verdana;
        }

        div.invoice {
            border: 1px solid #ccc;
            padding: 10px;
            height: 740pt;
            width: 570pt;
        }

        div.company-address {
            border: 1px solid #ccc;
            float: left;
            width: 200pt;
        }

        div.invoice-details {
            border: 1px solid #ccc;
            float: right;
            width: 200pt;
        }

        div.customer-address {
            border: 1px solid #ccc;
            float: right;
            margin-bottom: 50px;
            margin-top: 100px;
            width: 200pt;
        }

        div.clear-fix {
            clear: both;
            float: none;
        }

        table {
            width: 100%;
        }

        th {
            text-align: left;
        }

        .text-left {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="invoice">
        <div class="company-address">
            Hospital X
            <br />
            489 Road Street
            <br />
            London, AF3Z 7BP
            <br />
        </div>

        <div class="invoice-details">
            Invoice N°: 564
            <br />
            <?php echo $date; ?>
        </div>

        <div class="customer-address">
            <strong>Patient :</strong>
            <br />
            Mr. <?php echo $pat->getName(); ?>
            <br />
            Age: <?php echo $pat->getAge(); ?>
            <br />
            Ssn: <?php echo $pat->getSsn(); ?>
            <br />
        </div>

        <div class="clear-fix"></div>
        <table border='1' cellspacing='0'>
            <tr>
                <th width=250>Doctor name</th>
                <th width=15-0>specialty</th>
                <th width=100>office fee</th>
                <th width=100>Total price</th>
            </tr>

            <?php
            $total = $bill->getBillingAmount();
            $vat = $total * 0.15;

            $docname = "DR." . $doc->getName();
            $specialty = $doc->getspecialty();
            $officefee = $doc->getofficefee();
            $total_price = number_format($total + $vat, 2);

            echo ("<tr>");
            echo ("<td>$docname</td>");
            echo ("<td class='text-center'>$specialty</td>");
            echo ("<td class='text-right'>€$officefee</td>");
            echo ("<td class='text-right'>€$total_price</td>");
            echo ("</tr>");


            echo ("<tr>");
            echo ("<td colspan='3' class='text-right'>Sub total</td>");
            echo ("<td class='text-right'>€" . number_format($total, 2) . "</td>");
            echo ("</tr>");
            echo ("<tr>");
            echo ("<td colspan='3' class='text-right'>VAT</td>");
            echo ("<td class='text-right'>€" . number_format($vat, 2) . "</td>");
            echo ("</tr>");
            echo ("<tr>");
            echo ("<td colspan='3' class='text-right'><b>TOTAL</b></td>");
            echo ("<td class='text-right'><b>€" . number_format($total_price, 2) . "</b></td>");
            echo ("</tr>");
            ?>
        </table>
        <button type="submit" style="margin-top: 20%; margin-left: 40%; padding: 10px">print</button>
    </div>
</body>

</html>