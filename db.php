<?php
$servername = "localhost"; // or the IP of your host if you're using a remote DB
$username = "root"; // your MySQL username
$password = ""; // your MySQL password (empty for local server)
$dbname = "reviews_db"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
