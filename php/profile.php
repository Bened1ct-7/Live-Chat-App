<?php
session_start();
require_once "../config/database.php";
$id = filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT);

$sql = "SELECT * FROM users WHERE user_id = {$id}";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$bio = filter_var($_POST['bio'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$avatar = $_FILES['avatar'];
$prev_avatar = $row['avatar'];

if (!empty($firstname) && !empty($lastname) && !empty($bio)) {
  if ($avatar['size'] > 0) {
    $time = time();
    $img_name = $time.$avatar['name'];
    $tmp_name = $avatar['tmp_name'];
    $explode = explode('.', $img_name);
    $ext = end($explode);
    $exts = ['jpg', 'jpeg', 'png'];
    if (in_array($ext, $exts)) {
      if ($avatar['size'] < 1000000) {
        if (unlink('../img/'.$prev_avatar)) {
          if (move_uploaded_file($tmp_name, '../img/'.$img_name)) {
            $pic = $img_name;
          }
        } else {
          echo "Couldn't update image";
        }
      } else {
        echo "File must be less than 1MB";
      }
    } else {
      echo "Upload an image in png, jpg, or jpeg format";
    }
  }
  $new_avatar = $pic ?? $prev_avatar;
  $query = "UPDATE users SET firstname = '{$firstname}', lastname = '{$lastname}', bio = '{$bio}', avatar = '{$new_avatar}' WHERE user_id = {$id}";
  if ($conn->query($query)) {
    echo "success";
  } else {
    echo "Could not update profile";
  }
} else {
  echo "All fields are required";
}