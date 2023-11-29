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
                     Dashboard
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
               <div class="col-md-6 m-auto">
                  <div class="job-post">
                     <h2>Post job</h2>
                     <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "itjobs";
$tableName = "Jobpost";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$open = $pos = $sal = $exp = $fileErrorMessage = "";
$jobPostedSuccessfully = false;
$successMessage = "";
$fileErrorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $opening = $_POST['opening'];
    if (!is_numeric($opening) || $opening <= 0 || $opening >= 10) {
        $open = "No. of Openings must be a positive number less than 10";
    }

    $position = $_POST['position'];
    if (!preg_match("/^[a-zA-Z ]*$/", $position)) {
        $pos = "Position can only contain letters and spaces.";
    }

    $company = $_POST['company'];
    $salary = $_POST['salary'];
    if (!is_numeric($salary) || $salary <= 0) {
        $sal = "Salary must be a valid number.";
    }

    $experience = $_POST['years'];
    $location = $_POST['location'];
    $expire = $_POST['expire'];
    if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $expire)) {
        $exp = "Expiry date must be in YYYY-MM-DD format.";
    }

    $credit = $_POST['hours'];
    $level = $_POST['level'];

    if (isset($_FILES["logo"]) && $_FILES["logo"]["error"] === UPLOAD_ERR_OK) {
        $targetDirectory = "uploads/";
        $targetFile = $targetDirectory . basename($_FILES["logo"]["name"]);
        $fileType = $_FILES["logo"]["type"];
        $allowedFormats = array("image/jpeg", "image/jpg", "image/png", "image/gif"); // Allowed image formats with MIME types

        if (in_array($fileType, $allowedFormats)) {
            if (move_uploaded_file($_FILES["logo"]["tmp_name"], $targetFile)) {
                // Prepare SQL statement
                if (empty($open) && empty($pos) && empty($sal) && empty($exp) && empty($fileErrorMessage)) {
                    $stmt = $conn->prepare("INSERT INTO Jobpost (Opening, Position, Company, Salary, Experience, Location, Expire, Credit, Level, File) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                    if ($stmt) {
                        $stmt->bind_param("ssssssssss", $opening, $position, $company, $salary, $experience, $location, $expire, $credit, $level, $targetFile);

                        if ($stmt->execute()) {
                            $jobPostedSuccessfully = true;
                            $jobdetails = array(
                                'jobOpening' => $opening,
                                'jobTitle' => $position,
                                'jobCompany' => $company,
                                'jobSalary' => $salary,
                                'jobExperience' => $experience,
                                'jobLocation' => $location,
                                'jobExpire' => $expire,
                                'jobCredit' => $credit,
                                'jobLevel' => $level,
                                'jobFile' => $targetFile,
                            );
                            $jobId = $conn->insert_id;

                            // Redirect to job details page
                            header("Location: job-detail.php?ID=" . urlencode($jobId));
                            exit;
                        } else {
                            echo "Error posting job: " . $stmt->error;
                        }

                        $stmt->close();
                    } else {
                        echo "Error preparing statement: " . $conn->error;
                    }
                }
            } else {
                $fileErrorMessage = "Error uploading file.";
            }
        } else {
            $fileErrorMessage = "Invalid file format. Only jpeg, jpg, png, and gif formats are allowed.";
        }
    }
}
?>

                     <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="adminpost" method="post" enctype="multipart/form-data">
                     <div class="form-group ms-flex form-label">
                        <label for="opening">No. of Openings :</label>
                        <input type="text" class="form-control" id="opening" name="opening" aria-describedby="emailHelp" Required>
                      </div>
                      <p  id="p"><?php echo $open;?></p>
                     <div class="form-group ms-flex form-label">
                        <label for="position">Job Category :</label>
                        <input type="text" class="form-control" id="position" name="position" aria-describedby="emailHelp" Required>
                      </div>
                      <p id="p"><?php echo $pos; ?></p>
                      <div class="form-group ms-flex form-label">
                        <label for="company">Company :</label>
                        <input type="text" class="form-control" id="company" name="company" aria-describedby="emailHelp" Required>
                      </div>
                      <div class="form-group ms-flex form-label">
                        <label for="file">Company Logo :</label>
                        <input type="file" id="logo" name="logo" Required>
                      </div>
                      <p  id="p"><?php echo $fileErrorMessage;?></p>
                      <div class="form-group ms-flex form-label">
                        <label for="salary">Salary :</label>
                        <input type="text" class="form-control" id="salary" name="salary" aria-describedby="emailHelp" Required>
                      </div>
                      <p  id="p"><?php echo $sal;?></p>
                      <div class="form-group ms-flex form-label">
                        <label for="years">Experience :</label>
                        <input type="text" class="form-control" id="years" name="years" aria-describedby="emailHelp" Required>
                      </div>
                      <div class="form-group ms-flex form-label">
                        <label for="location">Job Location :</label>
                        <input type="text" class="form-control" id="location" name="location" aria-describedby="emailHelp" Required>
                      </div>
                      <div class="form-group ms-flex form-label">
                        <label for="expire">Expiry date :</label>
                        <input type="text" class="form-control" id="expire" name="expire" aria-describedby="emailHelp" Required>
                      </div>
                      <p  id="p"><?php echo $exp;?></p>
                      <div class="form-group ms-flex form-label">
                        <label for="hours">Credit hours :</label>
                        <select class="form-control" id="hours" name="hours">
                          <option>full time</option>
                          <option>part time</option>
                        </select>
                      </div>
                      <div class="form-group ms-flex form-label">
                        <label for="level">Job Level :</label>
                        <select class="form-control" id="level" name="level">
                           <option>Senior</option>
                           <option>Junior</option>
                           <option>Mid-level</option>
                        </select>
                      </div>
                      <div class="success-message" style="<?php echo $jobPostedSuccessfully ? 'display: block;' : 'display: none;'; ?>">
                        <p class="success">Job posted successfully.</p>
                     </div>

                      <button type="submit" class="btn btn-primary mt-2 w-100">Post</button>
                  </form>
                  <script>
document.addEventListener("DOMContentLoaded", function() {
    var successMessage = document.querySelector(".success-message");

    if (successMessage) {
        setTimeout(function() {
            successMessage.style.display = "none";
        }, 2000); 
    }
});
</script>

                  <style>
#p {color: #FF0000;}
.success { color: #00FF00; }
</style>
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