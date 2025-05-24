<?php
$host = 'localhost';
$user = 'workboatroot';      // your db username
$pass = 'Amit@28010';          // your db password
$dbname = 'upcharon_db';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
