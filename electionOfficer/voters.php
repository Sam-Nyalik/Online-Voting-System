<!-- VOTERS -->

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
<?= headerTemplate('ELECTION OFFICER | VOTERS'); ?>

<!-- Navbar Template -->
<?= dashboardNavbarTemplate(); ?>

<!-- Breadcrumb -->
<div class="breadcrumb">
    <div class="container">
        <div class="row">
            <span><a href="index.php?page=electionOfficer/dashboard">Dashboard</a> > Voters</span>
        </div>
    </div>
</div>

<!-- Page heading -->
<div class="page-heading text-center">
    <div class="container">
        <div class="row">
            <h3>REGISTERED VOTERS</h3>
        </div>
    </div>
</div>

<!-- Voters table list -->
<div class="table_list">
    <div class="container">
        <div class="row">
            <table class="table table-bordered">
                <!-- Fetch voters from the database -->
                <?php
                $sql = $pdo->prepare("SELECT * FROM voters");
                $sql->execute();
                $database_voters = $sql->fetchAll(PDO::FETCH_ASSOC);
                $num = 1;
                ?>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Email Address</th>
                        <th>Constituency</th>
                        <th>Verification Code</th>
                    </tr>
                </thead>
                <?php foreach ($database_voters as $voters_data) : ?>
                    <tbody>
                        <td><?= $num++ ?></td>
                        <td><?= $voters_data["fullName"]; ?></td>
                        <td><?= $voters_data["emailAddress"]; ?></td>
                        <td><?= $voters_data["constituency"]; ?></td>
                        <td><?= $voters_data["uvc"]; ?></td>
                    </tbody>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>

<!-- Footer Template -->
<?= footerTemplate(); ?>