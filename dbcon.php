<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname ="itjobs";
$tableName ="jobs";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
