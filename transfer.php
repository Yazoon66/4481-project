<?php
// Start a new session or resume an existing session
session_start();
include_once "php/config.php";

// Redirect to login page if user is not logged in
if (!isset($_SESSION['unique_id'])) {
    header("location: login.php");
    exit(); // stop executing code
}

// Get user details from database
$user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");

if (mysqli_num_rows($sql) <= 0) {
    header("location: users.php");
    exit(); // stop executing code
}

$row = mysqli_fetch_assoc($sql);

// Include header HTML
include_once "header.php";

$outgoing_id = $_SESSION['unique_id']; // get the ID of the user who is sending the message
$incoming_id = mysqli_real_escape_string($conn, $_GET['user_id']); // get the ID of the user who is receiving the message
$message = mysqli_real_escape_string($conn, "You have been transfered, <a href='chat.php?user_id=326272693292916'>please click here</a>");

if (!empty($message)) { // check if the message is not empty
    $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
                                VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')") or die(); // insert the message into the database
}

?>

<body>
    <div class="wrapper">
        <section class="chat-area">
            <div class="chat-box">
<?php echo "Thank you, you have sent a transfer"?>
            </div>
        </section>
    </div>

    <script src="javascript/chat.js"></script>
</body>

</html>
