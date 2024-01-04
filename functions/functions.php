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
