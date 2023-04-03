<?php 
session_start(); // Start a new or resume an existing session

include_once "config.php"; // Include the configuration file that sets up a connection to the database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nonce']) && $_POST['nonce'] === $_SESSION['nonce']) {
        if (isset($_POST["email"]) && isset($_POST['password'])) {
            $email = mysqli_real_escape_string($conn, $_POST['email']); // Sanitize and store the email submitted via POST
            $password = mysqli_real_escape_string($conn, $_POST['password']); // Sanitize and store the password submitted via POST
        }
    } else {
        echo "CSRF Attack!";
    }
}

if (!empty($email) && !empty($password)) { // If email and password are not empty
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?"); // Query the database to find the user with the submitted email
    $stmt->bind_param("s", $email); // The bind_param() method automatically escapes the user data and prevents SQL injection.
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){ // If the query returns at least one row
        $row = $result->fetch_assoc(); // Fetch the result as an associative array
        $enc_pass = $row['password']; // Get the hashed password stored in the database for the user
        if (password_verify($password, $enc_pass)) { // If the hashed password from the form matches the hashed password from the database
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
