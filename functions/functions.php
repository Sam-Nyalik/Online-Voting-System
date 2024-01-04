<!-- SYSTEM FUNCTIONS -->
<!-- Header Template -->
<!-- Footer Template -->


<?php 

// Database Connection
function databaseConnection(){

    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASSWORD = '';
    $DATABASE_NAME = 'votingSystem';

    // Try connrcting to the database, otherwise generate an error
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
        <link rel=\"stylesheet\" type=\"style/css\" href=\"./css/styles.css\">
        <link rel=\"stylesheet\" href=\"./css/bootstrap.min.css\">
        </head>
    ";
    echo $element;
}

