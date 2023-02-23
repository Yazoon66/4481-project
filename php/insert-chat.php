<?php 
session_start(); // start a new or resume an existing session

if (isset($_SESSION['unique_id'])) { // check if user is logged in
    include_once "config.php"; // Include the configuration file that sets up a connection to the database

    $outgoing_id = $_SESSION['unique_id']; // get the ID of the user who is sending the message
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']); // get the ID of the user who is receiving the message
    $message = mysqli_real_escape_string($conn, $_POST['message']); // get the message from the POST request and escape special characters for use in a SQL query

    if (!empty($message)) { // check if the message is not empty
        $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
                                    VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')") or die(); // insert the message into the database
    }
} else {
    header("location: ../login.php"); // redirect to the login page if the user is not logged in
}
?>
