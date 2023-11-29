<?php
session_start();
echo '<script>alert("123")</script>';
// Destroy the session to log the user out
session_destroy();
session_unset();

// Redirect the user back to the login page (index.php)
header("Location: index.php");
exit();
?>