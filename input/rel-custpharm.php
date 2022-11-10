<?php
    include_once(__DIR__ . '/../app/start.php');
        
    $conn = require(__DIR__ . '/../app/connect.php');
    if ($conn === false) {
        echo '<p class="error">Error connecting to the SQL Database!</p>';
        include_once(__DIR__ . '/../app/end.php');
        exit();
}
    $pharmacies = $conn->query("SELECT * FROM Pharmacies");
    $customer = $conn->query("SELECT D.name, D.price ,D.did FROM drug D ORDER BY D.did");
?>
<h2>Insert a new drug-pharmacy Relationship</h2>
<p>Create a new "drug-pharmacy" relationship between a "Drug" entity and a "Pharmacy" entity.</p>
<p>References: 
    <a href="<?=ROOT?>reference/drugs.php" class="reference">Drugs</a>
    <a href="<?=ROOT?>reference/pharmacies.php" class="reference">Pharmacies</a>
</p>
<form method='POST' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="did">drug:</label>
    <select name="did" id="did">
        <?php
            while ($row = $drug->fetch_assoc()) {
                echo "<option value='$row[did]'>$row[name] $row[prices]</option>";
            }
        ?>
    </select>
    <span class="must">*</span>

    <label for="pid">Pharmacy:</label>
    <select name="pid" id="pid">
        <?php
            while ($row = $pharmacies->fetch_assoc()) {
                echo "<option value='$row[pid]'>$row[name]</option>";
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

    $pid = mysqli_real_escape_string($conn, $_POST['pid']);
    $did = mysqli_real_escape_string($conn, $_POST['did']);
        
    $sql = "INSERT INTO Teaches (did, pid) VALUES ('$did', '$pid')";
    // Output the rest of the page and be done with this script
    if (!$conn->query($sql)) {
        echo "Insert error: " . mysqli_error($conn);
        mysqli_close($conn);
        include_once(__DIR__ . '/../app/end.php');
        exit();
    }

    echo '<p class="success">A new realtionship was succesfully added to the customer-pharmacy table!</p>';
    mysqli_close($conn);
    include_once(__DIR__ . '/../app/end.php'); 
?>
