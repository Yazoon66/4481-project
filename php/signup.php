<?php
session_start(); // Start a new or resume an existing session
include_once "config.php"; // Include the configuration file that sets up a connection to the database

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$password =  $_POST["password"];
$employee_id = $_POST["employee_id"];

if (
    !empty($fname) &&
    !empty($lname) &&
    !empty($email) &&
    !empty($password) &&
    !empty($employee_id)
) {
    // Check if employee_id is valid
    $stmt0 = $conn->prepare("SELECT unique_id FROM users WHERE unique_id = ?");
    $stmt0->bind_param("s", $employee_id);
    $stmt0->execute();
    $result0 = $stmt0->get_result();
    if ($result0->num_rows > 0) {
        // Check if email that the user inputted is valid or not.
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // If email is valid, check if email already exists in the database.
            $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                // If email address already exists, inform the user.
                echo "$email - this email already exists!";
            } else {
                // Check if user uploaded an image.
                if (isset($_FILES["image"])) {
                    // Check if file is uploaded.
                    $img_name = basename($_FILES["image"]["name"]);
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
                        if (
                            move_uploaded_file(
                                $tmp_name,
                                "./images/" . $new_img_name
                            )
                        ) {
                            // If user uploaded image is moved to our folder successfully,
                            // set user status to active and create a random ID for the user.
                            $status = "Active now";
                            $encrypt_pass = md5($password);
                            // Insert all user data inside the table.
                            $stmt2 = $conn->prepare("UPDATE users SET fname= ?, lname = ?, email = ?, `password` = ?, img = ?, `status` = ? WHERE `unique_id`=?");
                            $stmt2->bind_param("ssssssi", $fname, $lname, $email, $encrypt_pass, $new_img_name, $status, $employee_id);
                            $result1 = $stmt2->execute();
                          
                          
                            if ($result1) {
                                // If data is inserted successfully, fetch user data from the database.
                                $stmt3 = $conn->prepare("SELECT * FROM users WHERE email = ?");
                                $stmt3->bind_param("s", $email);
                                $stmt3->execute();
                                $result2 = $stmt3->get_result();
                                if ($result2->num_rows > 0) {
                                    $row =  $result2->fetch_assoc();
                                    // Use the user unique ID in other PHP files as well.
                                    $_SESSION["unique_id"] = $row["unique_id"];
                                    $_SESSION["is_guest"] = 0;
                                    echo "Success";
                                } else {
                                    echo "User insertion failed!";
                                }
                            } else {
                                echo "Something went wrong!";
                            }
                        } else {
                            echo "Error uploading image!";
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
        echo "Please enter a valid employee ID";
    }
} else {
    echo "All input fields are required";
}
?>
