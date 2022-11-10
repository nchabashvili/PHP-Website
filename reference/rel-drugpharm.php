<?php
    include_once(__DIR__ . '/../app/start_connect.php');
    $sql = "
        SELECT
            D.name, D.price, P.name
        FROM Drug D, Pharmacy P, HasInStock H
        WHERE D.did = H.pid AND H.pid = P.pid
        ORDER BY D.did
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
    <h2>drug-pharmacy relationship (Drugs -> Pharmacies)</h2>
    <table>
        <thead>
            <tr style='text-align: center;'>
                <th>Drugs</th>
                <th>Pharmacies</th>
            </tr>
        </thead>
        <tbody>
        <?php
            while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td><?=$row['name']?> <?=$row['price']?></td>
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