<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: signin.php");
}

if (isset($_GET['id'])) {
  require_once "config/database.php";
  $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
  $sql = "SELECT * FROM users WHERE user_id = {$id}";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
} else {
  header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://kit.fontawesome.com/fffd17f093.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Chat</title>
</head>

<body>
  <div class="grid-container">
    <div class="header shadow-sm py-2">
      <div class="container-md">
        <div class="user mx-1">
          <div class="person">
            <a href="index.php">
              <i class="fa-solid fa-arrow-left me-1 back-icon"></i>
            </a>
            <img class="mx-1" src="img/<?= $row['avatar'] ?>" alt="person">
            <div class="ms-1">
              <div class="username"><?= $row['username'] ?></div>
              <div class="active-status"><?= ($row['online'] == 1)? "Online":"Offline" ?></div>
            </div>
          </div>
          <a class="btn btn-sm btn-dark" href="user-profile.php?id=<?= $row['user_id'] ?>">View Profile</a>
        </div>
      </div>
    </div>

    <div class="chatbox mt-3">
      <div class="container-md">

        

      </div>
    </div>

    <div class="chat footer py-3">
      <div class="container-md">
        <form action="#" method="post" autocomplete="off">
          <div class="send-message">
            <input type="hidden" name="chat_id" value="<?= $row['user_id'] ?>">
            <input type="text" name="message" id="message" class="form-control" placeholder="Message">
            <button style="background: #444"; class="btn" type="submit">
              <i class="fa-brands fa-telegram"></i>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="js/chat.js"></script>
</body>

</html>
