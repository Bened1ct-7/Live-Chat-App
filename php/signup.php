<?php
require_once "../config/database.php";

$table_query = "SELECT user_id FROM users LIMIT 1";
if ($conn->query($table_query) == false) {
  $query = "CREATE TABLE users (
    user_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    email VARCHAR(70) NOT NULL,
    username VARCHAR(20) NOT NULL,
    gender TINYINT(1) UNSIGNED NOT NULL,
    password VARCHAR(250) NOT NULL,
    avatar VARCHAR(255) NOT NULL,
    bio TEXT NOT NULL,
    online TINYINT(1) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

  if (!$conn->query($query)) {
    echo("Failed: " . mysqli_error($conn) . "<br>");
    die();
  }

}

$firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$gender = filter_var($_POST['gender'], FILTER_SANITIZE_NUMBER_INT);
$avatar = $_FILES['avatar'];
$online = 0;

if (!empty($firstname) && !empty($lastname) && !empty($email) && !empty($username) && !empty($password)) {
  $bio = "Hey there! I am using chat App";
  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $sql = "SELECT * FROM users WHERE email = '{$email}'";
    $result = $conn->query($sql);
    if ($result->num_rows === 0) {
      $sql2 = "SELECT * FROM users WHERE username = '{$username}'";
      $result2 = $conn->query($sql2);
      if ($result2->num_rows == 0) {
        if (strlen($password) > 7) {
          $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
          if ($avatar['size'] > 0) {
            $time = time();
            $avatar_name = $time.$avatar['name'];
            $tmp_name = $avatar['tmp_name'];
            $explode = explode(".", $avatar_name);
            $img_ext = end($explode);
            $exts = ["png", "jpg", "jpeg"];
            if (in_array($img_ext, $exts)) {
              if ($avatar['size'] < 1000000) {
                if (move_uploaded_file($tmp_name, "../img/".$avatar_name)) {
                  $sql3 = "INSERT INTO users (firstname, lastname,email, username, gender, password, bio, avatar, online) VALUES ('{$firstname}', '{$lastname}', '{$email}', '{$username}', {$gender}, '{$hashed_pass}', '{$bio}', '{$avatar_name}', {$online})";
                  if ($conn->query($sql3)) {
                    echo "success";
                  } else {
                    echo "Technical error. try again later ".mysqli_error($conn);
                  }
                } else {
                  echo "Something went wrong";
                }
              } else {
                echo "Image size is too large. File must be less than 1MB";
              }
            } else {
              echo "Please upload an image in jpg, png, or jpeg format";
            }
          } else {
            echo "Please upload an image";
          }
        } else {
          echo "Password must be upto 8 characters";
        }
      } else {
        echo "$username already exists!";
      }
    } else {
      echo "$email already exists!";
    }
  } else {
    echo "$email is not a vaild address";
  }
} else {
  echo "All fields are required";
}




