<!-- ADD UVC CODE -->

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

//Define variables and assign them empty values
$uvc = "";
$uvc_error = "";

// Process form data when the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate UVC Code
    if (empty(trim($_POST["uvc_code"]))) {
        $uvc_error = "Field is required!";
    } else {
        // Check if the UVC input already exists
        $sql = "SELECT * FROM uvc WHERE code = :uvc_code";
        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":uvc_code", $param_uvc, PDO::PARAM_STR);
            $param_uvc = trim($_POST["uvc_code"]);
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    // UVC already exists, generate an error
                    $uvc_error = "This code already exists!";
                } else {
                    $uvc = trim($_POST["uvc_code"]);
                }
            }
        }

        unset($stmt);
    }

    // Check for errors before dealing with the database
    if (empty($uvc_error)) {
        // Prepare an INSERT statement
        $sql = "INSERT INTO uvc(code) VALUES(:uvc_code)";
        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":uvc_code", $param_uvc_code, PDO::PARAM_STR);
            // Set parameters
            $param_uvc_code = $uvc;
            // Attempt to execute
            if ($stmt->execute()) {
                // Redirect user to the uvc page
                header("location: index.php?page=electionOfficer/uvc");
                exit;
            } else {
                echo "There was an error, please try again!";
            }
        }

        unset($stmt);
    }
}



?>

<!-- Header Template -->
<?= headerTemplate('ELECTION OFFICER | ADD UVC'); ?>

<!-- Navbar Template -->
<?= dashboardNavbarTemplate(); ?>

<!-- Breadcrumb -->
<div class="breadcrumb">
    <div class="container">
        <div class="row">
            <span><a href="index.php?page=electionOfficer/dashboard">Dashboard</a> > <a href="index.php?page=electionOfficer/uvc">UVC Codes</a> > Add UVC Code</span>
        </div>
    </div>
</div>

<!-- Add UVC Code form -->
<div class="form">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <h3>Add a UVC Code</h3>
                <hr>

                <!-- Form -->
                <form action="index.php?page=electionOfficer/add_uvc" method="post" class="login-form">
                    <!-- Code -->
                    <div class="form-group my-2">
                        <label for="UVC Code">Unique Verification Code</label>
                        <input type="text" name="uvc_code" class="form-control <?php echo (!empty($uvc_error)) ? 'is-invalid' : ''; ?>">
                        <span class="errors text-danger"><?php echo $uvc_error; ?></span>
                    </div>

                    <!-- Submit btn -->
                    <div class="form-group my-3">
                        <input type="submit" value="Add Code" class="btn w-100">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>