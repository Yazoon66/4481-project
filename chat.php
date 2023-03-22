<?php
// Start a new session or resume an existing session
session_start();
include_once "php/config.php";

// Redirect to login page if user is not logged in
if (!isset($_SESSION["unique_id"])) {
    header("location: login.php");
    exit(); // stop executing code
}

// Get user details from database
$user_id = mysqli_real_escape_string($conn, $_GET["user_id"]);
$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");

if (mysqli_num_rows($sql) <= 0) {
    header("location: users.php");
    exit(); // stop executing code
}

$row = mysqli_fetch_assoc($sql);

// Include header HTML
include_once "header.php";
?>

<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
<?php if ($_SESSION["is_guest"] === 0) { ?>
                <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
<?php } ?>
                <img src="php/images/<?php echo $row["img"]; ?>" alt="">
                <div class="details">
                    <span><?php echo $row["fname"] .
                        " " .
                        $row["lname"]; ?></span>
                    <p><?php echo $row["status"]; ?></p>
                </div>
<?php if ($_SESSION["is_guest"] === 1) { ?>
    <a href="php/logout.php" class="logout" style='float:right'>Close</a>
<?php } else { ?>
    <a href="transfer.php?user_id=<?php echo $row['unique_id']?>" class="logout" style='float:right'>Transfer</a>
<?php } ?>
            </header>
            <div class="chat-box">

            </div>
            <form action="#" class="typing-area">
                <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
                <button><i class="fab fa-telegram-plane"></i></button>
            </form>

            <form action="#" method="POST" enctype="multipart/form-data" class="image-upload-form" autocomplete="off">
                <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                <input type="file" name="image" class="image-upload" accept="image/x-png,image/gif,image/jpeg,image/jpg">
                <input type="submit" name="submit" value="Upload Image">
            </form>

            
        </section>
    </div>

    <script src="javascript/chat.js"></script>
</body>

</html>


