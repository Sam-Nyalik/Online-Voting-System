<!-- ADD CONSTITUENCY -->

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
$constituencyName = "";
$constituencyName_error = "";

// Process form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty(trim($_POST["constituencyName"]))) {
        $constituencyName_error = "Field is required!";
    } else {
        // Check if the name already exists
        $sql = "SELECT * FROM constituency WHERE name = :name";
        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":name", $param_name, PDO::PARAM_STR);
            $param_name = trim($_POST["constituencyName"]);
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    $constituencyName_error = "Name already exists!";
                } else {
                    $constituencyName = trim($_POST["constituencyName"]);
                }
            }
        }

        unset($stmt);
    }

    //Check for errors before dealing with the database
    if (empty($constituencyName_error)) {
        // Prepare an INSERT statement
        $sql = "INSERT INTO constituency(name) VALUES(:constituencyName)";
        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":constituencyName", $param_constituencyName, PDO::PARAM_STR);
            $param_constituencyName = $constituencyName;
            if ($stmt->execute()) {
                // Added successfully
                header("location: index.php?page=electionOfficer/constituency");
            } else {
                echo "There was an error. please try again!";
            }
        }

        unset($stmt);
    }
}

?>

<!-- Header Template -->
<?= headerTemplate('ELECTION OFFICER | CONSTITUENCY'); ?>

<!-- Navbar Template -->
<?= dashboardNavbarTemplate(); ?>

<!-- Breadcrumb -->
<div class="breadcrumb">
    <div class="container">
        <div class="row">
            <span><a href="index.php?page=electionOfficer/dashboard">Dashboard</a> > <a href="index.php?page=electionOfficer/constituency">Constituency</a> > Add constituency</span>
        </div>
    </div>
</div>

<!-- Add constituency form -->
<div class="form">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <h3>Add a constituency</h3>
                <hr>

                <!-- Form -->
                <form action="index.php?page=electionOfficer/addConstituency" method="post" class="login-form">
                    <!-- Name -->
                    <div class="form-group my-3">
                        <label for="Name">Name</label>
                        <input type="text" name="constituencyName" class="form-control 
                        <?php echo (!empty($constituencyName_error)) ? 'is-invalid' : ''; ?>" value="<?php echo $constituencyName; ?>">
                        <span class="errors text-danger"><?php echo $constituencyName_error; ?></span>
                    </div>

                    <!-- Submit btn -->
                    <div class="form-group my-3">
                        <input type="submit" value="Add constituency" class="btn w-100">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>