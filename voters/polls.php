<!-- VOTING PAGE -->

<!-- Navbar -->
<!-- HeaderTemplate -->
<!-- Sessions -->
<!-- Check login -->
<!-- FooterTemplate -->
<!-- Functions -->
<!-- Form -->
<!-- Display message if there are no elections -->

<?php

// Start session
session_start();

// Functions page and database connection
include_once "functions/functions.php";
$pdo = databaseConnection();

?>

<!-- Header Template -->
<?= headerTemplate('VOTER | POLLS'); ?>

<!-- Voter Navbar Template -->
<?= voterNavbarTemplate(); ?>

<!-- Breadcrumb -->
<div class="breadcrumb">
    <div class="container">
        <div class="row">
            <span><a href="index.php?page=voters/dashboard">Dashboard</a> > Polls</span>
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

<!-- Votes Casting Table -->
<div class="table_list">
    <div class="container">
        <div class="row">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Candidate name</th>
                        <th>Political Party</th>
                        <th>Constituency</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>


<!-- Footer Template -->
<?= footerTemplate(); ?>