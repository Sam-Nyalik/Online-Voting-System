<!-- ELECTION OFFICER REGISTRATION-->

<?php

//Error handlers
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Functions & database connection
include_once "./functions/functions.php";
$pdo = databaseConnection();

// Define variables and assign them empty values
$fullName = $emailAddress = $password = $confirmPassword = "";
$fullName_error = $emailAddress_error = $password_error = $confirmPassword_error = "";

// Process form data when the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate fullName
    if (empty(trim($_POST["fullName"]))) {
        $fullName_error = "Field is required!";
    } else {
        $fullName = trim($_POST["fullName"]);
    }

    // Validate emailAddress
    if (empty(trim($_POST["emailAddress"]))) {
        $emailAddress_error = "Field is required!";
    } else {
        //Check if the emailAddress input already exists
        $sql = "SELECT * from electionOfficer WHERE emailAddress = :email";
        //Prepared statement
        if($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            // Set parameters
            $param_email = trim($_POST["emailAddress"]);
            // Attempt to execute
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    $emailAddress_error = "Email address is already taken!";
                } else {
                    $emailAddress = trim($_POST["emailAddress"]);
                }
            }
        }
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_error = "Field is required!";
    } else if (strlen(trim($_POST["password"])) < 6) {
        $password_error = "Passwords must have more than 6 characters!";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirmPassword
    if (empty(trim($_POST["confirmPassword"]))) {
        $confirmPassword_error = "Field is required!";
    } else {
        $confirmPassword = trim($_POST["confirmPassword"]);

        // Check if passwords match
        if (empty($password_error) && $password !== $confirmPassword) {
            $confirmPassword_error = "Passwords do not match!";
        }
    }

    // Check for errors before dealing with the database
    if (empty($fullName_error) && empty($emailAddress_error) && empty($password_error) && empty($confirmPassword_error)) {
        // Prepare an INSERT statement
        $sql = "INSERT INTO electionOfficer(fullName, emailAddress, password) VALUES(:fullName, :emailAddress, :password)";

        // Prepared statement
        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":fullName", $param_fullName, PDO::PARAM_STR);
            $stmt->bindParam(":emailAddress", $param_emailAddress, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);

            // Set parameters
            $param_fullName = $fullName;
            $param_emailAddress = $emailAddress;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            // Attempt to execute
            if ($stmt->execute()) {
                // Redirect user to the login page
                header("location: index.php?page=electionOfficer/login");
                exit;
            } else {
                echo "There was a problem, please try again!";
            }
        }

        //Close the statement
        unset($stmt);
    }
}

?>

<!-- Header Template -->
<?= headerTemplate('ELECTION OFFICER | REGISTER'); ?>

<!-- Navbar Template -->
<?= navbarTemplate(); ?>

<!-- Breadcrumb -->
<div class="breadcrumb">
    <div class="container">
        <div class="row">
            <span><a href="index.php?page=home">Home</a> > <a href="index.php?page=electionOfficer/login">Election Commission Officer Login</a> > Election Commission Officer Register</span>
        </div>
    </div>
</div>

<!-- Login Section -->
<div class="form">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <!-- Title -->
                <h3>Election Officer Register</h5>
                    <p>Register to become an election commission officer</p>
                    <hr>

                    <!-- Login Form -->
                    <form action="index.php?page=electionOfficer/register" method="post" class="login-form">
                        <!-- FullName -->
                        <div class="form-group my-2">
                            <label for="fullName">FullName:</label>
                            <input type="text" name="fullName" class="form-control <?php echo (!empty($fullName_error)) ? 'is-invalid' : ''; ?>" value="<?php echo $fullName ?>">
                            <span class="errors text-danger"><?php echo $fullName_error; ?></span>
                        </div>

                        <!-- Email Address -->
                        <div class="form-group my-2">
                            <label for="EmailAddress">Email Address:</label>
                            <input type="email" name="emailAddress" class="form-control <?php echo (!empty($emailAddress_error)) ? 'is-invalid' : ''; ?>" value="<?php echo $emailAddress; ?>">
                            <span class="errors text-danger"><?php echo $emailAddress_error; ?></span>
                        </div>

                        <div class="row">
                            <!-- Password -->
                            <div class="col-6">
                                <div class="form-group my-2">
                                    <label for="password">Password:</label>
                                    <input type="password" name="password" class="form-control <?php echo (!empty($password_error)) ? 'is-invalid' : ''; ?>">
                                    <span class="errors text-danger"><?php echo $password_error; ?></span>
                                </div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="col-6">
                                <div class="form-group my-2">
                                    <label for="ConfirmPassword">Confirm Password:</label>
                                    <input type="password" name="confirmPassword" class="form-control <?php echo (!empty($confirmPassword_error)) ? 'is-invalid' : ''; ?>">
                                    <span class="errors text-danger"><?php echo $confirmPassword_error; ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Registration btn -->
                        <div class="form-group my-3">
                            <input type="submit" class="btn w-100 text-center" value="Register">
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>