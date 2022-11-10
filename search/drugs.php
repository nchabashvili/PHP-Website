<?php

include_once(__DIR__ . '/../app/start_connect.php');

$fields = [
    'name',
    'price'
];

foreach ($fields as $field) {
    // If the user provided a value for this field
    if (isset($_GET[$field]) && strlen($_GET[$field]) > 0) {
        $value = mysqli_real_escape_string($conn, $_GET[$field]);
        $where .= " AND $field LIKE '%{$value}%'";
    }
}

$sql = "
    SELECT D.did, D.name, D.price
    FROM Drug D
";

$result = $conn->query($sql);
if (!$result) {
    echo mysqli_error($conn);
    mysqli_close($conn);
    include_once(__DIR__ . '/../app/end.php');
    exit();
}

?>
    <h2>Search for Drugs</h2>
    <h3>
        Filter
    </h3>
    <form method='GET' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" />
        <br/>

       
        <label for="price">Price:</label>
        <input type="price" name="price" id="price" />
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
                <th>price</th>
                <th>Pharmacy ID</th>
            </tr>
        </thead>
        <tbody>
        <?php
            while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td><?=$row['name']?></td>
                <td><?=$row['price']?> cents</td>
                <td><?=$row['did']?></td>
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