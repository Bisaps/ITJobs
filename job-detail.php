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
   <script src="jquery/dist/jquery.min.js"></script>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
         <div class="container">
         <a class="navbar-brand" href="#"><img src="img/logo1.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav m-auto">
                  <li class="nav-item active">
                     <a class="nav-link" href="http://localhost/itjob/index.php">Home <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="http://localhost/itjob/index.php#about">About Us</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="http://localhost/itjob/index.php#service">Services</a>
                  </li>
                  <?php
                  session_start();
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    // Admin navigation
    echo '<li class="nav-item dropdown">';
    echo '    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">';
    echo '        Dashboard';
    echo '    </a>';
    echo '    <div class="dropdown-menu">';
    echo '        <a class="dropdown-item" href="adminpost.php">Post</a>';
    echo '        <a class="dropdown-item" href="dashboard.php">Users</a>';
    echo '        <a class="dropdown-item" href="application.php">Applicants</a>';
    echo '    </div>';
    echo '</li>';
} else {
    // User navigation
    echo '<li class="nav-item dropdown">';
    echo '    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">';
    echo '        Jobs';
    echo '    </a>';
    echo '    <div class="dropdown-menu">';
    echo '        <a class="dropdown-item" href="http://localhost/itjob/index.php#jobweb">Frontend Developer</a>';
    echo '        <a class="dropdown-item" href="http://localhost/itjob/index.php#jobweb">Backend Developer</a>';
    echo '        <a class="dropdown-item" href="http://localhost/itjob/index.php#jobweb">Others</a>';
    echo '    </div>';
    echo '</li>';
}
?>

                  <li class="nav-item">
                     <a class="nav-link" href="http://localhost/itjob/index.php#contact">Contact Us</a>
                  </li>
               </ul>
            </div>
            <div class="login-side">
               <ul class="ms-flex list-unstyled">
               <?php
if (isset($_SESSION['email']))
{ echo " <li><a href='logout.php'>Logout</a></li>";
} 
   else {
    echo "<li ><a href='login.php'>Login</a></li>";
    echo "<li><a href='signup.php'>Sign Up</a></li>";
   }
   ?>
<?php
if (isset($_SESSION['user_id'])) {
    // Assuming you have a valid database connection stored in $conn
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null; // Get the user's ID from the session
    $conn = new mysqli("localhost", "root", "", "itjobs");
    // Query to fetch notifications for the user
    $query = "SELECT message FROM notifications WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    $notifications = array();

    while ($row = $result->fetch_assoc()) {
        $notifications[] = $row['message'];
    }

    $stmt->close();
    ?>
    <li class="not-wrap">
        <a href="#" class="icon" data-toggle="modal" data-target="#exampleModal">
            <span class="iconify" data-icon="mdi-light:bell"></span>
            <div class="alertno ms-flex"><?php echo count($notifications); ?></div>
        </a>
    </li>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Notifications</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-unstyled">
                        <?php foreach ($notifications as $notification): ?>
                            <li><?php echo $notification; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php
} else {
    ?>
    <li><a href="#" class="icon"><span class="iconify" data-icon="mdi-light:bell"></span></a></li>
    </ul>
</div>
</div>
<?php
}
?>


      </nav>
      <div class="breadcrumb" style="background-image: url(img/search.png); ">
         <div class="container">
            <h2>Job Detail</h2>
            <h4>Take your career to the next level.</h4>
         </div>
      </div>
      <section class="company-job-detail">
         <div class="container">
            <div class="row">
               <div class="col-md-9">
                  <div class="job-detail-content left-content left-content-box" id="left-content">
                     <div class="company-banner">
                        <div class="img-holder">
                           <img src="img/9034__Thakur.jpg" alt="9034__Thakur.jpg" >
                        </div>
                        <?php
                           $conn = new mysqli("localhost", "root", "", "itjobs");
if ($conn->connect_error) {
    die("Connection failed");
}
if (isset($_GET['ID'])) { 
   $jobId = $_GET['ID'];
   
   $sql = "SELECT * FROM jobpost WHERE ID = $jobId";
   $result =$conn->query($sql);
   if ($result->num_rows == 1) {
      $jobdetails = $result->fetch_assoc(); 
$jOpen = $jobdetails['Opening'];
$jCompany=$jobdetails['Company'];
$jTitle=$jobdetails['Position'];
$jLocation = $jobdetails['Location'];
$jLevel=$jobdetails['Level'];
$jSalary=$jobdetails['Salary'];
$jobExperience= $jobdetails['Experience'];
$jExpire=$jobdetails['Expire'];
$jLogo=$jobdetails['File'];

?>
                        <div class="text-overlay">
         
                           <div class="company-logo">
                              <a href="#">
                              <img src="<?php echo $jLogo; ?>" alt="">
                              </a>
          
                           </div>
 

                           <div class="text-box">
                              <h5 style="font-weight:normal;"><?php echo $jCompany; ?></h5>
                              <p><span class="icon-location2"></span> <?php echo $jLocation; ?></p>
                              <div class="btn-wrap employer_follow">
                                 <a href="#" class="btn btn-xs">Views(4048
                                 )</a>
                                 <a data-employer="23375" href="javascript:;" class="btn btn1 btn-xs">Follow (6)</a>
                              </div>
                           </div>
                        </div>
                        <div class="link-overlay"><a href="#"><span class="icon-sphere"></span></a>
                        </div>
                     </div>
                     <div class="company-detail">
                        <h4>About Us</h4>
                        <div class="more-content">
                           <p><?php echo $jCompany; ?> is company which has been registered under the Companies Registration Act, 1956 (No. 1 of 1956), Nepal. The versatility of the company has enabled us to develop multifaceted expertise that has broadened our experience to match the demands of today.</p>
                        </div>
                     </div>
                     <div class="content-wrap">
                        <div class="top-content-box">
                           <h3><?php echo $jTitle; ?></h3>
                           <h4>Basic Information</h4>
                           <ul class="job-detail-box">
                              <li>
                                 <strong>No. of Openings</strong>
                                 <span><?php echo $jOpen;?> </span>
                              </li>
                              <li>
                                 <strong>Job Category</strong>
                                 <span>
                                 <?php echo $jTitle;?>
                                 </span>
                              </li>
                              <li>
                                 <strong>Job Location</strong>
                                 <span>
                               <?php echo $jLocation;?>
                                 </span>
                              </li>
                              <li>
                                 <strong>Job Level</strong>
                                 <span><?php echo $jLevel;?></span>
                              </li>
                              <li>
                                 <strong>Salary</strong>
                                 <span>
                                <?php echo $jSalary;?>
                                 </span>
                              </li>
                              <li>
                                 <strong>Desired Candidate</strong>
                                 <span>
                                 Both(Female, Male)
                                 </span>
                              </li>
                              <li>
                                 <strong>Experience</strong>
                                 <span>
                                 <?php echo $jobExperience;?>
                                 </span>
                              </li>
                              <li>
                                 <strong>Expiry date</strong>
                                 <span><?php echo $jExpire;?></span>
                              </li>
                              <li>
                                 <strong>License</strong>
                                 <span>
                                 no
                                 </span>
                              </li>
                              <li>
                                 <strong>Skills</strong>
                                 <span>web designer, web developer, Java, JavaScript, HTML, CSS, Programming, Program Development, SQL</span>
                              </li>
                           </ul>
                        </div>
                        <?php
     }
   }
?>
                        <div class="job-description-wrap">
                           <h4>Job Description</h4>
                           <ul>
                              <li>Website and software application designing, building, or maintaining.</li>
                              <li>Using scripting or authoring languages, management tools, content creation tools, applications, and digital media.</li>
                              <li>Editing, writing, or designing Website content, and directing team members who produce content.</li>
                              <li>Maintaining an understanding of the latest Web applications and programming practices through education, study, and participation in conferences, workshops, and groups.</li>
                              <li>Directing or performing Website updates.</li>
                           </ul>
                        </div>
                        <div class="job-description-wrap">
                           <h4>Job Specification</h4>
                           <ul>
                              <li>Knowledge of Django for the application.</li>
                              <li>Knowledge of high-traffic webs hop and their architecture is a bonus.</li>
                              <li>Problem-solving ability; through your knowledge and experience of different methodologies and design patterns.</li>
                              <li>Knowledge of framework.</li>
                              <li>Customization of Prestashop theme.</li>
                              <li>Develop, troubleshoot, and enhance cutting-edge web applications.</li>
                              <li>Frameworks - Code Igniter, Laravel.</li>
                              <li>Technologies - JavaScript JS, HTML, CSS, PHP, JavaScript JSON, MySQL.</li>
                              <li>Web-based chat application development and maintenance.</li>
                              <li>Proficient in JavaScript, HTML, CSS &amp; SQL</li>
                              <li>Knowledge of programming language and technical terminology.</li>
                              <li>Able to solve complex problems.</li>
                           </ul>
                           <p><strong>Note: working hours will be&nbsp;12:00 PM to 8:00 PM</strong></p>
                        </div>
                        <div class="job-description-wrap">
                           <h4>Apply Instruction</h4>
                           <p>Interested candidates are requested to send their complete CVs with an expected salary at career@itjobs.np.com. For more info: 014720270, 9819649068.</p>
                           <p>&nbsp;</p>
                        </div>
                        <div style="display: flex;align-items: center;justify-content: space-between;flex-wrap: wrap;gap:10px;" class="btn-list-box">
                        <?php
$conn = new mysqli("localhost", "root", "", "itjobs");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT ID, Position FROM jobpost"; 
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    if ($row = $result->fetch_assoc()) {
        echo '<div class="left-side-applynsave-btn">';
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            echo '<span class="job-delete">';
            echo '   <a data-job="' . $jobId .  '" href="javascript:;" class="btn btn-danger btn-xs" title="Delete Job" onclick="confirmDelete(' . $row["ID"] . ')">Delete Post</a>';
            echo '</span>';
        } else {
            echo '<span class="job-apply">';
            echo '<a id="applyButton_' . $jobId . '" href="fileupload.php?id=' . $jobId . '" class="btn btn-primary btn-xs" title="Apply for Job">Apply Now</a>';
            echo '</span>';
            // echo '<span class="bookmark">';
            // echo '   <a data-job="' . $jobId  . '" href="javascript:;" class="btn btn-xs btn-primary"  onclick="confirmSave(' .  $jobId .')">Save Job</a>';
            // echo '</span>';
        }
        
        echo '</div>';
    }
} else {
    echo "No featured jobs available.";
}
?>
<script>
function confirmSave(jobId) {
    var confirmSave = confirm("Do you really want to save this job?");
    if (confirmSave) {
        saveJob(jobId);
    }
}

function saveJob(jobId) {
    $.ajax({
        url: 'updateNotifications.php',
        type: 'POST',
        data: {
            job_id: jobId,
            action: 'save_job'
        },
        success: function(response) {
            if (response === 'success') {
                updateNotificationIcon();
                updateModalContent("Job saved successfully.");
                $('#exampleModal').modal('show');
                setTimeout(function() {
                    clearNotificationMessage();
                    $('#exampleModal').modal('hide');
                }, 5000);
            } else if (response === 'error') {
                updateModalContent("Error saving job.");
                $('#exampleModal').modal('show');
                setTimeout(function() {
                    clearNotificationMessage();
                    $('#exampleModal').modal('hide');
                }, 5000);
            } else {
                updateModalContent(response);
                $('#exampleModal').modal('show');
        setTimeout(function() {
            clearNotificationMessage();
            $('#exampleModal').modal('hide');
        }, 5000);
    }
}
    });
}

function updateModalContent(message) {
    var notificationMessageElement = document.getElementById("notificationModalMessage");
    notificationMessageElement.textContent = message;
}
</script>

<script>
function confirmDelete(jobId) {
    var confirmDelete = confirm("Do you really want to delete the post?");
    if (confirmDelete) {
        window.location.href = "deletepost.php?jobid=" + jobId;
    }
}
</script>

                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="job-list">
                     <h3>Features Jobs</h3>
                     <ul class="list-disc ml-3">
                     <?php
            $conn = new mysqli("localhost", "root", "", "itjobs");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT ID, Position FROM jobpost";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo '<li><a href="job-detail.php?ID=' . $row["ID"] . '">' . $row["Position"] . '</a></li>';
                }
            } else {
                echo "No featured jobs available.";
            }

            $conn->close();
            ?>
                     </ul>
                  </div>
                  <div class="job-list mt-4">
                     <h3>Recent Blogs</h3>
                     <ul class="list-unstyled ml-3">
                        <li>
                           <div class="thumbnail">
                              <img src="img/thumb_how_to_become_a_.net_developer_.jpg" class="img-responsive" alt="How to become a .Net Developer">
                           </div>
                           <a href="#">How to become a .Net Developer</a>
                        </li>
                        <li>
                           <div class="thumbnail">
                              <img src="img/thumb_how_to_become_a_.net_developer_.jpg" class="img-responsive" alt="How to become a .Net Developer">
                           </div>
                           <a href="#">How to become a .Net Developer</a>
                        </li>
                        <li>
                           <div class="thumbnail">
                              <img src="img/thumb_how_to_become_a_.net_developer_.jpg" class="img-responsive" alt="How to become a .Net Developer">
                           </div>
                           <a href="#">How to become a .Net Developer</a>
                        </li>
                        <li>
                           <div class="thumbnail">
                              <img src="img/thumb_how_to_become_a_.net_developer_.jpg" class="img-responsive" alt="How to become a .Net Developer">
                           </div>
                           <a href="#">How to become a .Net Developer</a>
                        </li>
                        <li>
                           <div class="thumbnail">
                              <img src="img/thumb_how_to_become_a_.net_developer_.jpg" class="img-responsive" alt="How to become a .Net Developer">
                           </div>
                           <a href="#">How to become a .Net Developer</a>
                        </li>
                     </ul>
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