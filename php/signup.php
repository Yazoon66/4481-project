<?php
header("Access-Control-Allow-Origin: http://localhost/");
session_start(); // Start a new or resume an existing session
include_once "config.php"; // Include the configuration file that sets up a connection to the database

$fname = mysqli_real_escape_string($conn, $_POST["fname"]);
$lname = mysqli_real_escape_string($conn, $_POST["lname"]);
$email = mysqli_real_escape_string($conn, $_POST["email"]);
$password = mysqli_real_escape_string($conn, $_POST["password"]);

if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
    // Check if email that the user inputted is valid or not.
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // If email is valid, check if email already exists in the database.
        $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
        if (mysqli_num_rows($sql) > 0) {
            // If email address already exists, inform the user.
            echo "$email - this email already exists!";
        } else {
            // Check if user uploaded an image.
            if (isset($_FILES["image"])) {
                // Check if file is uploaded.
                $img_name = $_FILES["image"]["name"];
                $tmp_name = $_FILES["image"]["tmp_name"];

                // Get the extension of the user uploaded image.
                $img_explode = explode(".", $img_name);
                $img_ext = end($img_explode);

                $extensions = ["png", "jpeg", "jpg"]; // Array of valid image extensions.
                if (in_array($img_ext, $extensions) === true) {
                    // If the user uploaded image extension matches with valid extensions,
                    // add current time before the name of the user uploaded image to make it unique.
                    $time = time();
                    $new_img_name = $time . $img_name;
                    if (move_uploaded_file($tmp_name, "./images/" . $new_img_name)) {
                        // If user uploaded image is moved to our folder successfully,
                        // set user status to active and create a random ID for the user.
                        $status = "Active now";
                        $random_id = rand(time(), 1000000);
                        $encrypt_pass = md5($password);

                        // Insert all user data inside the table.
                        $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status) VALUES ({$random_id}, '{$fname}', '{$lname}', '{$email}', '{$encrypt_pass}', '{$new_img_name}', '{$status}')");
                        if ($sql2) {
                            // If data is inserted successfully, fetch user data from the database.
                            $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                            if (mysqli_num_rows($sql3) > 0) {
                                $row = mysqli_fetch_assoc($sql3);
                                // Use the user unique ID in other PHP files as well.
                                $_SESSION["unique_id"] = $row["unique_id"];
                            }
                        } else {
                            echo "Something went wrong!";
                        }
                    }
                } else {
                    echo "Please select an image file - jpeg, jpg, png!";
                }
            } else {
                echo "Please upload an image file!";
            }
        }
    } else {
        echo "$email is not a valid email";
    }
} else {
    echo "All input fields are required";
}
?>
