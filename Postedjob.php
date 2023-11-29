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
                     Dahboard
                     </a>
                     <div class="dropdown-menu">
                        <a class="dropdown-item" href="adminpost.php">Post</a>
                        <a class="dropdown-item" href="dashboard.php">Users</a>
                        <!-- <a class="dropdown-item" href="#">Others</a> -->
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
                            <th scope="col">Opening</th>
                            <th scope="col">Position</th>
                            <th scope="col">Company</th>
                            <th scope="col">Location</th>
                            <th scope="col">Expire</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                           <?php
                           $servername = "localhost";
                           $username = "root";
                           $password = "";
                           $dbname = "itjobs";
                           $tableName = "jobs";
                           
                           $conn = new mysqli($servername, $username, $password, $dbname);
                           
                           if ($conn->connect_error) {
                               die("Connection failed: " . $conn->connect_error);
                           }
                           $sql="SELECT ID,Opening,Position,Company,Expire,Salary FROM jobpost";
                           $result=$conn->query($sql);
                           if ($result->num_rows > 0) {
                              while ($row = $result->fetch_assoc()) {
                                 echo '<tr>';
                                 // echo   '<th scope="row">1</th>';
                                //  echo   '<td>'. $row['ID'] .'</td>'; 
                                 echo   '<td>'. $row['Opening'] .'</td>';
                                 echo   '<td>'. $row['Position'] .'</td>';  
                                 echo   '<td>'. $row['Company'] .'</td>';  
                                 echo   '<td>'. $row['Expire'] .'</td>';  
                                  echo   '<td>'. $row['Salary'] .'</td>'; 
                                 echo   '<td><span class="rem-action btn btn-danger" data-record-id="'. $row['ID'] .'">remove</span></td>';   
                                 echo '</tr>';
                           }
                        }
                           ?>
                           <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmed_id'])) {
    $recordId = $_POST['confirmed_id'];
    
    $dbConnection = new mysqli('localhost', 'root', '', 'itjobs');
    
    if ($dbConnection->connect_error) {
        die("Connection failed: " . $dbConnection->connect_error);
    }
    
    $sql = "DELETE  FROM jobpost WHERE ID = $recordId";
    
    if ($dbConnection->query($sql) === TRUE) {
      $deletionSuccess = true;
  } else {
      $deletionError = true;
  }
}
    

 
?>
    <script src="jquery/dist/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
    $('.rem-action').on('click', function() {
        var $row = $(this).closest('tr'); 
        
        var recordId = $(this).data('record-id');
        var confirmation = confirm("Do you really want to remove the job post?");
        
        if (confirmation) {
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'confirmed_id';
            input.value = recordId;
            
            var form = document.createElement('form');
            form.method = 'post';
            form.action = ''; 
            form.appendChild(input);
            
            document.body.appendChild(form);
            form.submit();
        }
    });
});
</script>
<?php if (isset($deletionSuccess) && $deletionSuccess): ?>
    <div class="success-message" style="color:green">Record deleted successfully</div>
    <script>
        setTimeout(function() {
            $('.success-message').fadeOut('slow', function() {
                $(this).remove();
            });
        }, 2000);
        var deletedRecordId = "<?php echo $recordId; ?>";
        var rowToDelete = $("td:contains('" + deletedRecordId + "')").closest("tr");
        
        rowToDelete.fadeOut("slow", function() {
            $(this).remove();
        }); 
    </script>
<?php
 elseif (isset($deletionError) && $deletionError): ?>
    <div class="error-message">Error deleting record</div>
<?php endif; ?>
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