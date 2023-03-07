<?php
session_start(); // Start a new or resume an existing session
include_once "config.php"; // Include the configuration file that sets up a connection to the database
$outgoing_id = $_SESSION['unique_id']; // Gets the ID of the current user from the session
$sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} and fname != '' and status = 'Active now' ORDER BY user_id DESC"; // SQL query to retrieve all users except the current user, ordered by user ID in descending order
$query = mysqli_query($conn, $sql); // Performs the SQL query using the database connection
$output = ""; // Initializes the output variable
if(mysqli_num_rows($query) == 0) { // Checks if there are no rows returned by the query
    $output .= "No users are available."; // Sets the output to a message indicating that no users are available
} elseif(mysqli_num_rows($query) > 0) { // Checks if there are rows returned by the query
    include_once "data.php"; // Includes a file to generate the user list
}
echo $output; // Prints the output variable to the screen
?>
