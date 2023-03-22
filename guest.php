<?php

error_reporting( E_ALL );
ini_set('display_errors', '1');

session_start(); // Start a new or resume an existing session
include_once "php/config.php"; // Include the configuration file that sets up a connection to the database

$fname = "Guest";
$lname = "";
$email = "";
$password = "";

$status = "Active now";
$random_id = rand(time(), 1000000);

$new_img_name = "guest.jpg";

// Insert all user data inside the table.
$sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, is_guest, status) VALUES ({$random_id}, '{$fname}', '{$lname}', '{$email}', '{$encrypt_pass}', '{$new_img_name}', 1, '{$status}')");
if ($sql2) {
    // If data is inserted successfully, fetch user data from the database.
    $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$random_id}'");
    if (mysqli_num_rows($sql3) > 0) {
        $row = mysqli_fetch_assoc($sql3);
        // Use the user unique ID in other PHP files as well.
        $_SESSION["unique_id"] = $row["unique_id"];
        $_SESSION["is_guest"] = 1;

        $sql4 = mysqli_query($conn, "SELECT unique_id FROM users WHERE is_guest = 0 AND status='Active now'");

        $users = array();
        while ($row = mysqli_fetch_array($sql4)) {
            $users[] = $row;
        }

        $rnd = rand() % count($users);

        $rnduser = $users[$rnd];
        $unique_id = $rnduser['unique_id'];

        header("Location: chat.php?user_id=$unique_id");
    } else {
        echo "User insertion failed!";
    }
} else {
    echo "Something went wrong!";
}
