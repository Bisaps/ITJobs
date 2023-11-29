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
                     <a class="nav-link" href="http://localhost/itjob/index.php">Home <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#about">About Us</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#service">Services</a>
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
                     <a class="nav-link" href="#contact">Contact Us</a>
                  </li>
               </ul>
            </div>
            <div class="login-side">
               <ul class="ms-flex list-unstyled">
               <?php
session_start();
if (isset($_SESSION['role'])) {
   // Check if the user is an admin
   if ($_SESSION['role'] === 'admin') {
       // Redirect admin to admin.php
       header("Location: admin.php");
       exit();
   }}
// Check if the 'email' session variable is set, which indicates that the user is logged in
if (isset($_SESSION['email'])) {
    // Display "Logout" link for both admin and non-admin users
    echo "<li><a href='logout.php'>Logout</a></li>";
} else {
    // User is not logged in, display "Login" and "Sign Up" links
    echo "<li><a href='login.php'>Login</a></li>";
    echo "<li><a href='signup.php'>Sign Up</a></li>";
}
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
      <div class="hero-bg bg-default">
         <div class="container">
            <div class="banner-content">
               <div class="main-title">
                  <h3>Join IT Jobs Through Us</h3>
                  <div class="content">
                     <p>It is a long established fact that a reader
                        will be distracted by the readable content of
                        a page when looking at its layout.
                     </p>
                     <div class="btn-wrap ms-flex">
                        <input type="text" class="form-control" id="exampleInputText" placeholder="Search for jobs">
                        <a href="http://localhost/itjob/index.php#jobweb">Search</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <section class="about-text-img" id="about">
         <div class="container">
         <div class="main-title text-center">
                  <h3 class="section-heading mb-2">About<span>Us</span></h3>
                </div>
            <div class="ab-content-inner row">
               <div class="col-md-6">
                  <div class="image-bd-wrap">
                     <div class="image">
                        <img src="img/Rectangle146.png" alt="">
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="main-title">
                     <h6>What can we offer you?</h6>
                     <h3>Welcome to IT Jobs</h3>
                     <p>ITJob.com is one of the leading and growing job portals in Nepal. It is a product of Creative Job Pvt. Ltd. ITJob is covering almost every job in Nepalese job market with free job posting service to job provider. ITJob aims at providing detailed information to job seeker at free of cost. Currently, we are in beta testing phase and our skilled human resource at ITJob are continuously working on website improvement and making website more user-friendly. We, at ITJob always respect our customers and job seekers privacy. We don’t sell information about our clients /customer to third party at any cost without their consent.</p>
                     <div class="btn-wrap">
                        <a class="med-button" href="#">Read More</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <section>
         <div class="container" id="jobweb">
            <div class="main-title text-center">
               <h3 class="section-heading mb-2">Featured<span>Jobs</span></h3>
               <p>It is a long established fact that a reader
                 will be distracted by the readable content of
                 a page when looking at its layout.</p>
               </div>
               <?php
$connection = mysqli_connect('localhost', 'root', '', 'itjobs');

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM jobpost";
$result = mysqli_query($connection, $sql);
?>
<div class="row">
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="col-md-4">
            <div class="job-box">
                <div class="title-part d-flex">
                    <div class="image-side">
                    <img src="<?php echo $row['File']; ?>" alt="">
                    </div>
                    <div class="text-side ml-2">
                        <h5><?php echo $row['Position']; ?></h5>
                        <span><?php echo $row['Company']; ?></span>
                        <ul class="list-unstyled">
                            <li><span class="mr-1"><i class="fa fa-briefcase" aria-hidden="true"></i></span><?php echo $row['Experience']; ?></li>
                            <li><span class="mr-1"><i class="fa fa-inr" aria-hidden="true"></i></span><?php echo $row['Salary']; ?></li>
                            <li><span class="mr-1"><i class="fa fa-map-marker" aria-hidden="true"></i></span><?php echo $row['Location']; ?></li>
                            <li><span class="mr-1"><i class="fa fa-clock-o" aria-hidden="true"></i></span><?php echo $row['Expire']; ?></li>
                        </ul>
                    </div>
                </div>
                <div class="box-footer">
                    <ul class="tags list-unstyled d-flex">
                        <li><?php echo $row['Position']; ?></li>
                        <li><?php echo $row['Level']; ?></li>
                    </ul>
                    <div class="apply-btn">
                    <a href="#" onclick="redirectToJobDetail(<?php echo $row['ID']; ?>)">Apply Now</a>

<script>
function redirectToJobDetail(jobId) {
    window.location.href = "job-detail.php?ID=" + encodeURIComponent(jobId);
}
</script>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>

<?php
mysqli_close($connection);
?>
            </div>
         </div>
      </section>
      <section class="services" id="service">
         <div class="container">
            <div class="services-content">
               <div class="row">
                  <div class="col-md-4">
                     <div class="box main-title">
                        <h6>Our Services</h6>
                        <h3>What We Offer</h3>
                        <div class="content">
                           <p>It is a long established fact that a reader
                              will be distracted by the readable content of
                              a page when looking at its layout.
                           </p>
                           <div class="btn-wrap">
                              <a href="http://localhost/itjob/service-detail.php">VIEW ALL</a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="box text-center">
                        <div class="icon">
                           <span class="iconify" data-icon="ph:currency-circle-dollar"></span>
                        </div>
                        <div class="content">
                           <h4>Placement Services</h4>
                           <p>It is a long established fact that a reader
                              will be distracted by the readable content of
                              a page when looking at its layout.
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="box text-center">
                        <div class="icon">
                           <span class="iconify" data-icon="ph:currency-circle-dollar"></span>
                        </div>
                        <div class="content">
                           <h4>Outsourcing</h4>
                           <p>It is a long established fact that a reader
                              will be distracted by the readable content of
                              a page when looking at its layout.
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="box text-center">
                        <div class="icon">
                           <span class="iconify" data-icon="ph:currency-circle-dollar"></span>
                        </div>
                        <div class="content">
                           <h4>HR Consulting</h4>
                           <p>It is a long established fact that a reader
                              will be distracted by the readable content of
                              a page when looking at its layout.
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="box text-center">
                        <div class="icon">
                           <span class="iconify" data-icon="ph:currency-circle-dollar"></span>
                        </div>
                        <div class="content">
                           <h4>Job Posting Service</h4>
                           <p>It is a long established fact that a reader
                              will be distracted by the readable content of
                              a page when looking at its layout.
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="box text-center">
                        <div class="icon">
                           <span class="iconify" data-icon="ph:currency-circle-dollar"></span>
                        </div>
                        <div class="content">
                           <h4>Manage Investment</h4>
                           <p>It is a long established fact that a reader
                              will be distracted by the readable content of
                              a page when looking at its layout.
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <section class="bg-image-wrapper bg-default">
         <div class="container">
            <div class="testimonials-content">
               <div class="main-title text-center">
                  <h6>Hr Janelle Chambers</h6>
                  <h3>OUR EXPERT<span>TEAM</span></h3>
                  <div class="content">
                     <p>Hr Janelle Chambers is is dedicated to providing her customer
                        with the best possible care. We at MediCare are focused on helping you.
                     </p>
                  </div>
               </div>
               <div class="test-carousel owl-carousel">
                  <div class="test-content">
                     <span class="iconify quote" data-icon="entypo:quote"></span>
                     <p>Hr Janelle Chambers is is dedicated
                        to providing her customer with the best
                        possible care. We at MediCare are
                        focused on helping you.
                     </p>
                     <span class="icon-line"><span class="iconify icon" data-icon="ant-design:line-outlined"></span>Sushil</span>
                  </div>
                  <div class="test-content">
                     <span class="iconify quote" data-icon="entypo:quote"></span>
                     <p>Hr Janelle Chambers is is dedicated
                        to providing her customer with the best
                        possible care. We at MediCare are
                        focused on helping you.
                     </p>
                     <span class="icon-line"><span class="iconify icon" data-icon="ant-design:line-outlined"></span>Shankar</span>
                  </div>
                  <div class="test-content">
                     <span class="iconify quote" data-icon="entypo:quote"></span>
                     <p>Hr Janelle Chambers is is dedicated
                        to providing her customer with the best
                        possible care. We at MediCare are
                        focused on helping you.
                     </p>
                     <span class="icon-line"><span class="iconify icon" data-icon="ant-design:line-outlined"></span>Mahesh</span>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <div class="linear-bg-wrap">
         <div class="container">
            <div class="content-wrap linear-bg bg-default ms-flex">
               <div class="box main-title ">
                  <h4>Looking Forward For IT Jobs!</h4>
                  <p>Subscribe to Medicare newsletter now to get great discounts</p>
               </div>
               <div class="right-content">
                  <p>Sign up for Medicare newsletter to receive all the new offers and discounts
                     from Medicare clinic. Discounts are only valid four our newsletter subscribers.
                  </p>
                  <div class="subscribe-wrap">
                     <input type="text" class="form-control" placeholder="Enter your email address">
                     <button type="submit" >SUBSCRIBE</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <section class="section blog_section" id="others">
         <div class="container">
          <div class="main-title text-center">
            <h3 class="section-heading mb-2">Latest<span>Blogs</span></h3>
            <p>It is a long established fact that a reader
              will be distracted by the readable content of
              a page when looking at its layout.</p>
            </div>
            <div class="row">
               <div class="col-lg-6 col-md-12">
                  <div class="blog-wrap">
                     <div class="row">
                        <div class="col-lg-6 col-md-5 col-sm-5 col-xs-5">
                           <figure>
                              <a href="http://localhost/itjob/blog-detail.php">
                              <img src="img/thumb_how_to_become_a_.net_developer_.jpg" alt="How to become a .Net Developer" title="How to become a .Net Developer">
                              </a>
                           </figure>
                        </div>
                        <div class="col-lg-6 col-md-7 col-sm-7 col-xs-7">
                           <div class="blog_content">
                              <h4>
                                 <a href="http://localhost/itjob/blog-detail.php" title="How to become a .Net Developer">How to become a .Net Developer</a>
                              </h4>
                              <h5>
                                 <span><i class="fa fa-calendar-o"></i> 2023-03-12</span>
                              </h5>
                              <p>How to become a .Net Developer
                                 The world is on the verge of converting digital, which led the software development field to skyrocket. As .N...<a class="bbutton" href="#" title="">Read More</a>
                              </p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="blog-wrap">
                     <div class="row">
                        <div class="col-lg-6 col-md-5 col-sm-5 col-xs-5">
                           <figure>
                              <a href="http://localhost/itjob/blog-detail.php">
                              <img src="img/thumb_How_to_Start_a_Business_Analyst_Career.png" alt="How to Start a Business Analyst Career">
                              </a>
                           </figure>
                        </div>
                        <div class="col-lg-6 col-md-7 col-sm-7 col-xs-7">
                           <div class="blog_content">
                              <h4>
                                 <a href="http://localhost/itjob/blog-detail.php">How to Start a Business Analyst Career</a>
                              </h4>
                              <h5>
                                 <span><i class="fa fa-calendar-o"></i> 2023-03-01</span>
                              </h5>
                              <p>How to Start a Business Analyst Career
                                 As companies today are turning digital, big data and information have become an integral part of the ...<a class="bbutton" href="#" title="">Read More</a>
                              </p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                  <div class="blog-wrap">
                     <figure>
                        <a href="http://localhost/itjob/blog-detail.php">
                        <img src="img/thumb_content_writer_job_description.png" alt="Content Writing Job Description">
                        </a>
                     </figure>
                     <div class="blog_content">
                        <h4>
                           <a href="http://localhost/itjob/blog-detail.php">Content Writing Job Description</a>
                        </h4>
                        <h5>
                           <span><i class="fa fa-calendar-o"></i> 2023-02-22</span>
                        </h5>
                        <p>Content Writing Job Description
                           In this digital age, the internet has become the favorite point for many to seek information. So, businesses...<a class="bbutton" href="#" title="">Read More</a>
                        </p>
                     </div>
                  </div>
               </div>
               <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                  <div class="blog-wrap">
                     <figure>
                        <a href="http://localhost/itjob/blog-detail.php">
                        <img src="img/thumb_how_to_become_a_good_laravel_developer.jpg" alt="How to Become a Good Laravel Developer">
                        </a>
                     </figure>
                     <div class="blog_content">
                        <h4>
                           <a href="http://localhost/itjob/blog-detail.php">How to Become a Good Laravel Developer</a>
                        </h4>
                        <h5>
                           <span><i class="fa fa-calendar-o"></i> 2023-02-06</span>
                        </h5>
                        <p>How to Become a Good Laravel Developer
                           Despite Laravel Developer being one of the most sought coding jobs, it can be rigorous to become one ...<a class="bbutton" href="#" title="">Read More</a>
                        </p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <section class="linear-bg bg-default" id="contact">
         <div class="container">
            <div class="front-contact-wrap ms-flex-wrap">
               <div class="box main-title ">
                  <h4>GET IN TOUCH</h4>
                  <p>Come and visit our quarters or simply send us an email
                     anytime you want. We are open to all suggestions
                     from our audience.
                  </p>
               </div>
               <div class="contact-details-inner">
                  <div class="contact-wrap1 ms-flex-wrap">
                     <div class="ms-col-3">
                        <div class="map ms-flex">
                           <span class="iconify" data-icon="la:envelope"></span>
                        </div>
                        <div class="main-title1">
                           <h4>Email Address</h4>
                           <ul class="list-unstyled">
                              <li><a href="">info@exampleit.com</a></li>
                              <li><a href="">help@examplecompany.com</a></li>
                           </ul>
                        </div>
                     </div>
                     <div class="ms-col-3">
                        <div class="main-title1">
                           <div class="map ms-flex">
                              <span class="iconify" data-icon="bx:bx-phone-call"></span>
                           </div>
                           <h4>Contact Number</h4>
                           <ul class="list-unstyled">
                              <li><a href="">+9779812000375</a></li>
                              <li><a href="">+9779817708448</a></li>
                           </ul>
                        </div>
                     </div>
                     <div class="ms-col-3">
                        <div class="main-title1">
                           <div class="map ms-flex">
                              <span class="iconify" data-icon="bytesize:location"></span>
                           </div>
                           <h4>Office Location</h4>
                           <ul class="list-unstyled">
                              <li><a href="">info@exampleit.com</a></li>
                              <li><a href="">Kathmandu, Nepal</a></li>
                           </ul>
                        </div>
                     </div>
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
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#contact">Contact Us</a></li>
                        <li><a href="http://localhost/itjob/index.php">Finance Intregations</a></li>
                        <li><a href="#contact">Locations</a></li>
                        <li><a href="#other">Other Servies</a></li>
                     </ul>
                  </div>
                  <div class="categories">
                     <h3>Other Pages</h3>
                     <ul class="list-unstyled">
                        <li><a href="">Resource</a></li>
                        <li><a href="">Resources Name</a></li>
                        <li><a href="">Author Resources</a></li>
                        <li><a href="">Financial Resouces</a></li>
                     </ul>
                  </div>
                  <div class="form-side categories">
                     <div class="social-links">
                        <h3>Social Links</h3>
                        <ul class="d-flex list-unstyled">
                           <li class="ms-flex"><a href=""> <span><i class="fa fa-facebook" aria-hidden="true"></i></span></a></li>
                           <li>
                              <div class="social-link-text">
                                 <h6>Facebook</h6>
                                 <span><a href="">https: //www.facebook.com//itjob</a></span>
                              </div>
                           </li>
                        </ul>
                        <ul class="d-flex list-unstyled">
                           <li class="ms-flex"><a href=""> <span><i class="fa fa-linkedin" aria-hidden="true"></i></span></a></li>
                           <li>
                              <div class="social-link-text">
                                 <h6>Linkedin</h6>
                                 <span><a href="">https: //www.linkedin.com/itjob</a></span>
                              </div>
                           </li>
                        </ul>
                        <ul class="d-flex list-unstyled">
                           <li class="ms-flex"><a href=""> <span><i class="fa fa-twitter" aria-hidden="true"></i></span></a></li>
                           <li>
                              <div class="social-link-text">
                                 <h6>Twitter</h6>
                                 <span><a href="">https: //www.twitter.com/itjob</a></span>
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