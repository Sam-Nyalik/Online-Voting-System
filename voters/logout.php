<!-- VOTER LOGOUT -->

<?php

// Start session
session_start();

// Destroy session
$_SESSION = array();
session_destroy();

// Redirect user to the login page
header("location: index.php?page=voters/login");
exit;

?>