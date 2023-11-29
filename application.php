<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}
?>
<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="css/bootstrap.min.css"/>
      <link rel="stylesheet" href="css/owl.carousel.min.css"/>
      <link rel="stylesheet" href="css/owl.theme.default.min.css"/>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,400;1,500&display=swap">
      <link rel="stylesheet" href="css/style.css"/>
      <title>ITJobs</title>
   </head>
   <body>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
         <div class="container">
         <a class="navbar-brand" href="#"><img src="img/logo1.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav m-auto">
                  <li class="nav-item active">
                     <a class="nav-link" href="http://localhost/itjob/admin.php">Home <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="http://localhost/itjob/admin.php#about">About Us</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="http://localhost/itjob/admin.php#service">Services</a>
                  </li>
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                     Dahboard
                     </a>
                     <div class="dropdown-menu">
                        <a class="dropdown-item" href="adminpost.php">Post</a>
                        <a class="dropdown-item" href="dashboard.php">Users</a>
                        <a class="dropdown-item" href="application.php">Applicants</a> 
                     </div>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="http://localhost/itjob/admin.php#contact">Contact Us</a>
                  </li>
               </ul>
            </div>
            <div class="login-side">
               <ul class="ms-flex list-unstyled">
               <?php
if (isset($_SESSION['email'])) {
   echo "<li><a href='logout.php'>Logout</a></li>";
   // if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {

   //     echo "<li><a href='add_post.php'>Add Post</a></li>";
   // }
} else {
   echo "<li><a href='login.php'>Login</a></li>";
   echo "<li><a href='signup.php'>Sign Up</a></li>";
}
?>
                  <li><a href="#" class="icon"><span class="iconify" data-icon="mdi-light:bell"></span></a></li>
               </ul>
            </div>
         </div>
      </nav>
      <section class="post-wrapper">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="dash-title job-post">
                     <h2>Users</h2>
                  </div>
                  <div class="dash-table">
                     <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">Full Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Mobile No</th>
                            <th scope="col">FileName</th>
                            <th scope="col">Company</th>
                            <th scope="col">Position</th>
                            <th scope="col" class="text-center">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "itjobs";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT 
           j.FName,
           j.Email,
           j.Number,
           a.file_name,
           jp.Position,
           jp.Company,
           a.user_id,
           a.job_id
        FROM 
           jobs j
        JOIN 
           applications a ON j.UID = a.user_id
        JOIN 
           jobpost jp ON a.job_id = jp.ID
        WHERE 
           j.UID = a.user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['FName'] . '</td>';
        echo '<td>' . $row['Email'] . '</td>';
        echo '<td>' . $row['Number'] . '</td>';
        echo '<td>' . $row['file_name'] . '</td>';
        echo '<td>' . $row['Position'] . '</td>';
        echo '<td>' . $row['Company'] . '</td>';
      echo   '<td>
                    <a href="download.php?file=' . $row['file_name'] . '" class="btn btn-success">Download CV</a>
                    <button class="btn btn-primary hire-btn" data-applicant-id="' . $row['user_id'] . '" data-job-id="' . $row['job_id'] . '">Hire</button>
                    <button class="btn btn-danger reject-btn" data-applicant-id="' . $row['user_id'] . '" data-job-id="' . $row['job_id'] . '">Reject</button>
                </td>';
        echo '</tr>';
    }
}
?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<div id="successMessage"></div>
<script>
$(document).ready(function () {
    // Attach a click event listener to each hire button
    $('.hire-btn').on('click', function () {
        // Show a confirmation dialog
        const isConfirmed = confirm('Do you really want to hire the job seeker for the required position?');

        if (isConfirmed) {
            // If confirmed, get the user_id and job_id from the button's data attributes
            const userId = $(this).data('applicant-id');
            const jobId = $(this).data('job-id');

            // Perform an AJAX request to the PHP script for hiring
            $.ajax({
                url: 'hire.php',
                type: 'GET',
                data: { user_id: userId, job_id: jobId },
                success: function (response) {
                    // Display a success message for hiring
                    $('#successMessage').text(response).css('color', 'green');
                    // You can also hide the corresponding row if needed
                    $(this).closest('tr').hide();
                },
                error: function (xhr, status, error) {
                    alert('Error hiring the job seeker: ' + error);
                }
            });
        }
    });

    // Attach a click event listener to each reject button
    $('.reject-btn').on('click', function () {
        // Show a confirmation dialog
        const isConfirmed = confirm('Do you really want to reject the job seeker for the required position?');

        if (isConfirmed) {
            // If confirmed, get the user_id and job_id from the button's data attributes
            const userId = $(this).data('applicant-id');
            const jobId = $(this).data('job-id');

            // Perform an AJAX request to the PHP script for rejection
            $.ajax({
                url: 'reject.php', // Create a separate PHP script for rejection logic
                type: 'GET',
                data: { user_id: userId, job_id: jobId },
                success: function (response) {
                    // Display a success message for rejection
                    $('#successMessage').text(response).css('color', 'red');
                    // You can also hide the corresponding row if needed
                    $(this).closest('tr').hide();
                },
                error: function (xhr, status, error) {
                    alert('Error rejecting the job seeker: ' + error);
                }
            });
        }
    });
});
</script>


                        </tbody>
                      </table>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <div class="footer">
         <div class="top-footer">
            <div class="container">
               <div class="footer-inner">
                  <div class="logo-side">
                     <div class="image">
                        <img src="img/logo1.png" alt="LOGO">
                     </div>
                     <div class="content">
                        <p>Millions of happy users work better with
                           our integrated Apps. Millions of happy
                           users work better with our integrated Apps.
                        </p>
                     </div>
                  </div>
                  <div class="categories">
                     <h3>Quick Links</h3>
                     <ul class="list-unstyled">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Finance Intregations</a></li>
                        <li><a href="#">Locations</a></li>
                        <li><a href="#">Other Servies</a></li>
                     </ul>
                  </div>
                  <div class="categories">
                     <h3>Other Pages</h3>
                     <ul class="list-unstyled">
                        <li><a href="#">Resource</a></li>
                        <li><a href="#">Resources Name</a></li>
                        <li><a href="#">Author Resources</a></li>
                        <li><a href="#">Financial Resouces</a></li>
                     </ul>
                  </div>
                  <div class="form-side categories">
                     <div class="social-links">
                        <h3>Social Links</h3>
                        <ul class="d-flex list-unstyled">
                           <li class="ms-flex"><a href="#"> <span><i class="fa fa-facebook" aria-hidden="true"></i></span></a></li>
                           <li>
                              <div class="social-link-text">
                                 <h6>Facebook</h6>
                                 <span><a href="#">https: //www.facebook.com//itjob</a></span>
                              </div>
                           </li>
                        </ul>
                        <ul class="d-flex list-unstyled">
                           <li class="ms-flex"><a href="#"> <span><i class="fa fa-linkedin" aria-hidden="true"></i></span></a></li>
                           <li>
                              <div class="social-link-text">
                                 <h6>Linkedin</h6>
                                 <span><a href="#">https: //www.linkedin.com/itjob</a></span>
                              </div>
                           </li>
                        </ul>
                        <ul class="d-flex list-unstyled">
                           <li class="ms-flex"><a href="#"> <span><i class="fa fa-twitter" aria-hidden="true"></i></span></a></li>
                           <li>
                              <div class="social-link-text">
                                 <h6>Twitter</h6>
                                 <span><a href="#">https: //www.twitter.com/itjob</a></span>
                              </div>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script src="js/iconify.min.js"></script>
      <script src="js/jquery.min.js"></script>
      <script src="js/jquery-1.12.4.min.js"></script>
      <script src="js/jquery.counterup.min.js"></script>
      <script src="js/waypoints.min.js"></script>
      <script src="js/owl.carousel.min.js"></script>
      <script src="js/custom.js"></script>
      <script src="js/bootstrap.min.js"></script>
   </body>
</html>