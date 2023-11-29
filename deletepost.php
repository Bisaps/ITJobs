<?php
session_start();

if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin' && isset($_GET['jobid'])) {
    $conn = new mysqli("localhost", "root", "", "itjobs");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $jobId = $_GET['jobid'];

    $deleteSql = "DELETE FROM jobpost WHERE ID = $jobId";

    if ($conn->query($deleteSql) === TRUE) {
        header("Location: admin.php");
    } else {
        echo "Error deleting post: " . $conn->error;
    }

    $conn->close();
} else {
    header("Location: index.php"); // Redirect back to index.php
    exit();
}
?>
