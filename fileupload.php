<?php
  session_start();
               if (!isset($_SESSION['user_id'])) {
                   header("Location: login.php"); 
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
                     <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#">About Us</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#">Services</a>
                  </li>
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                     Jobs
                     </a>
                     <div class="dropdown-menu">
                        <a class="dropdown-item" href="http://localhost/itjob/index.php#jobweb">Frontend Developer</a>
                        <a class="dropdown-item" href="http://localhost/itjob/index.php#jobweb">Backend Developer</a>
                        <a class="dropdown-item" href="http://localhost/itjob/index.php#jobweb">Others</a>
                     </div>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#">Contact Us</a>
                  </li>
               </ul>
            </div>
            <div class="login-side">
               <ul class="ms-flex list-unstyled">
               <?php
if (isset($_SESSION['email'])) {
    echo "<li><a href='logout.php'>Logout</a></li>";

   //  if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
   //      // Display "Add Post" button for admin users only
   //      echo "<li><a href='add_post.php'>Add Post</a></li>";
   //  }
} else {
    echo "<li><a href='login.php'>Login</a></li>";
    echo "<li><a href='signup.php'>Sign Up</a></li>";
}
?><?php
// Assuming you have a valid database connection stored in $conn
$userId = $_SESSION['user_id']; // Get the user's ID from the session
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
<?php
if (isset($_SESSION['user_id'])) {
    // Assuming you have a valid database connection stored in $conn
    $userId = $_SESSION['user_id']; // Get the user's ID from the session
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
      <section class="file-upload">
         <div class="container ">
            <div class="row">
               <div class="col-md-5 m-auto">
<form id="uploadForm" enctype="multipart/form-data">
    <div class="form-group">
        <label for="exampleFormControlFile1">You can upload your cv</label>
        <input type="file" name="fileToUpload" class="form-control-file" id="exampleFormControlFile1" required>
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
        <button type="submit" class="btn btn-primary mt-2">Upload</button>
        <!-- <p style="color:green" id="fileMessage"></p> -->
    </div>
</form>
<script src="jquery/dist/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $("#uploadForm").submit(function(e) {
        e.preventDefault(); // Prevent the default form submission
        
        var formData = new FormData(this);

        $.ajax({
            url: "PostFile.php", // Replace with the actual URL of your PHP script
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $("#fileMessage").text(response); // Display the response message
                
                if (response === "You have already applied for this job.") {
    alert("You have already applied for this job."); 
} else if (response === "Job applied successfully!!") {
    alert("Job applied successfully!!");
    setTimeout(function() {
        window.location.href = "index.php";
    }, 1000);
}
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });
});
</script>

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