<!-- CONSTITUENCY RESULTS API -->

<?php

// Main function and database connection
include_once "../functions/functions.php";
$pdo = databaseConnection();

// Set headers 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');

// Check the requested method
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Fetch constituency data
    $sql = "SELECT * FROM elections";
    $result = $pdo->query($sql);

    // Check if there are results
    if ($result->rowCount() > 0) {

        // Initialize an array to store the data
        $data = [];

        // Fetch data
        $row = $result->fetchAll(PDO::FETCH_ASSOC);


        foreach ($row as $constituency_details) :
            // Construct an associative array for each row
            $result_data = [
                "constituency" => $constituency_details["constituency"],
                "result" => [
                    "name" => $constituency_details["candidateName"],
                    "party" => $constituency_details["politicalParty"],
                    "vote" => $constituency_details["vote_count"]
                ]
            ];

            // Add the data to the main array
            $data[] = $result_data;
            
        endforeach;


        // Convert the array to a JSON string
        $json_response = json_encode($data);

        echo $json_response;
    }
}
