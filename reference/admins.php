<?php
    include_once(__DIR__ . '/../app/start_connect.php');
    
    $sql = "SELECT username, aid FROM Admins ORDER BY aid";
    $result = $conn->query($sql);
    if (!$result) {
        echo mysqli_error($conn);
        mysqli_close($conn);
        include_once(__DIR__ . '/../app/end.php');
        exit();
    }

    if ($result->num_rows > 0) { 
?>
    <h2>Admins</h2>
    <table>
        <thead>
            <tr style='text-align: center;'>
                <th>id</th>
                <th>username</th>
            </tr>
        </thead>
        <tbody>
        <?php
            while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td><?=$row['aid']?></td>
                <td><?=$row['username']?></td>
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
