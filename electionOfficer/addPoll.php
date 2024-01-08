<!-- CREATE ELECTION POLL -->

<?php

// Start session
session_start();

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check login
include_once "includes/check_login.php";

// Functions and database connection
include_once "./functions/functions.php";
$pdo = databaseConnection();


?>

<!-- Header Template -->
<?= headerTemplate('ELECTION OFFICER | ADD ELECTION POLL'); ?>

<!-- Navbar Template -->
<?= dashboardNavbarTemplate(); ?>

<!-- Breadcrumb -->
<div class="breadcrumb">
    <div class="container">
        <div class="row">
            <span><a href="index.php?page=electionOfficer/dashboard">Dashboard</a> > <a href="index.php?page=electionOfficer/polls">Election Polls</a> > Add Election Poll</span>
        </div>
    </div>
</div>

<!-- Add Election poll form -->
<div class="form">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <h3>Create Election Poll</h3>
                <hr>

                <!-- Form -->
                <form action="#" method="post" class="login-form">
                    <!-- Candidate Select -->
                    <!-- Fetch candidate name from the database -->
                    <?php
                    $sql = $pdo->prepare("SELECT fullName FROM candidate");
                    $sql->execute();
                    $database_candidate_fullName = $sql->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <div class="form-group my-2">
                        <label for="candidateSelect">Select Candidate:</label>
                        <select name="candidateSelect" id="candidateSelect" class="form-control">
                            <option value="Select candidate" disabled>Select candidate</option>
                            <?php foreach ($database_candidate_fullName as $candidate_fullName) : ?>
                                <option value="<?= $candidate_fullName["fullName"]; ?>"><?= $candidate_fullName["fullName"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Political Party Name -->
                    <div class="form-group my-2">
                        <label for="partyName">Party Name:</label>
                        <input type="text" name="partyName" class="form-control" readonly>
                    </div>

                    <!-- Constituency Name -->
                    <div class="form-group my-2">
                        <label for="constituencyName">Constituency Name:</label>
                        <input type="text" name="constituencyName" class="form-control" readonly>
                    </div>

                    <!-- Submit btn -->
                    <div class="form-group my-3">
                        <input type="submit" value="Create Election" class="btn w-100">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Footer Template -->
<?= footerTemplate(); ?>