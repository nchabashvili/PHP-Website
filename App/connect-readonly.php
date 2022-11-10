<?php

$address = 'localhost';
$user = 'group28admin';
$password = 'LiftedAgainst';
$db = 'dbws';

$conn = mysqli_connect($address, $user, $password, $db);
if (mysqli_connect_errno()) {
	return false;
}

return $conn;