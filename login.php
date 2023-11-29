<?php
session_start();
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
                     <a class="nav-link" href="http://localhost/itjob/index.php">Home <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="http://localhost/itjob/index.php#about">About Us</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="http://localhost/itjob/index.php#service">Services</a>
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
                     <a class="nav-link" href="http://localhost/itjob/index.php#contact">Contact Us</a>
                  </li>
               </ul>
            </div>
            <div class="login-side">
               <ul class="ms-flex list-unstyled">
               <ul class="ms-flex list-unstyled">
               <?php
if (isset($_SESSION['email'])) {
    // Display "Logout" link for both admin and non-admin users
    echo "<li><a href='logout.php'>Logout</a></li>";

   
   //  if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
   //      // Display "Add Post" button for admin users only
   //      echo "<li><a href='add_post.php'>Add Post</a></li>";
   //  }
} else {
    echo "<li><a href='login.php'>Login</a></li>";
    echo "<li><a href='signup.php'>Sign Up</a></li>";
}
if (isset($_SESSION['role'])=="user") {
   header("Location: index.php");
   exit();
}
   if (isset($_SESSION['role'])=="admin") {
      header("Location: admin.php");
      exit();
   
}
?>

                  <li><a href="#" class="icon"><span class="iconify" data-icon="mdi-light:bell"></span></a></li>
               </ul>
            </div>
         </div>
      </nav>
      <div class="login-wrapper">
         <div class="container">
            <div class="row">
               <div class="col-md-6 m-auto">
                  <div class="login-box text-center">
                     <div class="login-title">
                        <h3>Login</h3>
                        <!-- <div class="image">
                           <a href="#">
                           <img src="img/google-signin.png" alt="">
                           </a>
                        </div> -->
                     </div> 
                       <form id="loginForm" class="" action="" method="post">
                     <div class="signup__part mt-3">
                     <div class="bg__none email__part mb-4">
                           <label class="sr-only" for="email">Email</label>
                           <div class="input-group">
                              <div class="input-group-prepend input-border">
                                 <div class="input-group-text"><i class="fa fa-envelope-o" aria-hidden="true"></i></div>
                                  </div>
                                  <input type="text" class="form-control form_left_bd" name="email" id="email" placeholder="Email" >
                              </div>
                            <p id="usernameorEmailError" class="error"></p>
                           </div>
                        </div>
                         <div class="bg__none password__part mb-4">
                              <label class="sr-only" for="password">Password</label>
                            <div class="input-group">
                               <div class="input-group-prepend input-border">
                                  <div class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></div>
                                  </div>
                                  <input type="password" class="form-control form_left_bd" name="password" id="password" placeholder="Password" >
                                </div>
                               <p id="passwordError" class="error"></p>
                          </div>
                          <!-- <div class="rem-wrapper ms-flex justify-content-between">
                          <div>
                           <p>I'm &nbsp
                           <input type="radio" name="role" id="Admin" Required> Admin &nbsp
                           <input type="radio" name="role" id="Client" Required> Client
                        </p>
                          </div>
                        </div> -->
                        <!-- <div class="rem-wrapper ms-flex justify-content-between">
                           <div class="login-modal">
                              <div class="form-group mb-0">
                                 <div id="div_id_remember" class="form-check">
                                    <label for="id_remember" class="form-check-label">
                                    <input type="checkbox" name="remember" class="checkboxinput form-check-input" id="remember">
                                    Remember Me
                                    </label>
                                 </div>
                              </div>
                           </div>
                           <div class="fg-password">
                              <a href="forgetpw.php">Forgot Password?</a>
                           </div>
                        </div> -->
                        <div class="signup__part__btn mt-3">
                        <button type="submit" name="login" class="blue__bg full__width text-center">Login</button>
                        </div>
                     </div>
                  </div>
 </form>          
 <script src="jquery/dist/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#loginForm").submit(function(e){
            e.preventDefault();
            
            var email = $("#email").val();
            var password = $("#password").val();
            
            $.ajax({
                type: "POST",
                url: 'postLOGIN.php', // Change this to your server-side script
                data: {
                    email: email,
                    password: password
                },
                success: function(response) {
                  console.log("Response from server:", response);
    var jsonData = JSON.parse(response);
    console.log("JSON data:", jsonData);
                    if (jsonData.success == "1") {
                        if (jsonData.role === 'user') {
                            alert("Login Successful");
                            window.location.href = "index.php";
                        } else {
                           alert("Admin Login Successful");
                            window.location.href = "admin.php";
                        }
                    } else {
                        alert("Invalid Email or Password");
                    }
                }
            });
        });
    });
</script>
        
    </div>
               </div>
            </div>             
         </div>
      </div>
     
      
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