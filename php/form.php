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


if (isset($_POST['userEmail'])) {
  $email = filter_var($_POST['userEmail'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  if (!empty($email)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $email_sql = "SELECT email FROM users WHERE email = '{$email}'";
      $email_result = $conn->query($email_sql);
      if ($email_result->num_rows == 0) {
        echo "email success";
      } else {
        echo "Email already exists";
      }
    } else {
      echo "Enter a valid address";
    }
  } else {
    echo "This field cannot be empty";
  }
}

if (isset($_POST['userPass'])) {
  $password = filter_var($_POST['userPass'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  if (!empty($password)) {
    if (strlen($password) > 7) {
      echo "password success";
    } else {
      echo "Password cannot be less than 8 characters";
    }
  } else {
    echo "This field cannot be empty";
  }
}

if (isset($_POST['userName'])) {
  $username = filter_var($_POST['userName'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  if (!empty($username)) {
    $sql2 = "SELECT username FROM users WHERE username = '{$username}'";
    $result2 = $conn->query($sql2);
    if ($result2->num_rows == 0) {
      echo "username success";
    } else {
      echo "$username is not available";
    }
  } else {
    echo "This field cannot be empty";
  }
}
