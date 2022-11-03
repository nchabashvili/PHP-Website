<?php
    $conn = require(__DIR__ . '/../app/start_connect.php');
?>
<h2>Insert new drug</h2>
<a href="<?=ROOT?>reference/drugs.php" class="reference">Reference</a>
<form method='POST' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="name">name:</label>
    <input type="text" name="name" required/><span class="must">*</span>
    <br/>
    <br/>
    <label for="price">price:</label>
    <input type="number" name="price" required/><span class="must">*</span>
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
    
    $name = $price = '';


    // Output the rest of the page and be done with this script
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        mysqli_close($conn);
        include_once(__DIR__ . '/../app/end.php');
        exit();
    }

    $sname = mysqli_real_escape_string($conn, $_POST['name']);
    $sprice = mysqli_real_escape_string($conn, $_POST['price']);

    $sql = "INSERT INTO Drug (name, price) VALUES ('$name', '$price')";
    
    // Output the rest of the page and be done with this script
    if (!$conn->query($sql)) {
        echo "Insert error: " . mysqli_error($conn);
        mysqli_close($conn);
        include_once(__DIR__ . '/../app/end.php');
        exit();
    }

    echo '<p class="success">Drug was succesfully added to the Drugs table!</p>';
    mysqli_close($conn);
    include_once(__DIR__ . '/../app/end.php'); 
?>
