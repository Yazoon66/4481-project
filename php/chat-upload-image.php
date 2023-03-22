<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include_once "config.php";

if (isset($_POST["incoming_id"]) && isset($_FILES["image"])) {
    $incoming_id = mysqli_real_escape_string($conn, $_POST["incoming_id"]);
    $img_name = $_FILES["image"]["name"];
    $tmp_name = $_FILES["image"]["tmp_name"];

    $img_explode = explode(".", $img_name);
    $img_ext = end($img_explode);

    $extensions = ["png", "jpeg", "jpg"];
    if (in_array($img_ext, $extensions) === true) {
        echo "Image extension is valid";
        $time = time();
        $new_img_name = $time . $img_name;

        if (move_uploaded_file($tmp_name, "php/images/" . $new_img_name)) {
            echo "Image moved successfully";
            $from_id = $_SESSION["unique_id"];
            $message = "<img src='images/" . $new_img_name . "' alt='Image'>";

            $sql = "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg) VALUES ('{$incoming_id}', '{$from_id}', '{$message}')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo "Image uploaded successfully";
            } else {
                echo "Failed to send image. Error: " . mysqli_error($conn);
            }
        } else {
            echo "Error uploading image. Check file permissions.";
        }
    } else {
        echo "Please select an image file - jpeg, jpg, png";
    }
} else {
    echo "Required parameters missing";
}
?>
