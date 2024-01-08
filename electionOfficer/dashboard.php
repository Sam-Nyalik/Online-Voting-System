<!-- ELECTION OFFICER DASHBOARD -->

<?php

// Start session
session_start();

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check login
include_once "includes/check_login.php"; 

// Functions & database connection
include_once "./functions/functions.php";
$pdo = databaseConnection();

?>

<!-- Header Template -->
<?= headerTemplate('ELECTION OFFICER | DASHBOARD'); ?>

<!-- Navbar Template -->
<?= dashboardNavbarTemplate(); ?>

<!-- Page heading -->
<div class="page-heading text-center">
    <div class="container">
        <div class="row">
            <h3>Election Commission Officer Dashboard</h3>
        </div>
    </div>
</div>

<!-- Welcome Text -->
<div class="welcome-text">
    <div class="container">
        <div class="row">
            <!-- Get the name of the user from  the database -->
            <?php 
                $id = false;
                if(isset($_SESSION["id"]) && $_SESSION["loggedIn"] == true){
                    $id = $_SESSION["id"];

                    // Prepare a SELECT statement
                    $sql = $pdo->prepare("SELECT * FROM electionOfficer WHERE id = $id");
                    $sql->execute();
                    $database_query = $sql->fetchAll(PDO::FETCH_ASSOC);
                }
            ?>
           <?php foreach($database_query as $query): ?>
                 <h5>Welcome, <?=$query["fullName"];?></h5>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Dashboard cards -->
<div class="dashboard-cards">
    <div class="container">
        <div class="row">
            <div class="col-md-3 card">
                <h5>Polls <br><span><a href="index.php?page=electionOfficer/polls">View more</a></span></h5>
            </div>
            <div class="col-md-3 card">
                <h5>Candidates <br><span><a href="index.php?page=electionOfficer/candidates">View more</a></span></h5>
                <!-- <a href="#">View more</a> -->
            </div>
            <div class="col-md-3 card">
                <h5>Constituencies <br><span><a href="index.php?page=electionOfficer/constituency">View more</a></span></h5>
                <!-- <a href="#">View more</a> -->
            </div>
            <div class="col-md-3 card">
                <h5>Registered Voters <br><span><a href="index.php?page=electionOfficer/voters">View more</a></span></h5>
                <!-- <a href="#">View more</a> -->
            </div>
        </div>

        <div class="row my-2">
            <div class="col-md-3 card">
                <h5>Election Results <br><span><a href="#">View more</a></span></h5>
                <!-- <a href="#">View more</a> -->
            </div>
            <div class="col-md-3 card">
                <h5>UVC Codes <br><span><a href="index.php?page=electionOfficer/uvc">View more</a></span></h5>
            </div>
            <div class="col-md-3 card">
                <h5>Political parties <br><span><a href="index.php?page=electionOfficer/politicalParty">View more</a></span></h5>
            </div>
        </div>
    </div>
</div>

<!-- Footer Template -->
<?= footerTemplate(); ?>