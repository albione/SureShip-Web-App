<?php
  session_start();
  
  if (isset($_SESSION['username'])) {
    echo "<script> window.location.href = 'index.php'; </script>";
    exit();
  }
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'signup-be.php';
    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      
      signUp($username, $email, $password);
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>SureShip</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="loginSignup.css"/>
  </head>
  <body>
    <div id="wrapper">
      <header>
        <div id="titlerow">
          <a href="index.php"><h1>SureShip</h1></a>
          <label class="header-title">Sign Up</label>
        </div>
      </header>
      <div class="content">
        <img src="./assets/login-signup-bg.jpg" width="100%"/>
        <!--source: https://png.pngtree.com/thumb_back/fh260/background/20211217/pngtree-advertising-promotion-e-commerce-poster-special-page-taobao-drill-exhibition-material-image_922958.jpg-->
        <div class="form-container" id="signUpCont">
          <form id="signUp" action="signup.php" method="post">
            <label class="form-title">Sign Up</label>
            <input type="text" class="form-input"
              name="username"
              id="username"
              size=30
              required
              placeholder="Enter your username">
              <label class="error-msg" id="usernameErrorMsg"></label>
            <input type="text" class="form-input"
              name="email"
              id="email"
              size="30"
              required
              placeholder="Enter your Email">
              <label class="error-msg" id="emailErrorMsg"></label>
            <input type="password" class="form-input"
              name="password"
              id="password"
              size="30"
              required
              placeholder="Enter your password">
            <input type="password" class="form-input"
              name="confpassword"
              id="confpassword"
              size="30"
              required
              placeholder="Confirm your password">
              <label class="error-msg" id="confpwdErrorMsg"></label>
            <input class="form-button" id="submitBtn" type="submit" value="Sign Up" disabled>
        </form>
        <div class="form-footer">
          <label>Already has account? </label><a href="login.php">Log In</a>
        </div>
        </div>
      </div>
      <footer>
        <p>&copy 2024 SureShip. All rights reserved.</p>
      </footer>
    </div>
  </body>
  <script type = "text/javascript"  src = "loginSignupValidator.js" ></script>
</html>