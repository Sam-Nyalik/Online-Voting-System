<!-- ROUTES -->
<?php 

session_start();

// Functions
include_once "./functions/functions.php";
$pdo = databaseConnection();

// Page routes (Making home.php the dafult page)
$page = isset($_GET['page']) && file_exists($_GET['page'] . '.php') ? $_GET['page'] : 'home';

// Include and show the requested page
include_once $page . ".php";

?>