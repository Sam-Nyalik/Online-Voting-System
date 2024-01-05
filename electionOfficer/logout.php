<!-- ELECTION OFFICER LOGOUT -->

<?php 

// Start session
session_start();

// Destroy sessions
$_SESSION = array();
session_destroy();

// Redirect user to the login page
header("location: index.php?page=electionOfficer/login");
exit;

?>