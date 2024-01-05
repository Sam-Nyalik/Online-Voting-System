<!-- VOTER REGISTRATION -->

<?php

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Functions & database connection
include_once "./functions/functions.php";
$pdo = databaseConnection();

// Define variables and assign them empty values
$fullName = $emailAddress = $dateOfBirth = $constituency = $uvc = $password = $confirmPassword = "";
$fullName_error = $emailAddress_error = $dateOfBirth_error = $constituency_error = $uvc_error = $password_error = $confirmPassword_error = "";

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
        // Check if the email is already taken or not
        $sql = "SELECT * FROM voters WHERE emailAddress = :email";
        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $param_email = trim($_POST["emailAddress"]);
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    $emailAddress_error = "Email address already exists. Choose another one!";
                } else {
                    // Email address doesn't exist
                    $emailAddress = trim($_POST["emailAddress"]);
                }
            }
        }

        unset($stmt);
    }

    // Validate dateOfBirth
    if (empty(trim($_POST["dateOfBirth"]))) {
        $dateOfBirth_error = "Field is required!";
    } else {
        // Check the age of the user, voters must be 18 years and above
        $age = date_diff(date_create($_POST["dateOfBirth"]), date_create('today'))->y;

        if ($age < 18) {
            $dateOfBirth_error = "You are below 18 years, therefore you can't register as a voter!";
        } else {
            $dateOfBirth = trim($_POST["dateOfBirth"]);
        }
    }

    // Validate constituency
    if (empty(trim($_POST["constituency"]))) {
        $constituency_error = "Field is required!";
    } else {
        $constituency = trim($_POST["constituency"]);
    }

    // Unique Verification Code generator and Verification
    function generateUVC($length = 8)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $uvc = '';

        for ($i = 0; $i < $length; $i++) {
            $uvc .= $characters[mt_rand(0, strlen($characters) - 1)];
        }
        return $uvc;
    }
    $uvc = generateUVC(8);
    echo $uvc;

    $uvc_verification = "SELECT * FROM voters WHERE uvc = :uvc";
    if ($stmt = $pdo->prepare($uvc_verification)) {
        $stmt->bindParam(":uvc", $param_uvc_verification, PDO::PARAM_STR);
        $param_uvc_verification = $uvc;
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                $uvc_error = "The Unique Verification Code is already taken!";
            } else {
                $uvc = generateUVC(8);
                echo $uvc;
            }
        }
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_error = "Field is required!";
    } else if (strlen(trim($_POST["password"])) < 6) {
        $password_error = "Passwords must have at least 6 characters!";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirmPassword
    if (empty(trim($_POST["confirmPassword"]))) {
        $confirmPassword_error = "Field is required!";
    } else {
        $confirmPassword = trim($_POST["confirmPassword"]);

        // Check if the password and confirmPassword match
        if (empty($password_error) && $password !== $confirmPassword) {
            $confirmPassword_error = "Passwords do not match!";
        }
    }

    // Check for errors before dealing with the database
    if (empty($fullName_error) && empty($emailAddress_error) && empty($dateOfBirth_error) && empty($constituency_error) && empty($password_error)) {

        // Prepare an INSERT statement
        $sql = "INSERT INTO voters(fullName, emailAddress, dateOfBirth, constituency, uvc, password) VALUES(:fullName, :emailAddress, :dateOfBirth, :constituency, :uvc, :password)";
        // Prepare our sql query
        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":fullName", $param_fullName, PDO::PARAM_STR);
            $stmt->bindParam(":emailAddress", $Param_emailAddress, PDO::PARAM_STR);
            $stmt->bindParam(":dateOfBirth", $param_dateOfBirth, PDO::PARAM_STR);
            $stmt->bindParam(":constituency", $param_constituency, PDO::PARAM_STR);
            $stmt->bindParam(":uvc", $param_uvc, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            // Set parameters
            $param_fullName = $fullName;
            $Param_emailAddress = $emailAddress;
            $param_dateOfBirth = $dateOfBirth;
            $param_constituency = $constituency;
            $param_uvc = $uvc;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            // Attempt to execute
            if ($stmt->execute()) {
                // Redirect user to the login page
                header("location: index.php?page=voters/login");
                exit;
            } else {
                echo "There was an error. Please try again!";
            }
        }

        /* Unset prepared statement */
        unset($stmt);
    }
}

?>

<!-- Header Template -->
<?= headerTemplate('VOTER | REGISTER'); ?>

<!-- Navbar Template -->
<?= navbarTemplate(); ?>

<!-- Breadcrumb -->
<div class="breadcrumb">
    <div class="container">
        <div class="row">
            <span><a href="index.php?page=home">Home</a> > <a href="index.php?page=voters/login">Voter Login</a> > Voter Registration</span>
        </div>
    </div>
</div>

<!-- Login Section -->
<div class="form my-3">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <!-- Title -->
                <h3>Voter Registration</h5>
                    <p>Register to participate in the elections</p>
                    <hr>

                    <!-- Login Form -->
                    <form action="index.php?page=voters/register" method="post" class="login-form">
                        <!-- UVC ERROR -->
                        <?php if (!$uvc_error) : ?>
                            <span class="errors text-danger"><?= $uvc_error; ?></span>
                        <?php endif; ?>
                        <div class="row">
                            <!-- FullName -->
                            <div class="col-6">
                                <div class="form-group my-2">
                                    <label for="fullName">Full Name:</label>
                                    <input type="text" name="fullName" class="form-control <?php echo (!empty($fullName_error)) ? 'is-invalid' : ''; ?>" value="<?php echo $fullName; ?>">
                                    <span class="errors text-danger"><?php echo $fullName_error; ?></span>
                                </div>
                            </div>

                            <!-- Email Address -->
                            <div class="col-6">
                                <div class="form-group my-2">
                                    <label for="EmailAddress">Email Address</label>
                                    <input type="email" name="emailAddress" class="form-control <?php echo (!empty($emailAddress_error)) ? 'is-invalid' : ''; ?>" value="<?php echo $emailAddress; ?>">
                                    <span class="errors text-danger"><?php echo $emailAddress_error; ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- D.O.B -->
                            <div class="col-6">
                                <div class="form-group my-2">
                                    <label for="D.O.B">D.O.B</label>
                                    <input type="date" name="dateOfBirth" class="form-control <?php echo (!empty($dateOfBirth_error)) ? 'is-invalid' : ''; ?>" value="<?php echo $dateOfBirth; ?>">
                                    <span class="errors text-danger"><?php echo $dateOfBirth_error; ?></span>
                                </div>
                            </div>

                            <!-- Constituency -->
                            <div class="col-6">
                                <div class="form-group my-2">
                                    <label for="constituency">Constituency</label>
                                    <!-- Fetch constituency data from the database -->
                                    <?php
                                    $sql = $pdo->prepare("SELECT * FROM constituency");
                                    $sql->execute();
                                    $database_query = $sql->fetchAll(PDO::FETCH_ASSOC);
                                    ?>

                                    <select name="constituency" class="form-control <?php echo (!empty($constituency_error)) ? 'is-invalid' : ''; ?>">
                                        <?php foreach ($database_query as $query) : ?>
                                            <option value="<?= $query['name']; ?>"><?= $query["name"]; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="errors text-danger"><?php echo $constituency_error; ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Password -->
                            <div class="col-6">
                                <div class="form-group my-2">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control <?php echo (!empty($password_error)) ? 'is-invalid' : ''; ?>">
                                    <span class="errors text-danger"><?php echo $password_error; ?></span>
                                </div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="col-6">
                                <div class="form-group my-2">
                                    <label for="ConfirmPassword">Confirm Password</label>
                                    <input type="password" name="confirmPassword" class="form-control <?php echo (!empty($confirmPassword_error)) ? 'is-invalid' : ''; ?>">
                                    <span class="errors text-danger"><?php echo $confirmPassword_error; ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Login btn -->
                        <div class="form-group my-2">
                            <input type="submit" class="btn w-100 text-center" value="Login">
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>