<?php

    include_once(__DIR__ . '/../app/start_connect.php');

    $sql = "SELECT D.name, D.price FROM Drug D ORDER BY D.did";
    $result = $conn->query($sql);
    if (!$result) {
        echo mysqli_error($conn);
        mysqli_close($conn);
        include_once(__DIR__ . '/../app/end.php');
        exit();
    }

    if ($result->num_rows > 0) { 
?>
    <h2>Drugs</h2>
    <table>
        <thead>
            <tr style='text-align: center;'>
                <th>Name</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
        <?php
            while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td><?=$row['name']?> cents</td>
                <td><?=$row['price']?> cents</td>
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
