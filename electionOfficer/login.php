<!-- VOTER LOGIN -->

<?php

session_start();

// Error handling
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Functions & database connection
include_once "./functions/functions.php";
$pdo = databaseConnection();

// Define variables and assign them empty values
$emailAddress = $password = "";
$emailAddress_error = $password_error = "";

// Process form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate emailAddress
    if (empty(trim($_POST["emailAddress"]))) {
        $emailAddress_error = "Field is required!";
    } else {
        $emailAddress = trim($_POST["emailAddress"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_error = "Field is required!";
    } else {
        $password = trim($_POST["password"]);
    }

    // Check for errors before dealing with the database
    if (empty($emailAddress_error) && empty($password_error)) {
        // Prepare a SELECT statement
        $sql = "SELECT id, emailAddress, password FROM electionOfficer WHERE emailAddress = :email";

        // Prepared statement
        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            //Set parameters
            $param_email = $emailAddress;
            //Attempt to execute
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    //User exists
                    if ($row = $stmt->fetch()) {
                        $id = $row['id'];
                        $emailAddress = $row['emailAddress'];
                        $hashed_password = $row['password'];

                        // Verify the passwords
                        if (password_verify($password, $hashed_password)) {
                            //Passwords match
                            session_start();

                            // Store data in session variables
                            $_SESSION['loggedIn'] = true;
                            $_SESSION['id'] = $id;
                            $_SESSION['email'] = $emailAddress;

                            // Redirect user to the dashboard page
                            header("location: index.php?page=electionOfficer/dashboard");
                            exit;
                        } else {
                            $password_error = "Wrong password!";
                        }
                    }
                } else {
                    $emailAddress_error = "User does not exist!";
                }
            } else {
                echo "There was an error. Please try again!";
            }
        }

        //Close the prepared statement
        unset($stmt);
    }
}

?>

<!-- Header Template -->
<?= headerTemplate('ELECTION OFFICER | LOGIN'); ?>

<!-- Navbar Template -->
<?= navbarTemplate(); ?>

<!-- Breadcrumb -->
<div class="breadcrumb">
    <div class="container">
        <div class="row">
            <span><a href="index.php?page=home">Home</a> > Election Commission Officer Login</span>
        </div>
    </div>
</div>

<!-- Login Section -->
<div class="form">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <!-- Title -->
                <h3>Election Officer Login</h5>
                    <p>Login to your election commission officer account</p>
                    <hr>

                    <!-- Login Form -->
                    <form action="index.php?page=electionOfficer/login" method="post" class="login-form">
                        <!-- Email Address -->
                        <div class="form-group my-3">
                            <label for="EmailAddress">Email Address</label>
                            <input type="email" name="emailAddress" class="form-control <?php echo (!empty($emailAddress_error)) ? 'is-invalid' : ''; ?>" value="<?php echo $emailAddress; ?>">
                            <span class="errors text-danger"><?php echo $emailAddress_error; ?></span>
                        </div>

                        <!-- Password -->
                        <div class="form-group my-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control <?php echo (!empty($password_error)) ? 'is-invalid' : ''; ?>">
                            <span class="errors text-danger"><?php echo $password_error; ?></span>
                        </div>

                        <!-- Registration link -->
                        <!-- <div class="form-group my-3">
                            <a href="index.php?page=electionOfficer/register">New to this site?</a>
                        </div> -->

                        <!-- Login btn -->
                        <div class="form-group my-3">
                            <input type="submit" class="btn w-100 text-center" value="Login">
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>