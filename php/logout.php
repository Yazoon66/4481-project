<?php
session_start(); // Start a new or resume an existing session

if (isset($_SESSION['unique_id'])) { // if the user is logged in
    include_once "config.php"; // Include the configuration file that sets up a connection to the database
    $logout_id = $_SESSION['unique_id']; // get the ID of the user to log out

    if (isset($logout_id)) { // if the user ID is provided
        $status = "Offline now"; // set the user's status to offline
        $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id={$logout_id}"); // update the user's status in the database
        if ($sql) { // if the update was successful
            session_unset(); // remove all session variables
            session_destroy(); // destroy the session
            header("location: ../login.php"); // redirect to the login page
        }
    } else { // if the user ID is not provided
        header("location: ../users.php"); // redirect to the users page
    }
} else { // if the user is not logged in
    header("location: ../login.php"); // redirect to the login page
}
?>
