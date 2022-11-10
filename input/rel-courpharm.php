<?php
    include_once(__DIR__ . '/../app/start.php');
    
    $conn = require(__DIR__ . '/../app/connect.php');
    if ($conn === false) {
        echo '<p class="error">Error connecting to the SQL Database!</p>';
        include_once(__DIR__ . '/../app/end.php');
        exit();
    }

    $pharmacies = $conn->query("SELECT * FROM Pharmacy");
    $couriers = $conn->query("SELECT U.firstname, U.lastname, U.email, C.courid FROM Users U, Courier C WHERE U.uid = C.uid ORDER BY U.uid");
?>
<h2>Insert a new courier-pharmacy Relationship</h2>
<p>Create a new "courier-pharmacy" relationship between a "Courier" entity and a "Pharmacy" entity.</p>
<p>References: 
    <a href="<?=ROOT?>reference/Couriers.php" class="reference">Couriers</a>
    <a href="<?=ROOT?>reference/Pharmacies.php" class="reference">Pharmacies</a>
</p>
<form method='POST' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="courid">Courier:</label>
    <select name="courid" id="courid">
        <?php
            while ($row = $couriers->fetch_assoc()) {
                echo "<option value='$row[courid]'>$row[firstname] $row[lastname]</option>";
            }
        ?>
    </select>
    <span class="must">*</span>

    <label for="pharmaid">Course:</label>
    <select name="pharmaid" id="pharmaid">
        <?php
            while ($row = $courses->fetch_assoc()) {
                echo "<option value='$row[pharmaid]'>$row[name]</option>";
            }
        ?>
    </select>
    <span class="must">*</span>

    <button type="submit">
        Add
    </button>
</form>
</br>
</br>
</br>
<?php
    // Output the rest of the page and be done with this script
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        mysqli_close($conn);
        include_once(__DIR__ . '/../app/end.php');
        exit();
    }

    $pharmaid = mysqli_real_escape_string($conn, $_POST['pharmaid']);
    $courid = mysqli_real_escape_string($conn, $_POST['courid']);
        
    $sql = "INSERT INTO Teaches (courid, pharmaid) VALUES ('$courid', '$pharmaid')";
    // Output the rest of the page and be done with this script
    if (!$conn->query($sql)) {
        echo "Insert error: " . mysqli_error($conn);
        mysqli_close($conn);
        include_once(__DIR__ . '/../app/end.php');
        exit();
    }

    echo '<p class="success">A new realtionship was succesfully added to the courier-pharmacy table!</p>';
    mysqli_close($conn);
    include_once(__DIR__ . '/../app/end.php'); 
?>
