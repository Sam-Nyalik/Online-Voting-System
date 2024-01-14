<!-- CANDIDATE ELECTION RESULTS PER CONSTITUENCY -->

<?php

// Start session
session_start();

// Check login
if (!isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] !== true) {
    header("location: index.php?page=electionOfficer/login");
    exit;
}


// Functions and database connection
include_once "./functions/functions.php";
$pdo = databaseConnection();

// Fetch the name of the constituency from the database
$constituency_id = false;
if (isset($_GET['constituencyId'])) {
    $constituency_id = $_GET["constituencyId"];

    $sql = $pdo->prepare("SELECT * FROM elections WHERE constituency_id = ?");
    $sql->execute([$constituency_id]);
    while ($row = $sql->fetch()) {
        $constituency_name = $row["constituency"];
    }
}

?>

<!-- Header Template -->
<?= headerTemplate('ELECTION OFFICER | POLLS'); ?>

<!-- Navbar Template -->
<?= dashboardNavbarTemplate(); ?>

<!-- Breadcrumb -->
<div class="breadcrumb">
    <div class="container">
        <div class="row">
            <span><a href="index.php?page=electionOfficer/dashboard">Dashboard</a> > <a href="index.php?page=electionOfficer/election_results">Election results</a> > Election Results Per Constituency</span>
        </div>
    </div>
</div>

<!-- Page heading -->
<div class="page-heading text-center">
    <div class="container">
        <div class="row">
            <h3><?php echo $constituency_name; ?> CONSTITUENCY</h3>
        </div>
    </div>
</div>

<!-- Candidate Election results per constituency table list  -->
<div class="table_list">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Candidate Name</th>
                            <th>Political Party</th>
                            <th>Vote Count</th>
                        </tr>
                    </thead>
                    <!-- Fetch candidate details -->
                    <?php
                    $candidate_sql = $pdo->prepare("SELECT *, SUM(vote_count) as totalVotes FROM elections WHERE constituency_id = ? GROUP BY constituency");
                    $candidate_sql->execute([$constituency_id]);
                    $database_candidate_sql = $candidate_sql->fetchAll(PDO::FETCH_ASSOC);
                    $num = 1;
                    ?>

                    <?php foreach ($database_candidate_sql as $candidate_details) : ?>
                        <tbody>
                            <td><?= $num++; ?></td>
                            <td><?= $candidate_details['candidateName']; ?></td>
                            <td><?= $candidate_details['politicalParty']; ?></td>
                            <td><?= $candidate_details['vote_count']; ?></td>
                        </tbody>
                    <?php endforeach; ?>
                </table>
            </div>

            <!-- Chart -->
            <div class="col-md-6">
                <canvas id="candidateChart"></canvas>

                <script>
                    var csx = document.getElementById("candidateChart").getContext('2d');

                    var data = <?php echo json_encode($database_candidate_sql); ?>;

                    var labels = data.map(function(item) {
                        return item.candidateName;
                    });

                    var values = data.map(function(item) {
                        return item.totalVotes;
                    });

                    var colors = [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                    ]

                    var charData = {
                        labels: labels,
                        datasets: [{
                            label: 'Candidate Results',
                            data: values,
                            backgroundColor: colors,
                            borderColor: '#094d4d',
                            borderWidth: 1
                        }]
                    };

                    var options = {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    };

                    var myChart = new Chart(csx, {
                        type: 'bar',
                        data: charData,
                        options: options
                    });
                </script>
            </div>
        </div>
    </div>
</div>

<!-- Winner -->
<div class="totals">
    <div class="container">
        <div class="row">
            <!-- Fetch the candidate with the most votes -->
            <?php
            $query = $pdo->prepare("SELECT * FROM elections WHERE constituency_id = ? AND vote_count = (SELECT MAX(vote_count) FROM elections WHERE constituency_id = ?) LIMIT 1");
            $query->execute([$constituency_id, $constituency_id]);
            $winner = $query->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <?php foreach ($winner as $election_winner) :
                if ($election_winner["status"] > 0 && $election_winner["status"] == 1) {
            ?>
                    <h3 style="font-size: 20px;">Election winner: <span style="color: #800000;">Pending</span></h3>
                <?php  } else if ($election_winner["vote_count"] == 0) { ?>
                    <h3 style="font-size: 20px;">Election winner: <span style="color: #800000;">None</span></h3>
                <?php } else { ?>
                    <h3 style="font-size: 20px;">Election winner: <span style="color: #800000;"><?= $election_winner["candidateName"] ?></span></h3>
                <?php }
                ?>

            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Footer template -->
<?= footerTemplate(); ?>