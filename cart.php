<?php
  session_start();
  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
  }
  require_once 'cartItems.php';
  $qty = getCartItemQty();
  if (isset($_GET['empty'])) {
    unset($_SESSION['cart']);
    emptyCartItems(session_id());
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
          <a href="login.html">Login</a>&nbsp;&nbsp;&nbsp;
          <a href="signUp.html">Sign Up</a>
        </nav>
        <div id="titlerow">
          <a href="index.php" id="title"><h1>SureShip</h1></a>
          <input type="text" placeholder="Search for products..." size="60%" id="searchbar" />
          <!-- <img src="assets/magnify-custom.png" width="30" alt="search" /> -->
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
                </tr>
                <?php
                $length = count($_SESSION['cart']);
                for ($i = 0; $i < $length; $i++) {
                  $curPrice = doubleval($price[$_SESSION['cart'][$i]]);
                  $curTotal = $curPrice * $qty[$i];
                  echo"<tr>";
                  echo"<td><img src=".$imgPath[$_SESSION['cart'][$i]]." width='150px'/></td>";
                  echo"<td>".$name[$_SESSION['cart'][$i]]."</td>";
                  echo"<td>\$".number_format($curPrice, 2, '.', '')."</td>";
                  echo "<td><input type='text' name='qty".$i."' id='qty".$i."' value=$qty[$i] autocomplete='off' size='1' oninput='calPrice($i, $curPrice, $length)'/></td>";
                  echo "<td>\$ <input type='text' name='total".$i."' id='total".$i."' value='".number_format($curTotal, 2, '.', '')."' autocomplete='off' size='5' disabled/></td>";
                  echo"</tr>";
                }
                ?>
                <tr>
                  <td colspan="5">
                    <div id="totalRow">
                      <label for="total">Total Price: $</label>
                      <input
                        type="text"
                        name="total"
                        id="total"
                        value="0.00"
                        size="5"
                        disabled
                        onload="return calTotal($length)"
                      />
                      <input
                        id="orderSubmit"
                        type="submit"
                        value="Check Out"
                      />
                    </div>
                  </td>
                </tr>
              </form>
            </table>
            <a href="<?php echo $_SERVER['PHP_SELF']; ?>?empty=1"><input type='submit' id='emptyCart' value='Empty Cart' onclick=""/></a>
        </div>
        <footer>
            <p>&copy 2024 SureShip. All rights reserved.</p>
        </footer>
    </div>
  </body>
</html>