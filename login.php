<!DOCTYPE html>
<html lang="en">
<head>
    <title>EECS 4481-project</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>
<body>
    <div class="wrapper">
        <section class="form login">
            <header>Realtime Chat App</header>
     <form action="#">
         <div class="error-text"></div>
            <div class="field input">
                <label>Email Address</label>
               <input type="text" name="email" placeholder="Enter your email">
            </div>
            <div class="field input">
                <label>password</label>
               <input type="password" name="password" placeholder="Enter your password">
               <i class="fas fa-eye"></i>
            </div>
         <div class="field button">
             <input type="submit" value="Continue to Chat">
         </div>
     </form>
     <div class="link">Not yet signed up? <a href="index.php">Signup now</a></div>
        </section>
    </div>
    <script src="javascript/pass-show-hide.js">
    <script src="javascript/login.js">
    </script>
</body>
</html>