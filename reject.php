<?php
// reject.php

if (isset($_GET['user_id']) && isset($_GET['job_id'])) {
    $userId = $_GET['user_id'];
    $jobId = $_GET['job_id'];
    $conn = new mysqli("localhost", "root", "", "itjobs");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get job information
    $getJobInfoSql = "SELECT jp.Company, jp.Position FROM jobpost jp WHERE jp.ID = $jobId";
    $jobInfoResult = $conn->query($getJobInfoSql);

    if ($jobInfoResult && $jobInfoResult->num_rows > 0) {
        $jobInfo = $jobInfoResult->fetch_assoc();
        $rejectMessage = "Your application for the position of " . $jobInfo['Position'] . " at " . $jobInfo['Company'] . " has been rejected.";
        
        // Insert rejection notification
        $insertNotificationSql = "INSERT INTO notifications (user_id, job_id, message) VALUES ($userId, $jobId, '$rejectMessage')";

        if ($conn->query($insertNotificationSql) === TRUE) {
            // Insertion successful
            // Now delete the application
            $deleteApplicationSql = "DELETE FROM applications WHERE user_id = $userId AND job_id = $jobId";

            if ($conn->query($deleteApplicationSql) === TRUE) {
                // Deletion successful
                echo "Rejection successful.";
            } else {
                echo "Error deleting application: " . $conn->error;
            }
        } else {
            echo "Error inserting rejection notification: " . $conn->error;
        }
    } else {
        echo "Error fetching job info: " . $conn->error;
    }

    $conn->close();
} else {
    echo 'Invalid request.';
}
?>
