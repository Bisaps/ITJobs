<?php
session_start();

if ($_POST['action'] === 'save_job') {
    $user_id = $_SESSION['user_id']; 
    $job_id = $_POST['job_id']; 

    $conn = new mysqli("localhost", "root", "", "itjobs");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $job_sql = "INSERT INTO jobs (user_id, job_id) VALUES (?, ?)";
    $job_stmt = $conn->prepare($job_sql);
    $job_stmt->bind_param("ii", $user_id, $job_id);

    if ($job_stmt->execute()) {
        $job_details_sql = "SELECT Position FROM jobpost WHERE ID = ?";
        $job_details_stmt = $conn->prepare($job_details_sql);
        $job_details_stmt->bind_param("i", $job_id);
        $job_details_stmt->execute();
        $job_details_result = $job_details_stmt->get_result();

        if ($job_details_result->num_rows > 0) {
            $row = $job_details_result->fetch_assoc();
            $position = $row['Position'];
            $notification_message = "You have successfully saved a job: $position";

            $notification_insert_sql = "INSERT INTO notifications (user_id, job_id, message) VALUES (?, ?, ?)";
            $notification_insert_stmt = $conn->prepare($notification_insert_sql);
            $notification_insert_stmt->bind_param("iis", $user_id, $job_id, $notification_message);

            if ($notification_insert_stmt->execute()) {
                echo "You have successfully saved a job: $position ";
            } else {
                echo 'error';
            }
        } else {
            echo 'error';
        }
    } else {
        echo 'error';
    }

    $job_stmt->close();
    $job_details_stmt->close();
    $notification_insert_stmt->close();
    $conn->close();
} else {
    echo 'error';
}
?>
