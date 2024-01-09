<?php //เริ่มใช้ php
$serverName = 'localhost';
$userName = 'root';
$userPassword = ''; //Lab room 408 or 409 - 12345678
$dbname = 'business';

try {
    $conn = new PDO(
        "mysql:host=$serverName;dbname=$dbname",
        $userName, $userPassword
    );

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'You are now connected to the database!';

} catch (PDOException $e) {
    echo 'Sorry! You cannot connect to the database: ' . $e->getMessage();
}
?>