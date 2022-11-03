<?php
    $conn = require(__DIR__ . '/../app/start_connect.php');

    $sql = "
        SELECT
            U.firstname, U.lastname, P.name
        FROM Users U, Couriers C, Pharmacies P, Rcourpharm R
        WHERE U.uid = C.uid AND C.courid = R.courid AND R.pharmid = P.pharmid
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
    <h2>Couriers-pharmacies relationship (Couriers -> Pharmacies)</h2>
    <table>
        <thead>
            <tr style='text-align: center;'>
                <th>Couriers</th>
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