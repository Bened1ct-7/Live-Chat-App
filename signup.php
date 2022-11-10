<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://kit.fontawesome.com/fffd17f093.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Chat Application | Sign up</title>
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
          <div class="text-center fw-bold h1 sign-text mb-4">Sign Up</div>
          <div class="alert alert-danger error-text">
            hhh
          </div>
          <form action="#" method="POST" id="signup" enctype="multipart/form-data" autocomplete="off" novalidate="">
            <div class="form-floating mb-3 mt-3">
              <input type="text" class="form-control" id="firstname" placeholder="Enter first name" name="firstname">
              <label for="firstname">First Name</label>
              <div class="text-danger mt-1 js-fname error"></div>
            </div>
            <div class="form-floating mb-3 mt-3">
              <input type="text" class="form-control" id="lastname" placeholder="Enter last name" name="lastname">
              <label for="lastname">Last Name</label>
              <div class="text-danger mt-1 js-lname error"></div>
            </div>
            <div class="form-floating mb-3 mt-3">
              <input type="text" class="form-control" id="username" placeholder="Enter username" name="username">
              <label for="username">Username</label>
              <div class="text-danger mt-1 js-uname error"></div>
            </div>
            <div class="form-floating mb-3 mt-3">
              <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
              <label for="email">Email</label>
              <div class="text-danger mt-1 js-email error"></div>
            </div>
            <div class="my-3">
              <label class="form-label" for="gender">Select Gender</label>
              <select name="gender" id="gender" class="form-control">
                <option value="1">Male</option>
                <option value="0">Female</option>
              </select>
            </div>
            <div class="form-floating mb-3 mt-3">
              <input type="password" class="form-control" id="password" placeholder="Enter username" name="password">
              <label for="password">Password</label>
              <div class="text-danger mt-1 js-password error"></div>
            </div>
            <div class="my-3">
              <label class="form-label" for="avatar">Upload Profile Picture </label>
              <input style="display: block;" class="form-control" type="file" name="avatar" id="avatar">
            </div>
            <div class="my-3">
              <div class="d-grid">
                <button class="submitBtn btn" type="submit">Register</button>
              </div>
            </div>
            <div class="text-center">Already have an account? <a href="signin.php">Sign in</a></div>
            
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
<script src="js/signup.js"></script>
</body>

</html>
