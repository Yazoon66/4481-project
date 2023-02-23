<?php
session_start(); // Start a new or resume an existing session
include_once("config.php"); // Include the configuration file that sets up a connection to the database

$outgoing_id = $_SESSION['unique_id']; // get the id of the user who initiated the search
$searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']); // get the search term entered by the user and escape special characters

$sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} AND (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%') "; // build the SQL query to search for users in the database
$output = ""; // initialize the output variable
$query = mysqli_query($conn, $sql); // execute the query and get the result set

if(mysqli_num_rows($query) > 0){ // if users are found in the database
    include_once("data.php"); // include a file to format and display the search results
} else{
    $output .= 'No user found related to your search term'; // if no users are found, set the output message
}
echo $output; // output the search results or message
?>
