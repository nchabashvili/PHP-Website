<?php
    $conn = require(__DIR__ . '/../app/start_connect.php');

    $sql = "SELECT U.firstname, U.lastname, U.email FROM Users U, Courier C WHERE U.uid = C.uid ORDER BY U.uid";
    $result = $conn->query($sql);
    if (!$result) {
        echo mysqli_error($conn);
        mysqli_close($conn);
        include_once(__DIR__ . '/../app/end.php');
        exit();
    }

    if ($result->num_rows > 0) { 
?>
    <h2>Couriers</h2>
    <table>
        <thead>
            <tr style='text-align: center;'>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
        <?php
            while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td><?=$row['firstname']?></td>
                <td><?=$row['lastname']?></td>
                <td><?=$row['email']?></td>
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