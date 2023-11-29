<?php
session_start(); 

$fileMessage = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_FILES["fileToUpload"])) {
        $jobId = isset($_POST['id']) ? $_POST['id'] : null; 
        if (!empty($jobId)) {
            $conn = new mysqli("localhost", "root", "", "itjobs");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $userId = $_SESSION['user_id'];

            // Check if the user has already applied for this job
            $checkApplicationSql = "SELECT * FROM applications WHERE user_id = ? AND job_id = ?";
            $checkApplicationStmt = $conn->prepare($checkApplicationSql);
            $checkApplicationStmt->bind_param("ii", $userId, $jobId);
            $checkApplicationStmt->execute();
            $checkApplicationResult = $checkApplicationStmt->get_result();

            if ($checkApplicationResult->num_rows > 0) {
                $fileMessage = "You have already applied for this job.";
            } else {
                // Validate and process the uploaded file
                $uploadedFile = $_FILES["fileToUpload"];
                $uploadDir = "uploads/"; // Directory where files will be stored
                $allowedFileTypes = ["pdf", "doc", "docx"]; // Allowed file types

                // Generate a unique filename to avoid overwriting existing files
                $uniqueFilename = $uploadedFile["name"];
                $targetFilePath = $uploadDir . $uniqueFilename;

                // Check if the uploaded file is a valid type and within size limits
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

                if (!in_array(strtolower($fileType), $allowedFileTypes)) {
                    $fileMessage = "Invalid file format. Only PDF, DOC, and DOCX files are allowed.";
                } elseif ($uploadedFile["size"] > 5 * 1024 * 1024) {
                    $fileMessage = "File size exceeds the limit (5MB).";
                } else {
                    // Move the uploaded file to the server
                    if (move_uploaded_file($uploadedFile["tmp_name"], $targetFilePath)) {
                        // Insert application details into the 'applications' table
                        $applicationSql = "INSERT INTO applications (user_id, job_id, file_name, file_path, application_date) VALUES (?, ?, ?, ?, NOW())";
                        $applicationStmt = $conn->prepare($applicationSql);
                        
                        if ($applicationStmt === false) {
                            // Handle the SQL prepare error
                            $fileMessage = "Error preparing SQL statement: " . $conn->error;
                        } else {
                            $applicationStmt->bind_param("iiss", $userId, $jobId, $uniqueFilename, $targetFilePath);
                            
                            if ($applicationStmt->execute()) {
                                $fileMessage = "Job applied successfully!!";

                                // Fetch Position and Company from jobpost
                                $getJobInfoSql = "SELECT Position, Company FROM jobpost WHERE ID = ?";
                                $getJobInfoStmt = $conn->prepare($getJobInfoSql);
                                $getJobInfoStmt->bind_param("i", $jobId);
                                $getJobInfoStmt->execute();
                                $getJobInfoResult = $getJobInfoStmt->get_result();

                                if ($getJobInfoResult && $getJobInfoResult->num_rows > 0) {
                                    $jobInfo = $getJobInfoResult->fetch_assoc();
                                    $notificationMessage = "You have applied for a new job at " . $jobInfo['Company'] . " for the position of " . $jobInfo['Position'];
                                    
                                    // Insert notification
                                    $insertNotificationSql = "INSERT INTO notifications (user_id, job_id, message) VALUES (?, ?, ?)";
                                    $insertNotificationStmt = $conn->prepare($insertNotificationSql);
                                    $insertNotificationStmt->bind_param("iis", $userId, $jobId, $notificationMessage);
                                    
                                    if ($insertNotificationStmt->execute()) {
                                        // Notification inserted successfully
                                    } else {
                                        // Handle the notification insertion error
                                        $fileMessage = "Error inserting notification: " . $insertNotificationStmt->error;
                                    }
                                    
                                    $insertNotificationStmt->close();
                                } else {
                                    $fileMessage = "Error fetching job info: " . $conn->error;
                                }

                                $getJobInfoStmt->close();
                            } else {
                                // Handle the SQL execution error
                                $fileMessage = "Error applying for the job: " . $applicationStmt->error;
                            }

                            $applicationStmt->close();
                        }
                    } else {
                        $fileMessage = "Error uploading file to the server.";
                    }
                }
            }

            $checkApplicationStmt->close();
            $conn->close();
        } else {
            $fileMessage = "No job ID provided.";
        }
    } else {
        $fileMessage = "No file uploaded.";
    }

    echo $fileMessage;
}
?>
