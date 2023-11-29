
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
                        <a class="dropdown-item" href="#">Frontend Developer</a>
                        <a class="dropdown-item" href="#">BAckend Developer</a>
                        <a class="dropdown-item" href="#">Others</a>
                     </div>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="http://localhost/itjob/index.php#contact">Contact Us</a>
                  </li>
               </ul>
            </div>
            <div class="login-side">
               <ul class="ms-flex list-unstyled">
               <?php
session_start();
if (isset($_SESSION['email']))
{ echo " <li><a href='logout.php'>Logout</a></li>";
} 
   else {
    echo "<li ><a href='login.php'>Login</a></li>";
    echo "<li><a href='signup.php'>Sign Up</a></li>";
   }
   ?>
                  <li><a href="#" class="icon"><span class="iconify" data-icon="mdi-light:bell"></span></a></li>
               </ul>
            </div>
         </div>
      </nav>
      <section class="signup">
         <div class="container">
            <div class="card-body">
               <div class="row">
                  <div class="col-md-6 banner-img js-register p-0 d-md-block d-none">
                     <br>
                     <div class="px-5 text-white">
                        <h4 class="py-4">
                           Register for a better opportunity!
                        </h4>
                        <div class="media mt-3">
                           <div class="media-left mr-2">
                              <span class="icon-circle-check mr-2 text-white icon-one-half-x"></span>
                           </div>
                           <div class="media-body">
                              <h5>#1 Job Site of Nepal</h5>
                              <small>Google Analytics, Social Medias, Jobseeker and Employer have
                              always put us on top!</small>
                           </div>
                        </div>
                        <div class="media mt-3">
                           <div class="media-left mr-2">
                              <span class="icon-circle-check mr-2 text-white icon-one-half-x"></span>
                           </div>
                           <div class="media-body">
                              <h5>Most Trusted Job Portal in Nepal</h5>
                              <small>Over 400 million+ page views since the inception year
                              2009 over 6.5 million+ monthly visitors and it's growing everyday.</small>
                           </div>
                        </div>
                        <div class="media mt-3">
                           <div class="media-left mr-2">
                              <span class="icon-circle-check mr-2 text-white icon-one-half-x"></span>
                           </div>
                           <div class="media-body">
                              <h5>It's FREE and It will Always Be</h5>
                              <small>At merojob we don't put a price on opportunity, what you see is what you get! An
                              average of 25,000 job opportunities to choose from. No registration fees. No hidden
                              costs.</small>
                           </div>
                        </div>
                        <div class="media mt-3">
                           <div class="media-left mr-2">
                              <span class="icon-circle-check mr-2 text-white icon-one-half-x"></span>
                           </div>
                           <div class="media-body">
                              <h5>Your Confidentiality is Assured</h5>
                              <small>We understand your professional goals are yours and yours only. So you can be
                              confident that searching and applying for your next career opportunity is 100%
                              confidential and secure.</small>
                           </div>
                        </div>
                        <div class="media mt-3">
                           <div class="media-left mr-2">
                              <span class="icon-circle-check mr-2 text-white icon-one-half-x"></span>
                           </div>
                           <div class="media-body">
                              <h5>We Provide Career Opportunities</h5>
                              <small>We are proud to have partnered with more than 35,000+
                              businesses and launched over 2,00,000+ careers and counting.</small>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="card col-md-6 p-0">
                     <div class="p-5">
                        <h4 class="text-primary">
                           Create your free Jobseeker Account
                        </h4>
                        <p class="text-muted">
                           Register with basic information, Complete your profile and start applying for the job for free!
                        </p>
                        <form  action="postSIGN.php" method="POST"   id="myform">
                           <input type="hidden" name="csrfmiddlewaretoken" value="">
                           <input type="hidden" name="csrfmiddlewaretoken" value=""> 
                           <div id="div_id_name" class="form-group">
                                 <div class="input-group">
                                    <div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span> </div>
                                    <input type="text" name="username" placeholder="Full Name" class="textinput textInput form-control" required="" id="id_name"> 
                                 </div>
                                 <p id="nameError" class="error"></p>
                              </div>
                           <div id="div_id_contact_number" class="form-group">
                                 <div class="input-group">
                                    <div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-phone" aria-hidden="true"></i></span> </div>
                                    <input type="text" name="contact_number" placeholder="Mobile Number" class="textinput textInput form-control check_number" required="" id="id_contact_number"> 
                                 </div>
                                 <p id="numberError" class="error"></p>
                              </div>
                           <div id="div_id_email" class="form-group">
                                 <div class="input-group">
                                    <div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-envelope-o" aria-hidden="true"></i></span> </div>
                                    <input type="email" name="email" placeholder="E-mail address" autocomplete="email" class="textinput textInput form-control check_email" required="" id="id_email"> 
                                 </div>
                                 <p id="emailError" class="error"></p>
                              </div>
                           <div id="div_id_password1" class="form-group">
                                 <div class="input-group">
                                    <div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span> </div>
                                    <input type="password" name="password1" placeholder="Password" autocomplete="new-password" class="textinput textInput form-control" required="" id="id_password1"> 
                                 </div>
                                 <p id="passwordError" class="error"></p>
                              </div>
                           <div id="div_id_password2" class="form-group">
                                 <div class="input-group">
                                    <div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span> </div>
                                    <input type="password" name="password2" placeholder="Confirm Password" class="textinput textInput form-control" required="" id="confirmPassword"> 
                                    </div>
                                    <p id="confirmPasswordError" class="error"></p>
                              </div> 
                              <iframe style="display: none;"></iframe>
                           <p class="text-muted">
                              <input type="checkbox" required>
                              By clicking on 'Create Jobseeker Account' below you are agreeing to the
                              <a href="/terms-and-conditions/" target="_blank" tabindex="-1">terms</a> and <a href="/privacy-policy/" target="_blank" tabindex="-1">privacy</a> of
                              ITJobs!
                           </p>
                           <div class="form-group">
                              <button type="submit" name="submit"  class="btn bg-secondary btn-block text-white" id="registerBtnJobseeker">Create Account</button>
                              </div>
                        </form>
                        <div id="successMessage" class="success-message" style="display: none;"></div>
                              <style>
                             .error {
                            color: red;
                              }
                            </style>
                             <script src="jquery/dist/jquery.min.js"></script>
                                  
                             <script>
  function checkform() {
    event.preventDefault(); 

    var name = document.getElementById("id_name").value;
    var number = document.getElementById("id_contact_number").value;
    var email = document.getElementById("id_email").value;
    var password = document.getElementById("id_password1").value;
    var confirmPassword = document.getElementById("confirmPassword").value;

    var nameRegex = /^[a-zA-Z\s]{4,20}$/;
    var numberRegex = /^98\d{8}$/;
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!nameRegex.test(name)) {
      document.getElementById("nameError").innerHTML = "Invalid name should contain four characters";
      return false;
    }

    if (!numberRegex.test(number)) {
      document.getElementById("numberError").innerHTML = "Number should start with 98 at the beginning";
      return false;
    }

    if (!emailRegex.test(email)) {
      document.getElementById("emailError").innerHTML = "Invalid email address should contain @";
      return false;
    }

    if (password.length < 8) {
      document.getElementById("passwordError").innerHTML = "Password must be at least 8 characters";
      return false;
    }

    if (confirmPassword !== password) {
      document.getElementById("confirmPasswordError").innerHTML = "Passwords do not match";
      return false;
    }

    var xhr = new XMLHttpRequest();
    var url = "postSign.php";
    var formData = new FormData();
    formData.append("username", name);
    formData.append("contact_number", number);
    formData.append("email", email);
    formData.append("password1", password);
    formData.append("password2", confirmPassword);

xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.message === "success") {
                var password = document.getElementById("id_password1").value;
                var confirmPassword = document.getElementById("confirmPassword").value;
                if (password === confirmPassword) {
                    document.getElementById("successMessage").innerHTML = "Account created successfully!";

                    // Display the success message
                    document.getElementById("successMessage").style.display = "block";

                    // Use the alert function to show a pop-up alert
                    alert("Account created successfully!Now you can login");
                        window.location.href = "login.php";
                  
                } else {
                    document.getElementById("confirmPasswordError").innerHTML = "";
                    // Show error message if passwords don't match
                    document.getElementById("confirmPasswordError").innerHTML = "Passwords do not match.";
                }
            } else if (response.message === "email_exists") {
                document.getElementById("emailError").innerHTML = "This email is already taken.";
            } else if (response.message === "number_exists") {
                document.getElementById("numberError").innerHTML = "This number is already taken.";
            } else {
                console.error("Server request failed: " + response.error);
            }
        } else {
            console.error("Server request failed: " + xhr.status);
        }
    }
};
    xhr.open("POST", url, true);
    xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest"); // Set custom header to identify AJAX request
    xhr.send(formData);

    return false;
  }

  function clearErrors() {
    var errorElements = document.getElementsByClassName("error");
    for (var i = 0; i < errorElements.length; i++) {
      errorElements[i].textContent = "";
    }
  }

  document.getElementById("myform").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent form submission
    clearErrors(); // Clear previous error messages
    checkform(); // Call the validation function
  });
</script>


      
                        <p>
                           Already have jobseeker account?
                           <a href="login.php">Log in</a>
                        </p>
                        <!-- <p class="text-muted line"><span>OR</span></p>
                        <div class="row text-center font-weight-bold py-0">
                           <div class="col-12">
                              <a href="#" class="btn btn-google bg-primary p-2 text-white" id="registerGoogleBtnJobseeker">
                              <span class="icon-googleplus mx-1"></span> Login with Google
                              </a>
                           </div>
                        </div> -->
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