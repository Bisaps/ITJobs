<?php
session_start();
if (isset($_POST['email']) && isset($_POST['password'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "itjobs";

    $conn = new mysqli($servername, $username, $password, $dbname);

    $email = $_POST['email'];
    $pass = $_POST['password'];

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
  
    $adminSql = "SELECT * FROM admin WHERE Email='$email' AND Password='$pass'";
    $adminResult = mysqli_query($conn, $adminSql) or die("Admin query failed.");

    if (mysqli_num_rows($adminResult) > 0) {
        $row = mysqli_fetch_assoc($adminResult); // Corrected this line
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $row['AdminFirstName'];;
        $_SESSION['email'] = $row['Email'];
        $_SESSION['password'] = $row['Password'];
        $_SESSION['role'] = 'admin'; 
        echo json_encode(array('success' => 1, 'role' => 'admin'));
    } else {
        $userSql = "SELECT * FROM jobs WHERE Email='$email' AND Password='$pass'";
        $userResult = mysqli_query($conn, $userSql) or die("User query failed.");

        if (mysqli_num_rows($userResult) > 0) {
            $row = mysqli_fetch_assoc($userResult);
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $row['FName'];
            $_SESSION['email'] = $row['Email'];
            $_SESSION['user_id'] = $row['UID'];
            $_SESSION['user_number'] = $row['Number'];
            $_SESSION['password'] = $row['Password'];
            $_SESSION['role'] = 'user';
            echo json_encode(array('success' => 1, 'role' => 'user'));
        } else {
            echo json_encode(array('success' => 0));
        }
    }
} else {
    echo json_encode(array('success' => 0));
}
?>

