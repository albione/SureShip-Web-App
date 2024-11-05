<?php
  session_start();

  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
  }
  if (isset($_GET['buy'])) {
    require_once 'cartItems.php';
    $_SESSION['cart'][] = $_GET['buy'];
    $prodID = intval($_GET['prodID']);
    $qty = intval($_GET['qty']);
    insertCartItems(session_id(), $prodID, $qty);
    exit();
  }
  require_once 'getProdData.php';
  $prodID = $_GET['prodID'];
  $name = getName();
  $price = getPrice();
  $rating = getRating();
  $imgPath = getImgPath();
  $descText = getDescText();
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
            if (isset($_SESSION['username'])) {
              $username = $_SESSION['username']; 
              echo "<div class=\"dropdown\">";
              echo "<button class=\"dropbtn\">$username</button>";
              echo "<div class=\"dropdown-content\">";
              echo "<a href=\"#\">My Account</a>";
              echo "<a href=\"#\">My Purchases</a>";
              echo "<a href=\"#\">Logout</a>";
              echo "</div>";
              echo "</div>";
            } else {
              echo "<a href=\"login.html\">Login</a>&nbsp;&nbsp;&nbsp;";
              echo "<a href=\"signUp.html\">Sign Up</a>";
            }
          ?>
          &nbsp;&nbsp;<a href="admin.php">Admin</a>
        </nav>
        <div id="titlerow">
          <a href="index.php" id="title"><h1>SureShip</h1></a>
          <form action="index.php" method="get" id="searchForm">
              <input type="text" placeholder="Search for products..." size="60%" id="searchbar" name="searchbar" />
          </form>
          <a href="cart.php"><img src="assets/cart-outline.png" width="30" alt="cart" id="cart"/></a>
        </div>
      </header>
      <div class="content">
        <h2>Product Details</h2>
        <?php
            $i = $prodID - 1;
            echo "<form method='get' action='products.php' id='cartForm'>";
            echo "<div class='details'>";
            echo "<div class='details-image'>";
            echo "<img src='$imgPath[$i]' width='100%'/>";
            echo "</div>";
            echo "<div class='details-info'>";
            echo "<h2>$name[$i]</h2>";
            echo "<p>Rating: &#9733;$rating[$i]</p>";
            echo "<p id='price'>\$$price[$i]</p>";
            echo "<p>$descText[$i]</p>";
            echo "<label>Quantity: <input type='number' id='qty' name='qty' min=1 value=1></label><br>";
            echo "<input type='hidden' name='prodID' value='$prodID'/>";
            echo "<input type='hidden' name='buy' value='$i'/>";
            $button = in_array($i, $_SESSION['cart']) ? "<input type='submit' id='addCart' value='Added' disabled/>" 
            : "<input type='submit' id='addCart' value='Add to Cart'/>";
            echo $button;
            echo "</div>";
            echo "</div>";  
            echo "</form>";    
        ?>                      
      </div>
      <footer>
        <p>&copy 2024 SureShip. All rights reserved.</p>
      </footer>
    </div>
  </body>
</html>