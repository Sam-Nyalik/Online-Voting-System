<!-- UVC CODES -->
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
<?= headerTemplate('ELECTION OFFICER | UVC'); ?>

<!-- Navbar Template -->
<?= dashboardNavbarTemplate(); ?>

<!-- Breadcrumb -->
<div class="breadcrumb">
    <div class="container">
        <div class="row">
            <span><a href="index.php?page=electionOfficer/dashboard">Dashboard</a> > UVC Code</span>
        </div>
    </div>
</div>

<!-- Page heading -->
<div class="page-heading text-center">
    <div class="container">
        <div class="row">
            <h3>UNIQUE VOTER CODES</h3>
        </div>
    </div>
</div>

<!-- UVC table list -->
<div class="table_list">
    <div class="container">
        <div class="row">
            <table class="table table-bordered">
                <!-- Fetch UVC codes from the database -->
                <?php
                $sql = $pdo->prepare("SELECT * FROM uvc");
                $sql->execute();
                $database_uvc = $sql->fetchAll(PDO::FETCH_ASSOC);
                $num = 1;
                ?>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Code</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($database_uvc as $uvc_codes) : ?>
                        <td><?= $num++ ?></td>
                        <td><?= $uvc_codes["code"]; ?></td>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Link to the addition of a new UVC code -->
<div class="add">
    <div class="container w-50">
        <div class="row">
            <a href="index.php?page=electionOfficer/add_uvc">Add a UVC Code</a>
        </div>
    </div>
</div>

<!-- Footer Template -->
<?= footerTemplate(); ?>