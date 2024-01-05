<!-- CONSTITUENCIES -->
<!-- Table to display constituencies -->
<!-- Link to add a constituency -->

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
<?= headerTemplate('ELECTION OFFICER | CONSTITUENCY'); ?>

<!-- Navbar Template -->
<?= dashboardNavbarTemplate(); ?>

<!-- Breadcrumb -->
<div class="breadcrumb">
    <div class="container">
        <div class="row">
            <span><a href="index.php?page=electionOfficer/dashboard">Dashboard</a> > Constituency</span>
        </div>
    </div>
</div>

<!-- Constituency table list -->
<div class="table_list">
    <div class="container">
        <div class="row">
            <table class="table table-bordered">
                <!-- Fetch coinstituencies from the database -->
                <?php
                $sql = $pdo->prepare("SELECT * FROM constituency");
                $sql->execute();
                $database_query = $sql->fetchAll(PDO::FETCH_ASSOC);
                $num = 1;

                ?>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Constituency Name</th>
                    </tr>
                </thead>

                <?php foreach ($database_query as $query) : ?>
                    <tbody>
                            <td><?= $num++ ?></td>
                            <td><?= $query["name"]; ?></td>
                    </tbody>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>

<!-- Link to the addition of a new constituency -->
<div class="add">
    <div class="container w-50">
        <div class="row">
            <a href="index.php?page=electionOfficer/addConstituency">Add Constituency</a>
        </div>
    </div>
</div>

<!-- Footer Template -->
<?= footerTemplate(); ?>