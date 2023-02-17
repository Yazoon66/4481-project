<?php
    session_start();
    include_once "config.php";
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    
    if(!empty($email) && !empty($password)){
        //Check entered user's email and password
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}'");
        if(mysqli_num_rows($sql) > 0){ // Credentials matching
            $row = mysqli_fetch_assoc($sql);
            $_SESSION["unique_id"] = $row["unique_id"]; //using this session to use the user unique_id in other php files as well.
            echo "success";
        }else{
            echo "Email or Password is incorrect!";
        }
    } else {
        echo "All input fields are required!"
    }

?>