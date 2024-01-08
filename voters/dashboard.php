<!-- VOTER DASHBOARD -->

<!-- Navbar -->
<!-- Welcome message -->
<!-- header template -->
<!-- Footer template -->
<!-- Polls/elections -->
<!-- Vote -->

<?php

// Start session
session_start();

// Error handling
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check login
include_once "includes/check_login.php";

// Functions and database connection
include_once "functions/functions.php";
$pdo = databaseConnection();

?>

<!-- Header Template -->
<?= headerTemplate('VOTER | DASHBOARD'); ?>


<!-- Dashbord Navbar -->
<?= voterNavbarTemplate(); ?>

<!-- Footer template -->
<?= footerTemplate(); ?>

<!-- Page heading -->
<div class="page-heading text-center">
    <div class="container">
        <div class="row">
            <h3>Voter's Dashboard</h3>
        </div>
    </div>
</div>

<!-- Welcome text -->
<div class="welcome-text">
    <div class="container">
        <div class="row">
            <!-- Fetch voter's name from the database based on the session id -->
            <?php
            $id = false;
            if (isset($_SESSION["id"]) && $_SESSION["loggedIn"] == true) {
                $id = $_SESSION["id"];

                // Prepare a SELECT statement
                $sql = $pdo->prepare("SELECT * FROM voters WHERE voterId = $id");
                $sql->execute();
                $database_voter_details = $sql->fetchAll(PDO::FETCH_ASSOC);
            }
            ?>
            <?php foreach ($database_voter_details as $voter_details) : ?>
                <h5>Welcome, <?= $voter_details["fullName"]; ?></h5>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Dashboard cards -->
<div class="dashboard-cards">
    <div class="container">
        <div class="row">
            <div class="col-md-6 card">
                <h5>Polls <br><span><a href="index.php?page=voters/polls">View more</a></span></h5>
            </div>
            <div class="col-md-6 card">
                <h5>Election Results <br><span><a href="index.php?page=voters/election_results">View more</a></span></h5>
            </div>
        </div>
    </div>
</div>