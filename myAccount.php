<?php
  session_start();
  if (!isset($_SESSION['username'])) {
    echo "<script>
        alert('You must be logged in to access this page.');
        window.location.href = 'login.html';
    </script>";
    exit();
  } else {
    $username = $_SESSION['username'];
  }
  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
  }
  if (isset($_GET['buy'])) {
    $_SESSION['cart'][] = $_GET['buy'];
    header('location: ' . $_SERVER['PHP_SELF'].'?'.SID);
    exit();
  }
  require_once 'getAccountData.php';
  $userData = getUserData($username);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>SureShip</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="myAccount.css" />
  </head>
  <body>
    <div id="wrapper">
      <header>
        <nav>
          <?php
              echo "<div class=\"dropdown\">";
              echo "<button class=\"dropbtn\">$username</button>";
              echo "<div class=\"dropdown-content\">";
              echo "<a href=\"myAccount.php\">My Account</a>";
              echo "<a href=\"#\">My Purchases</a>";
              echo "<a href=\"logout.php\">Logout</a>";
              echo "</div>";
              echo "</div>";
          ?>
          &nbsp;&nbsp;&nbsp;<a href="admin.php">Admin</a>
        </nav>
        <div id="titlerow">
          <a href="index.php" id="title"><h1>SureShip</h1></a>
          <input type="text" placeholder="Search for products..." size="60%" id="searchbar" />
          <a href="cart.php"><img src="assets/cart-outline.png" width="30" alt="cart" id="cart"/></a>
        </div>
      </header>
      <div class="content">
        <div class="left-container">
          <label id="left-container-username"><?php echo $userData['username']?></label>
          <ul>
            <li><a href="myAccount.php" class="">My Account</a></li>
            <li><a href="myPurchases.php">My Purchases</a></li>
        </div>
        <div class="right-container">
          <h1 id="content-h1">My Account</h1>
          <h3>Manage my account details</h3>
          <form action="myAccountUpdate.php" method="post">
            <div class="user-data">
              <label class="user-data-label">Username:</label>
              <div class="user-data-input">
              <input type="text"
                name="username"
                id="username"
                class="form-input"
                value="<?php echo $userData['username']; ?>"
                size="30"/>
              <label class="error-msg" id="usernameErrorMsg"></label>
              </div>
            </div>
            <div class="user-data">
              <label class="user-data-label">Email:</label>
              <div class="user-data-input">
                <input type="text" 
                  name="email"
                  id="email"
                  class="form-input"
                  value="<?php echo $userData['email']; ?>"
                  size="30"
                  required/>
                <label class="error-msg" id="emailErrorMsg"></label>
              </div>
            </div>
            <div class="user-data">
              <label class="user-data-label">Password:</label>
              <div class="user-data-input">
                <input type="password"
                  name="password"
                  id="password"
                  class="form-input"
                  value=""
                  size="30"
                  required/>
                <label class="error-msg" id="passwordErrorMsg"></label>
              </div>
            </div>
            <div class="user-data">
              <label class="user-data-label">Address:</label>
              <div class="user-data-input">
                <textarea type="textarea" rows="4" cols="40"
                  name="address"
                  class="form-input"
                  id="address"><?php echo $userData['address']; ?></textarea>
                <label class="error-msg" id="addressErrorMsg"></label>
              </div>
            </div>
            <input class="save-btn" id="saveBtn" type="submit" value="Save" disabled>
          </form>
        </div>
      </div>
      <footer>
        <p>&copy 2024 SureShip. All rights reserved.</p>
      </footer>
    </div>
  </body>
  <script type="text/javascript" src="myAccountValidator.js"></script>
</html>