<!-- ELECTION RESULTS -->

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

?>

<!-- Header Template -->
<?= headerTemplate('ELECTION OFFICER | ELECTION RESULTS'); ?>

<!-- Navbar Template -->
<?= dashboardNavbarTemplate(); ?>

<!-- Breadcrumb -->
<div class="breadcrumb">
    <div class="container">
        <div class="row">
            <span><a href="index.php?page=electionOfficer/dashboard">Dashboard</a> > Election Results</span>
        </div>
    </div>
</div>

<!-- Page heading -->
<div class="page-heading text-center">
    <div class="container">
        <div class="row">
            <h3>ELECTION RESULTS</h3>
        </div>
    </div>
</div>

<!-- Totals -->
<div class="totals" style="margin: 45px 0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Fetch the total number of registered voters-->
                <?php
                $total_registered_voters = $pdo->prepare("SELECT * FROM voters");
                $total_registered_voters->execute();
                $number_of_voters = $total_registered_voters->rowCount();
                ?>
                <h3 style="font-size: 20px">Total number of registered voters: <span style="color: #800000;"><?php echo $number_of_voters; ?></span></h3>

                <!-- Fetch the total number of votes casted in the elections-->
                <?php
                $total_casted_votes = $pdo->prepare("SELECT * FROM voters WHERE vote_status = 1");
                $total_casted_votes->execute();
                $number_of_votes = $total_casted_votes->rowCount();
                ?>
                <h3 style="font-size: 20px">Total number of votes casted in the elections: <span style="color: #800000;"><?php echo $number_of_votes; ?></span></h3>

                <hr>
            </div>
        </div>
    </div>
</div>

<!-- Election results table list -->
<div class="table_list">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <!-- Fetch election details-->
                    <?php
                    $sql = $pdo->prepare("SELECT *, SUM(vote_count) AS totalVotes FROM elections GROUP BY constituency");
                    $sql->execute();
                    $database_elections_results = $sql->fetchAll(PDO::FETCH_ASSOC);
                    $num = 1;
                    ?>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Constituency Name</th>
                            <!-- <th>Number of registered voters</th> -->
                            <th>Candidate Name</th>
                            <th>Candidate Vote Count</th>
                            <!-- <th>Votes Casted</th> -->
                            <th>Action</th>
                        </tr>
                    </thead>
                    <?php foreach ($database_elections_results as $elections_results) : ?>
                        <tbody>
                            <td><?= $num++; ?></td>
                            <td><?= $elections_results["constituency"]; ?></td>
                            <!-- Get the number of registerd voters based on the constituency
                        <?php
                        $constituency_name = $elections_results["constituency"];
                        $registered_voters_sql = $pdo->prepare("SELECT * FROM voters WHERE constituency LIKE ?");
                        $registered_voters_sql->execute([$constituency_name]);
                        $row_count = $registered_voters_sql->rowCount();
                        ?>
                        <td><?= $row_count; ?></td> -->
                            <td><?= $elections_results["candidateName"]; ?></td>
                            <!-- <td><?= $elections_results["vote_count"]; ?></td> -->
                            <td><?= $elections_results["vote_count"]; ?></td>
                            <td><a href="index.php?page=electionOfficer/election_results_per_constituency&constituencyId=<?= $elections_results['constituency_id']; ?>" style="text-decoration: none"><span class="text-success">View More</span></a></td>
                        </tbody>
                    <?php endforeach; ?>
                </table>
            </div>

            <!-- Results Chart -->
            <div class="col-md-6">
                <canvas id="electionChart"></canvas>

                <script>
                    var ctx = document.getElementById("electionChart").getContext('2d');

                    var data = <?php echo json_encode($database_elections_results); ?>;

                    var labels = data.map(function(item) {
                        return item.constituency;
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
                            label: 'Election Results',
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

                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: charData,
                        options: options
                    });
                </script>
            </div>
        </div>
    </div>
</div>


<!-- Footer template -->
<?= footerTemplate(); ?>