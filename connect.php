<?php
$servername = "localhost";
$username = "root";
$password = ""; // default is empty in XAMPP
$database = "stud"; // make sure this matches your database name

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
