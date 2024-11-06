<?php
  session_start();

  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
  }
  require_once 'cartItems.php';
  $qty = getCartItemQty();
  if (isset($_GET['remove'])) {
    $remove = $_GET['remove'];
    $curProdID = $_GET['prodID'];
    unset($_SESSION['cart'][$remove]);
    $_SESSION['cart'] = array_values($_SESSION['cart']);
    removeCartItems(session_id(), $curProdID);
    header('location: ' . $_SERVER['PHP_SELF'].'?'.SID);
    exit();
  }
  require_once 'getProdData.php';
  $prodID = getProdID();
  $name = getName();
  $price = getPrice();
  $imgPath = getImgPath();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>SureShip</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" />
    <script type="text/javascript" src="cartUpdate.js"></script>
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
              echo "<a href=\"myAccount.php\">My Account</a>";
              echo "<a href=\"logout.php\">Logout</a>";
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
            <h2>Shopping Cart</h2>
            <table border="1">
              <form method="post" action="submitOrder.php" id="orderForm">
                <tr>
                  <td><b>Product Image</b></td>
                  <td><b>Name</b></td>
                  <td><b>Price</b></td>
                  <td><b>Quantity</b></td>
                  <td><b>Subtotal</b></td>
                  <td></td>
                </tr>
                <?php
                $length = count($_SESSION['cart']);
                for ($i = 0; $i < $length; $i++) {
                  $curImgPath = $imgPath[$_SESSION['cart'][$i]];
                  $curName = $name[$_SESSION['cart'][$i]];
                  $curPrice = doubleval($price[$_SESSION['cart'][$i]]);
                  $curTotal = $curPrice * $qty[$i];
                  $curProdID = $prodID[$_SESSION['cart'][$i]];
                  echo "<tr>";
                  echo "<td><img src=".$curImgPath." width='150px'/></td>";
                  echo "<td>".$curName."</td>";
                  echo "<td>\$".number_format($curPrice, 2, '.', '')."</td>";
                  echo "<td><input type='text' name='qty".$i."' id='qty".$i."' value=$qty[$i] autocomplete='off' size='1' oninput='calPrice($i, $curPrice, $length)'/></td>";
                  echo "<td>\$ <input type='text' name='total".$i."' id='total".$i."' value='".number_format($curTotal, 2, '.', '')."' autocomplete='off' size='5' disabled/></td>";
                  echo "<td><a href='".$_SERVER['PHP_SELF']."?remove=$i&prodID=$curProdID'><input type='button' id='remove".$i."' value='Remove'/></a></td>";
                  echo "<input type='text' name='price".$i."' id='price".$i."' value='".$curPrice."' hidden/>";
                  echo "<input type='text' name='prodID".$i."' id='prodID".$i."' value='".$curProdID."' hidden/>";
                  echo "<input type='text' name='name".$i."' id='name".$i."' value='".$curName."' hidden/>";
                  echo "</tr>";
                }
                ?>
                <tr>
                  <td colspan="6">
                    <div id="totalRow">
                      <label for="total">Total Amount: $</label>
                      <input
                        type="text"
                        name="total"
                        id="total"
                        value="0.00"
                        size="5"
                        disabled
                        onload="return calTotal($length)"
                      />&nbsp;&nbsp;&nbsp;&nbsp;
                      <input
                        id="orderSubmit"
                        type="submit"
                        value="Check Out"
                        onclick="confirmOrder()"
                      />
                    </div>
                  </td>
                </tr>
              </form>
            </table>
        </div>
        <footer>
            <p>&copy 2024 SureShip. All rights reserved.</p>
        </footer>
    </div>
  </body>
</html>