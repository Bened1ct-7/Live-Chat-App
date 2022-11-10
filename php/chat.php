<?php
session_start();
require_once "../config/database.php";

$table_query = "SELECT msg_id FROM messages LIMIT 1";
if ($conn->query($table_query) == false) {
  $query = "CREATE TABLE messages (
    msg_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    incoming_id INT(11) NOT NULL,
    outgoing_id INT(11) NOT NULL,
    message TEXT NOT NULL,
    msg_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

  if (!$conn->query($query)) {
    echo("Failed: " . mysqli_error($conn) . "<br>");
    die();
  }

}

$message = filter_var($_POST['message'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$outgoing_id = filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT);
$incoming_id = filter_var($_POST['chat_id'], FILTER_SANITIZE_NUMBER_INT);

if (!empty($message)) {
  $sql = "INSERT INTO messages (incoming_id, outgoing_id, message) VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')";
  if ($conn->query($sql)) {
    echo "success";
  }
}
