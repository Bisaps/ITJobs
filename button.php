
<script src="jquery/dist/jquery.min.js"></script>
<?php
session_start();

function isUserLoggedIn() {
    return isset($_SESSION['user_id']) && $_SESSION['user_id'] != "";
}

$loggedIn = isUserLoggedIn();

header("Content-Type: application/json");
echo json_encode(array("loggedIn" => $loggedIn));
exit();
?>
