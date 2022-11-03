<?php
    $conn = require(__DIR__ . '/../app/start_connect.php');

    $sql = "
        SELECT
            U.firstname, U.lastname, P.name
        FROM Users U, Customers C, Pharmacies P, Rcourpharm R
        WHERE U.uid = C.uid AND C.custid = R.custid AND R.pharmid = P.pharmid
        ORDER BY U.uid
    ";
    $result = $conn->query($sql);
    if (!$result) {
        echo mysqli_error($conn);
        mysqli_close($conn);
        include_once(__DIR__ . '/../app/end.php');
        exit();
    }

    if ($result->num_rows > 0) { 
?>
    <h2>Customers-Pharmacies relationship (Customers -> Pharmacies)</h2>
    <table>
        <thead>
            <tr style='text-align: center;'>
                <th>Customers</th>
                <th>Pharmacies</th>
            </tr>
        </thead>
        <tbody>
        <?php
            while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td><?=$row['firstname']?> <?=$row['lastname']?></td>
                <td><?=$row['name']?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php
    } else {
?>
    <h2>No Entries</h2>
<?php
    }

    mysqli_close($conn);
    include_once(__DIR__ . '/../app/end.php');
?>