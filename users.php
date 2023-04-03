<?php
// Start a new session or resume an existing session
session_start();

// Include the configuration file
include_once "php/config.php";

// Redirect to login page if user is not logged in
if (!isset($_SESSION['unique_id']) || $_SESSION["is_guest"] !== 0) {
    header("location: login.php");
}
?>

<?php include_once "header.php"; ?>

<body>
    <div class="wrapper">
        <section class="users">
            <header>
                <div class="content">
                    <?php
                    // Retrieve user details from the database
                    $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
                    if (mysqli_num_rows($sql) > 0) {
                        $row = mysqli_fetch_assoc($sql);
                    }
                    ?>
                    <img src="php/images/<?php print_r(htmlspecialchars($row['img'], ENT_QUOTES, 'UTF-8')) ?>" alt="">
                    <div class="details">
                        <span><?php print_r(htmlspecialchars($row['fname']. " " . $row['lname'], ENT_QUOTES, 'UTF-8')); ?></span>
                        <p><?php print_r(htmlspecialchars($row['status'], ENT_QUOTES, 'UTF-8')); ?></p>
                    </div>
                </div>
                <!-- deleted logout_id at the end to protect sensitive user id -->
                <a href="php/logout.php" class="logout">Logout</a>
            </header>
            <div class="search">
                <span class="text">Select a user to start chat</span>
                <input type="text" placeholder="Enter name to search...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="users-list"></div>
        </section>
    </div>

    <script src="javascript/users.js"></script>

</body>
</html>
