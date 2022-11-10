<?php
session_start();
require_once "../config/database.php";
$user = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$online = 1;

if (!empty($user) && !empty($password)) {
  $sql = "SELECT * FROM users WHERE email = '{$user}' OR username = '{$user}'";
  $result = $conn->query($sql);
  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
      $_SESSION['user_id'] = $row['user_id'];
      $query = "UPDATE users SET online = {$online} WHERE user_id = {$_SESSION['user_id']}";
      if ($conn->query($query)) {
        echo "success";
      }
    } else {
      echo "Incorrect details entered";
    }
  } else {
    echo "User not found";
  }
} else {
  echo "All fields are required";
}
