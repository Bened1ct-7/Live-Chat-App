<?php
session_start();
require_once "../config/database.php";
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE NOT user_id = {$user_id}";
$result = $conn->query($sql);
$output = '';
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $query = "SELECT * FROM messages WHERE incoming_id = {$row['user_id']} AND outgoing_id = {$user_id} OR outgoing_id = {$row['user_id']} AND incoming_id = {$user_id} ORDER BY msg_id DESC LIMIT 1";
    $sql3 = "SELECT * FROM messages WHERE incoming_id = {$row['user_id']} AND outgoing_id = {$user_id} OR outgoing_id = {$row['user_id']} AND incoming_id = {$user_id} ORDER BY msg_id DESC LIMIT 1";
    
    $msg = $you = "";
    $message = "No messages available";
    
    if ($conn->query($sql3) != false) {
      $result1 = $conn->query($query);
      if ($result1->num_rows > 0) {
        $msg = $result1->fetch_assoc();
        $message = (strlen($msg['message']) > 28)?substr($msg['message'], 0, 28):$msg['message'];
        $you = ($msg['outgoing_id'] == $user_id)? "You:": "";
       } else {
          $message = "No messages available";
       }
    }
    
    $online = ($row['online'] == 1)? "online-status":"online-status offline";
    $output .= '<div id="'. $row['user_id'] .'" class="user">
            <a href="user-profile.php?id='.$row['user_id'].'" class="profile-pic me-1">
              <img src="img/'. $row['avatar'] .'" ; alt="user">
              <i class="fa-solid fa-circle '. $online .'"></i>
            </a>
            <a href="chat.php?id='.$row['user_id'].'" class="details ms-2">
              <div class="username">'. $row['username'] .'</div>
              <div class="text-muted">'.$you. " ".$message.'</div>
            </a>
          </div>';
  }
} else {
  $output .= '<div class="text-center">No user available</div>';
}
echo $output;
