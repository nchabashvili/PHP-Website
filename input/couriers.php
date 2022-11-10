<?php
    include_once(__DIR__ . '/../app/start.php');
    
    $conn = require(__DIR__ . '/../app/connect.php');
    if ($conn === false) {
        echo '<p class="error">Error connecting to the SQL Database!</p>';
        include_once(__DIR__ . '/../app/end.php');
        exit();
    }

    $users = $conn->query("SELECT * FROM Users ORDER BY uid");
?>
<h2>Insert a new Courier</h2>
<a href="<?=ROOT?>reference/couriers.php" class="reference">Reference</a>
<form method='POST' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="uid">User:</label>
    <select name="uid" id="uid">
        <?php
            while ($row = $users->fetch_assoc()) {
                echo "<option value='$row[uid]'>$row[firstname] $row[lastname] ($row[email])</option>";
            }
        ?>
    </select>
    <span class="must">*</span>

    <label for="username">Username:</label>
    <input type="text" name="username" required></input>
    <span class="must">*</span>
    
    <label for="password">Password:</label>
    <input type="password" name="password" required></input>
    <span class="must">*</span>
    <br/>
    <br/>

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
    
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    include_once(__DIR__ . '/../app/auth.php');
    passAuth($username, $password, $conn);

    $uid = mysqli_real_escape_string($conn, $_POST['uid']);

    echo '<p class="success">Courier was succesfully added to the Courier table!</p>';
    mysqli_close($conn);
    include_once(__DIR__ . '/../app/end.php'); 
?>

