<?php

$conn = require(__DIR__ . '/../app/start_connect.php');

$fields = [
    'name',
    'address'
];

foreach ($fields as $field) {
    // If the user provided a value for this field
    if (isset($_GET[$field]) && strlen($_GET[$field]) > 0) {
        $value = mysqli_real_escape_string($conn, $_GET[$field]);
        $where .= " AND $field LIKE '%{$value}%'";
    }
}

$sql = "
    SELECT P.pid, P.name, P.address
    FROM Pharmacy P
";

$result = $conn->query($sql);
if (!$result) {
    echo mysqli_error($conn);
    mysqli_close($conn);
    include_once(__DIR__ . '/../app/end.php');
    exit();
}

?>
    <h2>Search for Pharmacies</h2>
    <h3>
        Filter
    </h3>
    <form method='GET' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" />
        <br/>

       
        <label for="address">Address:</label>
        <input type="address" name="address" id="address" />
        <br/>
        
        
        <br/>
        <br/>

        <button type="submit">
            Filter
        </button>
    </form>
    <br />
    <br />
    <?php
        if ($result->num_rows > 0) { 
    ?>
    <table>
        <thead>
            <tr style='text-align: center;'>
                <th>Name</th>
                <th>address</th>
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