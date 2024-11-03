<?php
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
          <a href="login.html">Login</a>&nbsp;&nbsp;&nbsp;
          <a href="signUp.html">Sign Up</a>
        </nav>
        <div id="titlerow">
          <h1>SureShip</h1>
          <input type="text" placeholder="Search for products..." size="60%" id="searchbar" />
          <!-- <img src="assets/magnify-custom.png" width="30" alt="search" /> -->
          <img src="assets/cart-outline.png" width="30" alt="cart" id="cart"/>
        </div>
      </header>
      <div class="content">
        <h2>Product Details</h2>
        <?php
            $i = $prodID - 1;
            echo "<div class='details'>";
            echo "<div class='details-image'>";
            echo "<img src='$imgPath[$i]' width='100%'/>";
            echo "</div>";
            echo "<div class='details-info'>";
            echo "<h2>$name[$i]</h2>";
            echo "<p>Rating: &#9733;$rating[$i]</p>";
            echo "<p id='price'>\$$price[$i]</p>";
            echo "<p>$descText[$i]</p>";
            echo "<label>Quantity: <input type='number' id='qty' min=1 value=1></label><br>";
            echo "<input type='submit' id='addCart' value='Add to Cart'/>";
            echo "</div>";
            echo "</div>";   
        ?>                      
      </div>
      <footer>
        <p>&copy 2024 SureShip. All rights reserved.</p>
      </footer>
    </div>
  </body>
</html>