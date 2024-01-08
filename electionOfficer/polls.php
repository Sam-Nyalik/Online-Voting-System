<!-- ELECTION POLLS -->

<?php

// Start session
session_start();

// Check login
include_once "includes/check_login.php";

// Functions and database connection
include_once "./functions/functions.php";
$pdo = databaseConnection();

?>


<!-- Header Template -->
<?= headerTemplate('ELECTION OFFICER | POLLS'); ?>

<!-- Navbar Template -->
<?= dashboardNavbarTemplate(); ?>

<!-- Breadcrumb -->
<div class="breadcrumb">
    <div class="container">
        <div class="row">
            <span><a href="index.php?page=electionOfficer/dashboard">Dashboard</a> > Election Polls</span>
        </div>
    </div>
</div>

<!-- Page heading -->
<div class="page-heading text-center">
    <div class="container">
        <div class="row">
            <h3>ELECTION POLLS</h3>
        </div>
    </div>
</div>

<!-- Election polls table list -->
<div class="table_list">
    <div class="container">
        <div class="row">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Candidate Name</th>
                        <th>Party Name</th>
                        <th>Constituency Name</th>
                        <th>Status</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Link to the creation of a new poll -->
<div class="add">
    <div class="container w-50">
        <div class="row">
            <a href="index.php?page=electionOfficer/addPoll">Add Poll</a>
        </div>
    </div>
</div>

<!-- Footer Template -->
<?= footerTemplate(); ?>