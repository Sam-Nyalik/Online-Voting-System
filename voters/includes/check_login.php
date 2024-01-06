<?php

if (!isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] !== true) {
	//Redirect user to the login page
	header("location: index.php?page=voters/login");
	exit;
}
