<?php
session_start();
require_once "config/database.php";

if (!isset($_SESSION['user_id'])) {
  header("Location: signin.php");
}
$user_id = filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT);

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
  <title>Chat Application</title>
</head>

<body>

  <form action="#" method="post" autocomplete="off" class="search container">
    <input class="form-control searchBar" type="text" name="search" id="search">
    <div class="icon">
      <i class="fa-solid fa-x close-search"></i>
    </div>
  </form>

  <div class="grid-container">
    <header class="pt-2 pb-3 shadow-sm">
      <div class="container-lg">
        <div class="d-flex align-items-center justify-content-between mt-2">
          <a class="brand" href="index.php">
            <div class="me-1">Chat App</div>
            <i class="fa-solid fa-comment ms-1"></i>
          </a>
          <div class="options">
            <i class="fa-solid fa-magnifying-glass search-icon"></i>
            <i class="fa-solid fa-ellipsis-vertical toggle-menu"></i>
            <div class="sub-menu rounded shadow-sm">
              <ul>
                <li><a href="profile.php">Edit Profile</a></li>
                <li><a href="php/logout.php?id=<?= $user_id ?>">Logout</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </header>

    <section class="mb-4">
      <div class="container-lg">
        <div class="fs-5 mt-2 fw-bold">Chats</div>
        <div class="users my-3">
         
        </div>
      </div>
    </section>

    <footer class="mt-3 p-3">
      <div class="container-lg">
        <div class="text-muted text-center">&copy; Benedict</div>
      </div>
    </footer>
  </div>
 <script src="js/main.js"></script>
 <script src="js/users.js"></script>
</body>

</html>
