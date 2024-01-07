<!-- POLITICAL PARTY -->

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
<?= headerTemplate('ELECTION OFFICER | POLITICAL PARTY'); ?>

<!-- Navbar Template -->
<?= dashboardNavbarTemplate(); ?>

<!-- Breadcrumb -->
<div class="breadcrumb">
    <div class="container">
        <div class="row">
            <span><a href="index.php?page=electionOfficer/dashboard">Dashboard</a> > Political party</span>
        </div>
    </div>
</div>

<!-- Page heading -->
<div class="page-heading text-center">
    <div class="container">
        <div class="row">
            <h3>POLITICAL PARTIES</h3>
        </div>
    </div>
</div>

<!-- Political party list -->
<div class="table_list">
    <div class="container">
        <div class="row">
            <table class="table table-bordered">
                <!-- Fetch political parties from the database -->
                <?php
                $sql = $pdo->prepare("SELECT * FROM politicalParty");
                $sql->execute();
                $database_political_party = $sql->fetchAll(PDO::FETCH_ASSOC);
                $num = 1;
                ?>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Party Name</th>
                    </tr>
                </thead>
                <?php foreach ($database_political_party as $political_party) : ?>
                    <tbody>
                        <td><?= $num++ ?></td>
                        <td><?= $political_party["name"]; ?></td>
                    </tbody>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>

<!-- Link to the addition of a new political party -->
<div class="add">
    <div class="container w-50">
        <div class="row">
            <a href="index.php?page=electionOfficer/addPoliticalParty">Add a Political Party</a>
        </div>
    </div>
</div>

<!-- Footer Template -->
<?= footerTemplate(); ?>