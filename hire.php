<?php
// hire.php

if (isset($_GET['user_id']) && isset($_GET['job_id'])) {
    $userId = $_GET['user_id'];
    $jobId = $_GET['job_id'];
    $conn = new mysqli("localhost", "root", "", "itjobs");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $getJobInfoSql = "SELECT jp.Company, jp.Position FROM jobpost jp WHERE jp.ID = $jobId";
    $jobInfoResult = $conn->query($getJobInfoSql);

    if ($jobInfoResult && $jobInfoResult->num_rows > 0) {
        $jobInfo = $jobInfoResult->fetch_assoc();
        $hireMessage = "For " . $jobInfo['Company'] . ", you have been hired for the position of " . $jobInfo['Position'];
        $insertNotificationSql = "INSERT INTO notifications (user_id, job_id, message) VALUES ($userId, $jobId, '$hireMessage')";

        if ($conn->query($insertNotificationSql) === TRUE) {
            // Insertion successful
            // Now delete the application
            $deleteApplicationSql = "DELETE FROM applications WHERE user_id = $userId AND job_id = $jobId";

            if ($conn->query($deleteApplicationSql) === TRUE) {
                // Deletion successful
                echo "Hiring successful.";
            } else {
                echo "Error deleting application: " . $conn->error;
            }
        } else {
            echo "Error inserting notification: " . $conn->error;
        }
    } else {
        echo "Error fetching job info: " . $conn->error;
    }

    $conn->close();
} else {
    echo 'Invalid request.';
}
?>
