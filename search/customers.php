<?php

include_once(__DIR__ . '/../app/start.php');
    
    $conn = require(__DIR__ . '/../app/connect-readonly.php');
    if ($conn === false) {
        echo '<p class="error">Error connecting to the SQL Database!</p>';
        include_once(__DIR__ . '/../app/end.php');
        exit();
    }
    
$where = "U.uid = C.uid";
$fields = [
    'firstname',
    'lastname',
    'email',
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
    SELECT C.cid, U.firstname, U.lastname, U.email, C.address
    FROM Users U, Customer C
    WHERE $where
    ORDER BY U.uid
";

$result = $conn->query($sql);
if (!$result) {
    echo mysqli_error($conn);
    mysqli_close($conn);
    include_once(__DIR__ . '/../app/end.php');
    exit();
}

?>
    <h2>Search for Customers</h2>
    <h3>
        Filter
    </h3>
    <form method='GET' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="firstname">Firstname:</label>
        <input type="text" name="firstname" id="firstname" />
        <br/>

        <label for="lastname">Lastname:</label>
        <input type="text" name="lastname" id="lastname" />
        <br/>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" />
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
                <th>Email</th>
                <th>Address</th>
                <th>Customer ID</th>
            </tr>
        </thead>
        <tbody>
        <?php
            while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td><?=$row['firstname']?> <?=$row['lastname']?></td>
                <td><?=$row['email']?></td>
                <td><?=$row['address']?></td>
                <td><?=$row['cid']?></td>
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
