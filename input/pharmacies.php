<?php
    $conn = require(__DIR__ . '/../app/start_connect.php');
?>
<h2>Insert a new Pharmacy</h2>
<a href="<?=ROOT?>reference/pharmacies.php" class="reference">Reference</a>
<form method='POST' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="name">name:</label>
    <input type="text" name="name" required/><span class="must">*</span>
    <br/>
    <br/>
    <label for="address">address:</label>
    <input type="text" name="address" required/><span class="must">*</span>
    <br/>
    </br>
    <button type="submit">
        Add
    </button>
</form>
</br>
</br>
</br>
<?php
    
    $name = $address = '';


    // Output the rest of the page and be done with this script
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        mysqli_close($conn);
        include_once(__DIR__ . '/../app/end.php');
        exit();
    }

    $sname = mysqli_real_escape_string($conn, $_POST['name']);
    $saddress = mysqli_real_escape_string($conn, $_POST['address']);

    $sql = "INSERT INTO Pharmacy (name, address) VALUES ('$name', '$address')";
    
    // Output the rest of the page and be done with this script
    if (!$conn->query($sql)) {
        echo "Insert error: " . mysqli_error($conn);
        mysqli_close($conn);
        include_once(__DIR__ . '/../app/end.php');
        exit();
    }

    echo '<p class="success">Pharmacy was succesfully added to the Pharmacies table!</p>';
    mysqli_close($conn);
    include_once(__DIR__ . '/../app/end.php'); 
?>
