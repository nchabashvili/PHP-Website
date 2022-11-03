<?php
    $conn = require(__DIR__ . '/../app/start_connect.php');

    $sql = "SELECT firstname, lastname, email FROM Users ORDER BY uid";
    $result = $conn->query($sql);
    if (!$result) {
        echo mysqli_error($conn);
        mysqli_close($conn);
        include_once(__DIR__ . '/../app/end.php');
        exit();
    }

    if ($result->num_rows > 0) { 
?>
    <h2>Users</h2>
    <table>
        <thead>
            <tr style='text-align: center;'>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
        <?php
            while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td><?=$row['firstname']?> <?=$row['lastname']?></td>
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
