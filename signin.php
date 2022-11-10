<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://kit.fontawesome.com/fffd17f093.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Chat Application | Sign in</title>
</head>

<body>
<div class="grid-container">
  <header class="pt-2 pb-3 shadow-sm">
    <div class="container-lg">
      <div class="d-flex align-items-center justify-content-between mt-2">
        <a class="brand" href="index.php">
          <div class="me-1">Chat App</div>
          <i class="fa-solid fa-comment ms-1"></i>
        </a>
      </div>
    </div>
  </header>

  <section class="my-4">
    <div class="container-lg">
      <div class="row align-items-center justify-content-center">
        <div class="col-11 col-md-7 col-xl-6">
          <div class="text-center fw-bold h1 sign-text mb-4">Sign In</div>
          <div class="alert alert-danger error-text"></div>
          <form action="#" method="POST" autocomplete="off">
            <div class="form-floating mb-3 mt-3">
              <input type="text" class="form-control" id="username" placeholder="Enter username" name="username">
              <label for="username">Username or Email</label>
            </div>
            <div class="form-floating mb-3 mt-3">
              <input type="password" class="form-control" id="password" placeholder="Enter username" name="password">
              <label for="password">Password</label>
            </div>
            <div class="my-3">
              <div class="d-grid">
                <button class="btn" type="submit">Sign in</button>
              </div>
            </div>
            <div class="text-center">Don't have an account yet? <a href="signup.php">Sign Up</a></div>
          </form>
        </div>
      </div>
    </div>
  </section>


  <footer class="mt-3 p-3">
    <div class="container-lg">
      <div class="text-muted text-center">&copy; Benedict</div>
    </div>
  </footer>
</div>
<script src="js/signin.js"></script>
</body>
</html>
