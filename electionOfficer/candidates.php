<!-- ELECTIONS CANDIDATES -->

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
<?= headerTemplate('ELECTION OFFICER | CANDIDATES'); ?>

<!-- Navbar Template -->
<?= dashboardNavbarTemplate(); ?>

<!-- Breadcrumb -->
<div class="breadcrumb">
    <div class="container">
        <div class="row">
            <span><a href="index.php?page=electionOfficer/dashboard">Dashboard</a> > Candidates</span>
        </div>
    </div>
</div>

<!-- Page heading -->
<div class="page-heading text-center">
    <div class="container">
        <div class="row">
            <h3>ELECTION CANDIDATES</h3>
        </div>
    </div>
</div>

<!-- Candidate table list -->
<div class="table_list">
    <div class="container">
        <div class="row">
            <table class="table table-bordered">
                <!-- Fetch election candidates from the database -->
                <?php
                $sql = $pdo->prepare("SELECT * FROM candidate");
                $sql->execute();
                $database_election_candidate = $sql->fetchAll(PDO::FETCH_ASSOC);
                $num = 1;
                ?>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Candidate Name</th>
                        <th>Political Party</th>
                        <th>Constituency</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <?php foreach ($database_election_candidate as $election_candidate) : ?>
                    <tbody>
                        <td><?= $num++; ?></td>
                        <td><?= $election_candidate["fullName"]; ?></td>
                        <td><?= $election_candidate["politicalParty"]; ?></td>
                        <td><?= $election_candidate["constituency"]; ?></td>
                        <td></td>
                    </tbody>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>

<!-- Link to the addition of a new candidate -->
<div class="add">
    <div class="container w-50">
        <div class="row">
            <a href="index.php?page=electionOfficer/addCandidate">Add Candidate</a>
        </div>
    </div>
</div>

<!-- Footer template -->
<?= footerTemplate(); ?>