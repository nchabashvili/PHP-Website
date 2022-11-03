<?php

include_once(__DIR__ . '/start.php');
    
$conn = require(__DIR__ . '/connect.php');
if ($conn === false) {
    echo '<p class="error">Error connecting to the SQL Database!</p>';
    include_once(__DIR__ . '/end.php');
    exit();
}

return $conn;