<!-- DEFAULT HOMEPAGE -->
<!-- Header and footer templates -->
<!-- Links to the voters && the election commission officers login pages -->

<?php

// Functions
include_once "./functions/functions.php";
$pdo = databaseConnection();

?>

<!-- Header Template -->
<?= headerTemplate('HOME'); ?>


<!-- Navigation Bar -->
<?= navbarTemplate(); ?>

<!-- Welcome Text -->
<div class="welcome-text text-center">
    <div class="container">
        <div class="row">
            <h3>Welcome to our online voting platform</h3>
        </div>
    </div>
</div>

<!-- Account Links -->
<div class="account-links text-center">
    <div class="container">
        <div class="row">
            <!-- voter-link -->
            <div class="col-md-6">
                <a href="index.php?page=voters/login">Voters</a>
            </div>

            <!-- election-officer-link -->
            <div class="col-md-6">
                <a href="#">Election Commision Officer</a>
            </div>
        </div>
    </div>
</div>