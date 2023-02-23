<?php 
session_start();

// Check if user is logged in
if(isset($_SESSION['unique_id'])){

    // Include configuration file and get the outgoing user ID from session
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];

    // Get incoming user ID from the POST request and escape the value
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);

    // Initialize output
    $output = "";

    // Query to get all messages between the two users
    $sql = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
            WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
            OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
    $query = mysqli_query($conn, $sql);

    // Check if there are messages in the query result
    if(mysqli_num_rows($query) > 0){

        // Loop through each row in the query result
        while($row = mysqli_fetch_assoc($query)){

            // Check if the outgoing user is the message sender
            if($row['outgoing_msg_id'] === $outgoing_id){
                $output .= '<div class="chat outgoing">
                            <div class="details">
                                <p>'. $row['msg'] .'</p>
                            </div>
                            </div>';

            // Otherwise, the incoming user is the message receiver
            }else{
                $output .= '<div class="chat incoming">
                            <img src="php/images/'.$row['img'].'" alt="">
                            <div class="details">
                                <p>'. $row['msg'] .'</p>
                            </div>
                            </div>';
            }
        }
    }else{
        // No messages are stored in the database
        $output .= '<div class="text">No messages are are stored in the database. Once you send messages they will appear here.</div>';
    }

    // Echo the output
    echo $output;

}else{
    // If user is not logged in, redirect to login page
    header("location: ../login.php");
}

?>