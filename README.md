ITJob Management System

The ITJob Management System is a PHP-based event management system that allows users to signup, login, apply for jobs, and receive notifications of job posts. The system uses a XAMPP MySQL server to store user data and job post information, and incorporates Bootstrap for styling.
Features

    User authentication
    Create, read, update, and delete (CRUD) job posts for Admin
    Valid users can apply for jobs by posting files
    Client-side and server-side validation
    Separate pages for login and signup

Prerequisites

    XAMPP server
    PHP 7.4 or higher
    Bootstrap 4 or higher

Installation
XAMPP Server Setup

    Download and Install XAMPP: Download XAMPP from the official Apache Friends website. Install XAMPP following the installation instructions for your operating system.
    Start Apache Server: Open the XAMPP Control Panel. Start the Apache server by clicking on the "Start" button next to "Apache".
    Move the Project to XAMPP's htdocs Directory: Move the cloned repository folder EventManagement to the htdocs directory inside your XAMPP installation directory (e.g., C:\xampp\htdocs on Windows or /Applications/XAMPP/htdocs on macOS).

Access the Application

Open your web browser and navigate to http://localhost/itjob/index.php
Usage
Signup

URL: http://localhost/itjob/signup.php

    Enter Fullname, Mobile Number, Email, Password, and Confirm password
    Click on Create Account to direct to login page

Login Page

URL: http://localhost/itjob/index.php

    Enter credentials and click "Login"
    Redirects to the user page where you can manage events

Apply for Job

URL: http://localhost/itjob/job-detail.php

    View job details and apply for the job
    Redirects to http://localhost/itjob/fileupload.php to upload required files
    After uploading files, redirects back to http://localhost/itjob/index.php

Receive Notification

    Users will receive notifications of job posts

Admin Usage

URL: http://localhost/itjob/index.php (same login URL for Admin)

    Enter credentials and click "Login"
    Redirects to admin.php
    Visit dashboard.php to view dashboard
    Post job using adminpost.php
    View user applications through application.php
    Click logout to logout from the system

Screenshots file contain image of website look

AdminJobPost.png  -- for admin posting job
AdminView.png   -- for admin to see user application for job post
Apply.png   -- for user to apply job 
FileUpload.png  --  for user cv for the job
FrontView.png    -- view of the website on the first visit to the website
JobDescription.png   --  description of the job 
Jobs.png   -- list of jobs to apply
Login.png   -- for both user and admin to login to the system
Notification.png   -- for new post and application status history
Troubleshooting

    Apache Server Not Starting: Ensure no other application is using port 80 or 443 (common ports for Apache). Run XAMPP Control Panel as an administrator.
    Changes Not Reflected: Clear your browser cache and refresh the page. Ensure you have saved changes to your PHP files and the JSON file.

By following these instructions, you can successfully set up, run, and understand the ITJob Management System. This README file provides all the necessary details for installation, usage, and troubleshooting.
