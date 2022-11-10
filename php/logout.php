<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: ../signin.php");
}

if (!isset($_GET['id'])) {
  header("Location: ../index.php");
}

require_once "../config/database.php";
$id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
$zero = 0;
$sql = "UPDATE users SET online = {$zero} WHERE user_id = {$id}";
if ($conn->query ($sql)) {
  header("Location: ../signin.php");
}
