<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: signin.php");
}
$id = filter_var($_SESSION['user_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
require_once "config/database.php";
$sql = "SELECT * FROM users WHERE user_id = {$id}";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
  $user = $result->fetch_assoc();
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
        <div class="image mt-4 d-flex align-items-center justify-content-center">
          <img src="img/<?= $user['avatar'] ?>" alt="user image">
          <label class="show-form">
            <i class="fa-solid fa-pen-to-square"></i>
          </label>
        </div>
        
        <div class="user-details mt-4">
          <div class="my-3 details">
            <i class="fa-solid fa-user first"></i>
            <div class="second">
              <span class="text-muted">Username</span>
              <p class="mb-1 user-name"><?= $user['username'] ?></p>
              <span class="text-muted small">This is your username and it cannot be changed</span>
            </div>
            <i class="fa-solid fa-lock third"></i>
          </div>
          
          <div class="my-3 details">
            <i class="fa-solid fa-user first"></i>
            <div class="second">
              <span class="text-muted">Name</span>
              <p class="mb-1 name"><?= $user['firstname'] . " " . $user['lastname'] ?></p>
              <span class="text-muted small">This is your full name. Click the pen icon to edit</span>
            </div>
            <i class="fa-solid fa-pen edit-name third"></i>
          </div>
          
          <div class="my-3 details">
            <i class="fa-solid fa-envelope first"></i>
            <div class="second">
              <span class="text-muted">Email</span>
              <p class="mb-1 email"><?= $user['email'] ?></p>
              <span class="text-muted small">This is your email and it cannot be changed</span>
            </div>
            <i class="fa-solid fa-lock third"></i>
          </div>
          
          <div class="my-3 details">
            <i class="fa-solid fa-user first"></i>
            <div class="second">
              <span class="text-muted">Bio</span>
              <p class="mb-1 bio"><?= $user['bio'] ?></p>
              <span class="text-muted small">Write a short description about yourself</span>
            </div>
            <i class="fa-solid fa-pen edit bio third"></i>
          </div>
          
          <div class="my-3 details">
            <i class="fa-solid fa-user first"></i>
            <div class="second">
              <span class="text-muted">Joined</span>
              <p class="mb-1 bio"><?= date("F d, Y", strtotime($user['reg_date'])) ?></p>
              <span class="text-muted small">This is the time you joined</span>
            </div>
            <i class="fa-solid fa-lock third"></i>
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
  
  <div class="edit-form">
    <div class="container-lg">
      <form class="col-11 col-md-7 col-xl-6 p-2 rounded shadow-sm" action="#" method="POST" autocomplete="off" enctype="application/x-www-form-urlencoded">
        <i class="fa-solid fa-x text-danger"></i>
        <div class="mt-5 alert alert-danger error-text"></div>
        <div class="my-3">
          <label class="form-label" for="firstname">First Name</label>
          <input type="text" name="firstname" id="firstname" class="form-control" value="<?= $user['firstname'] ?>">
        </div>
        <div class="my-3">
          <label for="lastname" class="form-label">Last Name</label>
          <input type="text" name="lastname" id="lastname" class="form-control" value="<?= $user['lastname'] ?>">
        </div>
        <div class="my-3">
          <label for="bio" class="form-label">Write a short note about you</label>
          <textarea name="bio" id="bio" class="form-control" cols="30" rows="5"><?= $user['bio'] ?></textarea>
        </div>
        <div class="my-3">
          <label class="form-label">Update Profile Picture </label>
          <input class="form-control" type="file" name="avatar" id="avatar">
        </div>
        <div class="my-3 d-grid">
          <button class="btn btn-dark edit-btn" type="submit">Edit Details</button>
        </div>
      </form>
    </div>
  </div>
</body>

 <script src="js/profile.js"></script>
</html>
