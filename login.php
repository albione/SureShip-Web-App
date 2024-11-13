<?php
  session_start();
  
  $loginFailed = false;

  if (isset($_SESSION['username'])) {
    echo "<script> window.location.href = 'index.php'; </script>";
    exit();
  }
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'login-be.php';
    if (isset($_POST['username']) && isset($_POST['password'])) {
      $username = $_POST['username'];
      $password = $_POST['password'];
      
      if (login($username, $password)) {
        echo "<script> window.location.href = 'index.php'; </script>";
        exit();
      } else {
          echo "<script> alert('Wrong username or password.'); </script>";
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>SureShip</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="loginSignup.css" />
  </head>
  <body>
    <div id="wrapper">
      <header>
        <div id="titlerow">
          <a href="index.php"><h1>SureShip</h1></a>
          <label class="header-title">Log In</label>
        </div>
      </header>
      <div class="content">
        <img src="./assets/login-signup-bg.jpg" width="100%" />
        <!--source: https://png.pngtree.com/thumb_back/fh260/background/20211217/pngtree-advertising-promotion-e-commerce-poster-special-page-taobao-drill-exhibition-material-image_922958.jpg-->
        <div class="form-container">
          <form action="login.php" method="post">
            <label class="form-title">Log In</label>
            <input
              type="text"
              class="form-input"
              name="username"
              id="username"
              size="30"
              required
              placeholder="Enter your username"
            />
            <input
              type="password"
              class="form-input"
              name="password"
              id="password"
              size="30"
              required
              placeholder="Enter your password"
            />
            <input class="form-button" id="submitBtn" type="submit" value="Log In"/>
          </form>
          <div class="form-footer">
            <label>Not a member? </label><a href="signup.php">Sign Up</a>
          </div>
        </div>
      </div>
      <footer>
        <p>&copy 2024 SureShip. All rights reserved.</p>
      </footer>
    </div>
  </body>
  <script type="text/javascript" src="loginSignupValidator.js"></script>
</html>
