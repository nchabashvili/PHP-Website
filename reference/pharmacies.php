<?php
    include_once(__DIR__ . '/../app/start.php');
        
    $conn = require(__DIR__ . '/../app/connect.php');
    if ($conn === false) {
        echo '<p class="error">Error connecting to the SQL Database!</p>';
        include_once(__DIR__ . '/../app/end.php');
        exit();
    }
    $sql = "SELECT P.pid, P.name, p.address FROM Pharmacy P ";

    $result = $conn->query($sql);
    if (!$result) {
        echo mysqli_error($conn);
        mysqli_close($conn);
        include_once(__DIR__ . '/../app/end.php');
        exit();
    }

    if ($result->num_rows > 0) { 
?>
    <h2>Pharmacies</h2>
    <table>
        <thead>
            <tr style='text-align: center;'>
                <th>Name</th>
                <th>Address</th>
                <th>Pharmacy ID</th>
            </tr>
        </thead>
        <tbody>
        <?php
            while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td><?=$row['name']?></td>
                <td><?=$row['address']?></td>
                <td><?=$row['pid']?></td>
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
