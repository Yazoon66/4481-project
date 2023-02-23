<?php
// Loop through each row returned by the query
while ($row = mysqli_fetch_assoc($query)) {

    // Select the latest message between the current user and the target user
    $sql = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
            OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
            OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
    $query_msg = mysqli_query($conn, $sql);
    $msg_row = mysqli_fetch_assoc($query_msg);

    // If a message is found, display the first 28 characters, otherwise show "No message available"
    $msg = (mysqli_num_rows($query_msg) > 0) ? $msg_row['msg'] : "No message available";
    $short_msg = (strlen($msg) > 28) ? substr($msg, 0, 28) . '...' : $msg;

    // If the current user sent the message, show "You:", otherwise show an empty string
    if (isset($msg_row['outgoing_msg_id'])) {
        $you = ($outgoing_id == $msg_row['outgoing_msg_id']) ? "You: " : "";
    } else {
        $you = "";
    }

    // Set the status of the user to "offline" if they are currently offline
    $offline = ($row['status'] == "Offline now") ? "offline" : "";

    // Hide the user's message if it was sent by the current user
    $hid_me = ($outgoing_id == $row['unique_id']) ? "hide" : "";

    // Append the HTML for a user to the output string
    $output .= '<a href="chat.php?user_id=' . $row['unique_id'] . '">
                <div class="content">
                    <img src="php/images/' . $row['img'] . '" alt="">
                    <div class="details">
                        <span>' . $row['fname'] . " " . $row['lname'] . '</span>
                        <p>' . $you . $short_msg . '</p>
                    </div>
                </div>
                <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
            </a>';
}
?>
