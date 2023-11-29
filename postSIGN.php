<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "itjobs";
$tableName = "jobs";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// require 'tableanddata.php';
 
// Check if the form is submitted
// if ($_SERVER["REQUEST_METHOD"] == "POST") {$_SERVER["REQUEST_METHOD"] == "POST" && 
    // Retrieve form data
    // if (isset($_POST['submit'])) 

    // // Perform server-side validation
    // $errors = array();

    // if (!preg_match('/^[a-zA-Z\s]+$/', $FName)) {
    //     $errors['nameError'] = "Invalid name. It should contain only characters.";
    // }

    // if (!preg_match('/^98\d{8}$/', $Phone)) {
    //     $errors['numberError'] = "Invalid number. It should start with 98 and have 10 digits.";
    // }

    // if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
    //     $errors['emailError'] = "Invalid email address.";
    // }

    // if (strlen($Password) < 8) {
    //     $errors['passwordError'] = "Password must be at least 8 characters long.";
    // }

    // if ($Password !== $CoPassword) {
    //     $errors['confirmPasswordError'] = "Passwords do not match.";
    // }

    // If there are no validation errors, proceed with the form submission
    // if (empty($errors))  {  // Perform database connection and insertion
        function checkEmailExists($conn, $email) {
            $sql = "SELECT * FROM jobs WHERE Email = '$email'";
            $result = $conn->query($sql);
            return $result->num_rows > 0;
        }
        
        function checkNumberExists($conn, $number) {
            $sql = "SELECT * FROM jobs WHERE Number = '$number'";
            $result = $conn->query($sql);
            return $result->num_rows > 0;
        }
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $FName = trim($_POST['username']);
            $Phone = trim($_POST['contact_number']);
            $Email = trim($_POST['email']);
            $Password = trim($_POST['password1']);
            $CoPassword = trim($_POST['password2']);
        
            if (isset($_POST['email']) && isset($_POST['contact_number'])) {
                $email = $_POST['email'];
                $number = $_POST['contact_number'];
        
                $emailExists = checkEmailExists($conn, $email);
                $numberExists = checkNumberExists($conn, $number);
        
                if ($emailExists) {
                    echo json_encode(["message" => "email_exists"]);
                } else if ($numberExists) {
                    echo json_encode(["message" => "number_exists"]);
                } else {
                    $sql = "INSERT INTO $tableName (FName, Number, Email, Password, CoPassword) VALUES ('$FName', '$Phone', '$Email', '$Password', '$CoPassword')";
                
                    if ($conn->query($sql) === true) {
                        echo json_encode(["message" => "success"]);
                    } else {
                        echo json_encode(["message" => "error", "error" => $conn->error]);
                    }
                }
            }
        }
        ?>


