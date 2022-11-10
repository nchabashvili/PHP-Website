<?php

function passAuth($username, $password, $conn) {
    $authSql = "
        SELECT A.username, A.pass
        FROM Admins A
        WHERE 
            A.username = '$username'
            AND A.pass = '$password'
    ";

    $authResult = $conn->query($authSql);

    //Handle incorrect password and email
    if (!$authResult) {
        echo "Insert error: " . mysqli_error($conn);
        mysqli_close($conn);
        include_once(__DIR__ . '/../app/end.php');
        exit();
    } else if(mysqli_num_rows($authResult) == 0) {
        echo "Incorrect username or password!";
        mysqli_close($conn);
        include_once(__DIR__ . '/../app/end.php');
        exit();
    }

    return $authResult;
} 

?>

