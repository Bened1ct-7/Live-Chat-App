<?php
session_start();
require_once "../config/database.php";

$outgoing_id = filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT);
$incoming_id = filter_var($_POST['chat_id'], FILTER_SANITIZE_NUMBER_INT); 

$sql = "SELECT * FROM messages LEFT JOIN users ON messages.outgoing_id = users.user_id WHERE incoming_id = {$incoming_id} AND outgoing_id = {$outgoing_id} OR incoming_id = {$outgoing_id} AND outgoing_id = {$incoming_id} ORDER BY messages.msg_id";
$output = '';
if ($conn->query($sql) != false) {
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    if ($row['outgoing_id'] == $outgoing_id) {
      $output.= "<div class='outgoing my-2'>
          <div class='message shadow-sm p-2'>
            ".$row['message']."
            <span class='text d-block'>".date("H:i A", strtotime($row['msg_time']))."</span>
          </div>
        </div>";
    } else {
      $output.="<div class='incoming my-2'>
          <img class='me-1' src='img/".$row['avatar']."' alt='user'>
          <div class='message shadow-sm ms-1 p-2'>
            ".$row['message']."
            <span class='text-muted d-block'>".date("H:i A", strtotime($row['msg_time']))."</span>
          </div>
        </div>";
    }
  }
} else {
  $output.= '<div class="text-center d-flex align-items-center justify-content-center" style="min-height: 400px;"><span>No messages available. Start a chat</span></div>';
}
} else {
  $output.= '<div class="text-center d-flex align-items-center justify-content-center" style="min-height: 400px;"><span>No messages available. Start a chat</span></div>';
}
echo $output;
