<!-- Check if the admin is already logged in, otherwise redirect to the login page -->

<?php

if (!isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] !== true) {
    header("location: index.php?page=electionOfficer/login");
    exit;
}

?>