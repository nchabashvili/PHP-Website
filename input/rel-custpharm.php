<?php
    $conn = require(__DIR__ . '/../app/start_connect.php');

    $pharmacies = $conn->query("SELECT * FROM Pharmacies");
    $customer = $conn->query("SELECT U.firstname, U.lastname, U.email, C.custid FROM Users U, customer C WHERE U.uid = C.uid ORDER BY U.uid");
?>
<h2>Insert a new customer-pharmacy Relationship</h2>
<p>Create a new "customer-pharmacy" relationship between a "Customers" entity and a "Pharmacies" entity.</p>
<p>References: 
    <a href="<?=ROOT?>reference/customer.php" class="reference">Customers</a>
    <a href="<?=ROOT?>reference/pharmacies.php" class="reference">Pharmacies</a>
</p>
<form method='POST' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="custid">customer:</label>
    <select name="custid" id="custid">
        <?php
            while ($row = $customer->fetch_assoc()) {
                echo "<option value='$row[custid]'>$row[firstname] $row[lastname]</option>";
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
    $custid = mysqli_real_escape_string($conn, $_POST['custid']);
        
    $sql = "INSERT INTO Teaches (custid, pharmaid) VALUES ('$custid', '$pharmaid')";
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
