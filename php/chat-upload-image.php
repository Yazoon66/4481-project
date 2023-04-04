<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include_once "config.php";

if (isset($_POST["incoming_id"]) && isset($_FILES["image"])) {
    $incoming_id = mysqli_real_escape_string($conn, $_POST["incoming_id"]);
    $img_name = basename($_FILES["image"]["name"]);
    $tmp_name = $_FILES["image"]["tmp_name"];

    $img_explode = explode(".", $img_name);
    $img_ext = end($img_explode);

    $extensions = ["png", "jpeg", "jpg", "pdf"];
    if (in_array($img_ext, $extensions) === true) {
        echo "File extension is valid";
        $time = time();
        $new_img_name = $time . $img_name;

        if (move_uploaded_file($tmp_name, "images/" . $new_img_name)) {
            echo "File moved successfully";
            $from_id = $_SESSION["unique_id"];
            $message = "<a target='_blank' href='php/images/" . $new_img_name . "'>" . $img_name . "</a>";

            $message = mysqli_real_escape_string($conn, $message);

            $sql = "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg) VALUES ('{$incoming_id}', '{$from_id}', '{$message}')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo "File uploaded successfully";
            } else {
                echo "Failed to send file. Error: " . mysqli_error($conn);
            }
        } else {
            echo "Error uploading file. Check file permissions.";
        }
    } else {
        echo "Please select a file - jpeg, jpg, png, pdf";
    }
} else {
    echo "Required parameters missing";
}
?>
