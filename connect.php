<?php
$host = 'localhost';      // or your DB host
$dbname = 'ebay_clone'; // your DB name
$userName = 'root';
$password = '';

$conn = new mysqli($host, $userName, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>