<?php 
session_start(); // Start a new or resume an existing session

include_once "config.php"; // Include the configuration file that sets up a connection to the database

$email = mysqli_real_escape_string($conn, $_POST['email']); // Sanitize and store the email submitted via POST
$password = mysqli_real_escape_string($conn, $_POST['password']); // Sanitize and store the password submitted via POST

if(!empty($email) && !empty($password)){ // If email and password are not empty
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'"); // Query the database to find the user with the submitted email
    if(mysqli_num_rows($sql) > 0){ // If the query returns at least one row
        $row = mysqli_fetch_assoc($sql); // Fetch the result as an associative array
        $user_pass = md5($password); // Hash the submitted password using md5
        $enc_pass = $row['password']; // Get the hashed password stored in the database for the user
        if($user_pass === $enc_pass){ // If the hashed password from the form matches the hashed password from the database
            $status = "Active now"; // Set the user's status to "Active now"
            $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}"); // Update the user's status in the database
            if($sql2){ // If the query was successful
                $_SESSION['unique_id'] = $row['unique_id']; // Set the unique ID of the user as a session variable
                $_SESSION["is_guest"] = 0;
                echo "success"; // Return the success message to the AJAX call
            } else {
                echo "Something went wrong. Please try again!"; // Return an error message to the AJAX call
            }
        } else {
            echo "Email or Password is Incorrect!"; // Return an error message to the AJAX call
        }
    } else {
        echo "$email - This email does not exist!"; // Return an error message to the AJAX call
    }
} else {
    echo "All input fields are required!"; // Return an error message to the AJAX call
}
?>
