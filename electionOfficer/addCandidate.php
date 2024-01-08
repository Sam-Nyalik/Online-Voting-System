<!-- ADD A CANDIDATE -->

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

// Define variables and assign empty values
$candidateName = $politicalParty = $constituency = "";
$candidateName_error = $politicalParty_error = $constituency_error = "";

// Process form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate candidateName
    if (empty(trim($_POST["candidateName"]))) {
        $candidateName_error = "Field is required!";
    } else {
        $candidateName = trim($_POST["candidateName"]);
    }

    // Validate Political Party
    if (empty(trim($_POST["politicalParty"]))) {
        $politicalParty_error = "Field is required!";
    } else {
        $politicalParty = trim($_POST["politicalParty"]);
    }

    // Validate constituency
    if (empty(trim($_POST["constituency"]))) {
        $constituency_error = "Field is required!";
    } else {
        $constituency = trim($_POST["constituency"]);
    }

    // Check for errors before dealing with the database
    if (empty($candidateName_error) && empty($politicalParty_error) && empty($constituency_error)) {
        // Prepare an INSERT statement
        $sql = "INSERT INTO candidate(fullName, politicalParty, constituency) VALUES(:fullName, :politicalParty, :constituency)";
        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":fullName", $param_candidateName, PDO::PARAM_STR);
            $stmt->bindParam(":politicalParty", $param_politicalParty, PDO::PARAM_STR);
            $stmt->bindParam(":constituency", $param_constituency, PDO::PARAM_STR);
            // Set parameters
            $param_candidateName = $candidateName;
            $param_politicalParty = $politicalParty;
            $param_constituency = $constituency;
            // Attempt to execute
            if ($stmt->execute()) {
                // Redirect user to the candidate page
                header("location: index.php?page=electionOfficer/candidates");
                exit;
            } else {
                echo "There was an error. Please try again!";
            }
        }

        unset($stmt);
    }
}

?>

<!-- Header Template -->
<?= headerTemplate('ELECTION OFFICER | ADD CANDIDATE'); ?>

<!-- Navbar Template -->
<?= dashboardNavbarTemplate(); ?>

<!-- Breadcrumb -->
<div class="breadcrumb">
    <div class="container">
        <div class="row">
            <span><a href="index.php?page=electionOfficer/dashboard">Dashboard</a> > <a href="index.php?page=electionOfficer/candidates">Candidates</a> > Add Election Candidate</span>
        </div>
    </div>
</div>

<!-- Add candidate form -->
<div class="form">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <h3>Add an election candidate</h3>
                <hr>

                <!-- Form -->
                <form action="index.php?page=electionOfficer/addCandidate" method="post" class="login-form">
                    <!-- FullName -->
                    <div class="form-group my-2">
                        <label for="CandidateName">Candidate Fullname:</label>
                        <input type="text" name="candidateName" class="form-control <?php echo (!empty($candidateName_error)) ? 'is-invalid' : ''; ?>" value="<?php echo $candidateName; ?>">
                        <span class="errors text-danger"><?php echo $candidateName_error; ?></span>
                    </div>

                    <!-- Political Party -->
                    <div class="form-group my-2">
                        <label for="politicalParty">Political Party</label>
                        <!-- Fetch the political parties from the database -->
                        <?php
                        $sql = $pdo->prepare("SELECT * FROM politicalParty");
                        $sql->execute();
                        $database_political_party = $sql->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <select name="politicalParty" class="form-control <?php echo (!empty($politicalParty_error)) ? 'is-invalid' : ''; ?>">
                            <?php foreach ($database_political_party as $party) : ?>
                                <option value="<?= $party["name"]; ?>"><?= $party["name"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="errors text-danger"><?php echo $politicalParty_error; ?></span>
                    </div>

                    <!-- Constituency -->
                    <div class="form-group my-2">
                        <label for="constituency">Constituency</label>
                        <!-- Fetch constituencies from the database -->
                        <?php
                        $sql = $pdo->prepare("SELECT * FROM constituency");
                        $sql->execute();
                        $database_constituency = $sql->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <select name="constituency" class="form-control <?php echo (!empty($constituency_error)) ? 'is-invalid' : ''; ?>">
                            <?php foreach ($database_constituency as $constituency_name) : ?>
                                <option value="<?= $constituency_name["name"]; ?>"><?= $constituency_name["name"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="errors text-danger"><?php echo $constituency_error; ?></span>
                    </div>

                    <!-- Submit btn -->
                    <div class="form-group my-3">
                        <input type="submit" value="Add Candidate" class="btn w-100">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>