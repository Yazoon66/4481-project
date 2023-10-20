<?php 
session_start(); // start a new or resume an existing session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['unique_id']) && (isset($_POST['nonce']) && $_POST['nonce'] === $_SESSION['nonce']) ) { // check if user is logged in and nonce verifed to prevent CSRF
        include_once "config.php"; // Include the configuration file that sets up a connection to the database
        $outgoing_id = $_SESSION['unique_id']; // get the ID of the user who is sending the message
        $incoming_id = mysqli_real_escape_string($conn, filter_var($_POST['incoming_id'], FILTER_SANITIZE_SPECIAL_CHARS));    // https://www.php.net/manual/en/filter.filters.sanitize.php
        $message = mysqli_real_escape_string($conn, filter_var($_POST['message'],FILTER_SANITIZE_SPECIAL_CHARS));
        // FILTER_SANITIZE_SPECIAL_CHARS is HTML-encode '"<>& and characters with ASCII value less than 32
        // if message contains <>'" and sent, it will encoded before store into the database 
        // but the client will not see the encoded message but original message
        if (!empty($message)) { 
            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
            VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')") or die(); // insert the message into the database
        }  
    } else {
        header("location: ../login.php"); // redirect to the login page if the user is not logged in
    }
}
?>
