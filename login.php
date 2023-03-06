<?php 
  // Start a new session or resume an existing session
  session_start();
  
  // If the user is already logged in, redirect them to the users.php page
  if(isset($_SESSION['unique_id'])){
    header("location: users.php");
    exit();
  }
?>

<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="form login">
      <header>EECS 4481-project</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" placeholder="Enter your email" required>
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter your password" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Continue to Chat">
        </div>
      </form>
      <div class="link">Need to create a help desk login? <a href="index.php">Signup now</a></div>
      <div class="link">Want to join as a Guest?<a href="guest.php">Join Chat here</a></div>
    </section>
  </div>
  
  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/login.js"></script>

</body>
</html>
