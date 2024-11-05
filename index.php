<?php
  session_start();
  if (isset($_SESSION['token'])) {
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
  require_once 'getProdData.php';
  $prodID = getProdID();
  $name = getName();
  $price = getPrice();
  $rating = getRating();
  $imgPath = getImgPath();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>SureShip</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <div id="wrapper">
      <header>
        <nav>
          <?php
          if ($username) {
            echo "<div class=\"dropdown\">";
            echo "<button class=\"dropbtn\">$username</button>";
            echo "<div class=\"dropdown-content\">";
            echo "<a href=\"#\">My Account</a>";
            echo "<a href=\"#\">My Purchases</a>";
            echo "<a href=\"#\">Logout</a>";
            echo "</div>";
            echo "</div>";
          } else {
            echo "<a href=\"login.html\">Login</a>&nbsp;&nbsp;&nbsp";
            echo "<a href=\"signUp.html\">Sign Up</a>";
          }
          ?>
        </nav>
        <div id="titlerow">
          <a href="index.php" id="title"><h1>SureShip</h1></a>
          <input type="text" placeholder="Search for products..." size="60%" id="searchbar" />
          <!-- <img src="assets/magnify-custom.png" width="30" alt="search" /> -->
          <a href="cart.php"><img src="assets/cart-outline.png" width="30" alt="cart" id="cart"/></a>
        </div>
      </header>
      <div class="content">
        <h2>Product List</h2>
        <?php
          for ($i = 0; $i < count($name); $i++) {
            echo "<a href='products.php?prodID=$prodID[$i]'>";
            echo "<div class='card'>";
            echo "<img src='$imgPath[$i]' width='100%' />";
            echo "<h3>$name[$i]</h3>";
            echo "<p>\$$price[$i] &nbsp; &#9733;$rating[$i]</p>";
            echo "</div>";
            echo "</a>";
          }
        ?>
      </div>
      <footer>
        <p>&copy 2024 SureShip. All rights reserved.</p>
      </footer>
    </div>
  </body>
</html>