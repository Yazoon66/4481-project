<?php
// Start a new session or resume an existing session
session_start();
include_once "php/config.php";
$_SESSION['nonce'] = bin2hex(random_bytes(16)); // Generate a new nonce token
// Redirect to login page if user is not logged in
if (!isset($_SESSION["unique_id"])) {
    header("location: login.php");
    exit(); // stop executing code
}

// Get user details from database using prepared statements
if (isset($_GET["user_id"])) { //if there isn't any users to star the chat, go to that user homepage
    $user_id = $_GET["user_id"];
    $stmt = $conn->prepare("SELECT * FROM users WHERE unique_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();  
    $result = $stmt->get_result();
}
if ($result->num_rows <= 0) {
    header("location: users.php");
    exit(); // stop executing code
}

$row = $result->fetch_assoc();

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
                <img src="php/images/<?php echo htmlspecialchars($row['img'], ENT_QUOTES, 'UTF-8'); ?>" alt="">
                <div class="details">
                    <span><?php echo htmlspecialchars($row['fname']. " " . $row['lname'], ENT_QUOTES, 'UTF-8');?></span>
                    <p><?php echo htmlspecialchars($row['status'], ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
<?php if ($_SESSION["is_guest"] === 1) { ?>
    <a href="php/logout.php" class="logout" style='float:right'>Close</a>
<?php } else { ?>
    <a href="transfer.php?user_id=<?php echo htmlspecialchars($row['unique_id'], ENT_QUOTES, 'UTF-8');?>" class="logout" style='float:right'>Transfer</a>
<?php } ?>
            </header>
            <div class="chat-box">

            </div>
            <form action="#" class="typing-area">
                <input type="hidden" name="nonce" value="<?php echo $_SESSION['nonce'] ?>">
                <input type="text" class="incoming_id" name="incoming_id" value="<?php echo htmlspecialchars($user_id, ENT_QUOTES, 'UTF-8'); ?>" hidden>
                <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
                <button><i class="fab fa-telegram-plane"></i></button>
            </form>

            <form action="#" method="POST" enctype="multipart/form-data" class="image-upload-form" autocomplete="off">
                <input type="hidden" name="nonce" value="<?php echo $_SESSION['nonce'] ?>">
                <input type="text" class="incoming_id" name="incoming_id" value="<?php echo htmlspecialchars($user_id, ENT_QUOTES, 'UTF-8'); ?>" hidden>
                <input type="file" name="image" class="image-upload" accept="image/x-png,image/gif,image/jpeg,image/jpg,.pdf">
                <input type="submit" name="submit" value="Upload File">
            </form>

            
        </section>
    </div>

    <script src="javascript/chat.js"></script>
</body>

</html>


