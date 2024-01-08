<!-- ADD POLITICAL PARTY -->

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

// Define variables and assign them empty values
$partyName = "";
$partyName_error = "";

// Process form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty(trim($_POST["partyName"]))) {
        $partyName_error = "Field is required!";
    } else {
        // Check if the name already exists
        $sql = "SELECT * FROM politicalParty WHERE name = :name";
        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":name", $param_name, PDO::PARAM_STR);
            $param_name = trim($_POST["partyName"]);
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    $partyName_error = "Name already exists!";
                } else {
                    $partyName = trim($_POST["partyName"]);
                }
            }
        }

        unset($stmt);
    }

    //Check for errors before dealing with the database
    if (empty($partyName_error)) {
        // Prepare an INSERT statement
        $sql = "INSERT INTO politicalParty(name) VALUES(:partyName)";
        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":partyName", $param_partyName, PDO::PARAM_STR);
            $param_partyName = $partyName;
            if ($stmt->execute()) {
                // Added successfully
                header("location: index.php?page=electionOfficer/politicalParty");
            } else {
                echo "There was an error. please try again!";
            }
        }

        unset($stmt);
    }
}

?>

<!-- Header Template -->
<?= headerTemplate('ELECTION OFFICER | ADD POLITICAL PARTY'); ?>

<!-- Navbar Template -->
<?= dashboardNavbarTemplate(); ?>

<!-- Breadcrumb -->
<div class="breadcrumb">
    <div class="container">
        <div class="row">
            <span><a href="index.php?page=electionOfficer/dashboard">Dashboard</a> > <a href="index.php?page=electionOfficer/politicalParty">Political party</a> > Add political party</span>
        </div>
    </div>
</div>

<!-- Add constituency form -->
<div class="form">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <h3>Add a political party</h3>
                <hr>

                <!-- Form -->
                <form action="index.php?page=electionOfficer/addPoliticalParty" method="post" class="login-form">
                    <!-- Name -->
                    <div class="form-group my-3">
                        <label for="Name">Name</label>
                        <input type="text" name="partyName" class="form-control 
                        <?php echo (!empty($partyName_error)) ? 'is-invalid' : ''; ?>" value="<?php echo $partyName; ?>">
                        <span class="errors text-danger"><?php echo $partyName_error; ?></span>
                    </div>

                    <!-- Submit btn -->
                    <div class="form-group my-3">
                        <input type="submit" value="Add party" class="btn w-100">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Footer Template -->
<?= footerTemplate(); ?>