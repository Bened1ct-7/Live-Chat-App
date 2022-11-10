<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: signin.php");
}
if (!isset($_GET['id'])) {
  header("Location: index.php");
} else {
  require_once "config/database.php";
  $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
  $sql = "SELECT * FROM users WHERE user_id = {$id}";
  $result = $conn->query($sql);
  if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
    $conn->close();
  }
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://kit.fontawesome.com/fffd17f093.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <title>User Profile</title>
</head>

<body>
  <div class="grid-container">
    <header class="pt-2 pb-3 shadow-sm">
      <div class="container-lg">
        <div class="d-flex align-items-center justify-content-start mt-2">
          <a class="brand" href="index.php">
            <div class="me-1">Chat App</div>
            <i class="fa-solid fa-comment ms-1"></i>
          </a>
        </div>
      </div>
    </header>

    <div class="main">
      <div class="container-lg">
        <div>
          <div class="image mt-4 d-flex align-items-center justify-content-center">
            <img src="img/<?= $user['avatar'] ?>" alt="user image">
          </div>
          <div class="text-center fw-bold fs-5 mt-1"><?= $user['firstname'] ." " . $user['lastname'] ?></div>
        </div>

        <div class="user-details my-4">
          <div class="my-3 user-detail">
            <i class="fa-solid fa-user"></i>
            <div class="main-details">
              <span class="fw-bold text-muted">Bio</span>
              <p><?= $user['bio'] ?></p>
            </div>
          </div>
          <div class="my-3 user-detail">
            <i class="fa-solid fa-user"></i>
            <div class="main-details">
              <span class="fw-bold text-muted">Username</span>
              <p><?= $user['username'] ?></p>
            </div>
          </div>
          <div class="my-3 user-detail">
            <i class="fa-solid fa-user"></i>
            <div class="main-details">
              <span class="fw-bold text-muted">Gender</span>
              <p><?= ($user['gender'] == 1)? "Male":"Female" ?></p>
            </div>
          </div>
          <div class="my-3 user-detail">
            <i class="fa-solid fa-user"></i>
            <div class="main-details">
              <span class="fw-bold text-muted">Joined</span>
              <p><?= date("F d, Y", strtotime($user['reg_date'])) ?></p>
            </div>
          </div>
        </div>


      </div>
    </div>

    <div class="footer p-2">
      <div class="container-lg">
        <div class="text-center text-muted">&copy; Benedict</div>
      </div>
    </div>
  </div>
</body>

<script src="js/user-profile.js"></script>

</html>
