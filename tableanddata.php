<?php
// require 'dbcon.php';
// $dbname = "itjobs";
// $tableName = "jobs";
// Check if the database exists
// $query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$dbname'";
// $result = $conn->query($query);

$servername = "localhost";
$username = "root";
$password = "";
$dbname ="itjobs";
$tableName ="jobs";

// Create a new mysqli instance
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// if ($result->num_rows > 0) {
//     echo "Database exists";
// } else {
//     // Create the database
//     $createDatabaseQuery = "CREATE DATABASE $dbname";
//     if ($conn->query($createDatabaseQuery) === true) {
//         echo "Database created successfully";
//     } else {
//         echo "Error creating database: " . $conn->error;
//     }
// }

// $checkTableQuery = "SHOW TABLES LIKE '$tableName'";

        $createTableQuery = "CREATE TABLE $tableName (
             FName VARCHAR(100),
             Number VARCHAR(100),
             Email VARCHAR(100),
             Password VARCHAR(100),
             CoPassword VARCHAR(100)
        )";
       if ($conn->query($createTableQuery) === true) {
        echo "Table created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }
    
    

    ?>