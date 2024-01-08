<!-- SYSTEM FUNCTIONS -->
<!-- Header Template -->
<!-- Footer Template -->


<?php 

// Database Connection
function databaseConnection(){

    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASSWORD = '';
    $DATABASE_NAME = 'onlineVotingSystem';

    // Try connecting to the database, otherwise generate an error
    try {
        return new PDO("mysql:host=" . $DATABASE_HOST . ";dbname=" . $DATABASE_NAME . ";charset=utf8", $DATABASE_USER, $DATABASE_PASSWORD);
    } catch(PDOException $exception){
        exit("Connection to the database failed!" . $exception->getMessage());
    }
}


// Header Template
function headerTemplate($title){
    $element = "
        <!DOCTYPE html>
        <html lang=\"en\">
        <head>
        <title>$title</title>
        <meta charset=\"utf-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
        <meta name=\"keywords\" content=\"HTML5, PHP, MySQL, Javascript\">
        <meta name=\"description\" content=\"This is an online voting system\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <link rel=\"stylesheet\" type=\"text/css\" href=\"./css/styles.css\">
        <link rel=\"stylesheet\" href=\"./css/bootstrap.min.css\">
        <script src= \"https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js\"></script> 
        </head>
    ";
    echo $element;
}

// Navbar Template
function navbarTemplate(){
    $element = "
        <nav class=\"navbar\">
            <div class=\"container-fluid\">
                <a href=\"index.php?page=home\" class=\"navbar-brand mx-auto\">GEVS ONLINE VOTING SYSTEM</a>
            </div>
        </nav>
    ";
    echo $element;
}

// Dashboard Navbar Template
function dashboardNavbarTemplate(){
    $element = "
        <nav class=\"navbar navbar-expand-lg bg-body-tertiary\">
            <div class=\"container-fluid\">
                <a href=\"index.php?page=electionOfficer/dashboard\" class=\"navbar-brand\">GEVS ONLINE VOTING SYSTEM</a>
                <button class=\"navbar-toggler\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#navbarSupportedContent\" aria-controls=\"navbarSupportedContent\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
                    <span class=\"navbar-toggler-icon\"></span>
                </button>
             <div class=\"collapse navbar-collapse justify-content-end\" id=\"navbarSupportedContent\">
                <ul class=\"navbar-nav\">
                    <li class=\"nav-item\">
                        <a class=\"nav-link active\" aria-current=\"page\" href=\"#\">Dashboard</a>
                    </li>
                    <li class=\"nav-item dropdown\">
                        <a class=\"nav-link dropdown-toggle\" href=\"#\" role=\"button\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
                             Account
                        </a>
                        <ul class=\"dropdown-menu\">
                            <li><a class=\"dropdown-item\" href=\"index.php?page=electionOfficer/account\">Profile</a></li>
                            <li><a class=\"dropdown-item\" href=\"index.php?page=electionOfficer/logout\">Logout</a></li>
                        </ul>
                </li>
                </ul>
            </div>
        </div>
    </nav>

    ";  
    echo $element;
}

// Dashboard Navbar Template
function voterNavbarTemplate()
{
    $element = "
        <nav class=\"navbar navbar-expand-lg bg-body-tertiary\">
            <div class=\"container-fluid\">
                <a href=\"index.php?page=electionOfficer/dashboard\" class=\"navbar-brand\">GEVS ONLINE VOTING SYSTEM</a>
                <button class=\"navbar-toggler\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#navbarSupportedContent\" aria-controls=\"navbarSupportedContent\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
                    <span class=\"navbar-toggler-icon\"></span>
                </button>
             <div class=\"collapse navbar-collapse justify-content-end\" id=\"navbarSupportedContent\">
                <ul class=\"navbar-nav\">
                    <li class=\"nav-item\">
                        <a class=\"nav-link active\" aria-current=\"page\" href=\"#\">Dashboard</a>
                    </li>
                    <li class=\"nav-item dropdown\">
                        <a class=\"nav-link dropdown-toggle\" href=\"#\" role=\"button\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
                             Account
                        </a>
                        <ul class=\"dropdown-menu\">
                            <li><a class=\"dropdown-item\" href=\"index.php?page=voters/account\">Profile</a></li>
                            <li><a class=\"dropdown-item\" href=\"index.php?page=voters/logout\">Logout</a></li>
                        </ul>
                </li>
                </ul>
            </div>
        </div>
    </nav>

    ";
    echo $element;
}


// Footer Template
function footerTemplate(){
    $element = " 
        <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js\" > </script> 
        <script src=\"https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js\" ></script> 
        <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js\" integrity=\"sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM\" crossorigin=\"anonymous\"></script>
        <script src=\"https://unpkg.com/aos@2.3.1/dist/aos.js\"></script>
        <script src=\"https://maps.googleapis.com/maps/api/js?key=AIzaSyCYiduC0VtcteVlIGb7pVZCW4rQIA0EQbY&callback=myMap&libraries=&v=weekly\" async></script>
    ";
    echo $element;
}
