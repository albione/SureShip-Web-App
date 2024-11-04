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
            <h2>Cart</h2>
            <table border="1">
              <form method="post" action="submitOrder.php" id="orderForm">
                <?php
                for ($i = 0; $i < count($_SESSION['cart']); $i++) {
                  $curPrice = $price[$_SESSION['cart'][$i]];
                  echo"<tr>";
                  echo"<td><img src=".$imgPath[$_SESSION['cart'][$i]]." width='150px'/></td>";
                  echo"<td>".$name[$_SESSION['cart'][$i]]."</td>";
                  echo"<td>\$".$curPrice."</td>";
                  echo "<td><input type='text' name='qty".$i."' id='qtyJava".$i."' value=$qty[$i] autocomplete='off' size='1' oninput='calPrice($i, $curPrice)'/></td>";
                  echo "<td><input type='text' name='total".$i."' id='total".$i."' value='0.00' autocomplete='off' size='1' disabled/></td>";
                  echo"</tr>";
                }
                ?>
                <tr>
                  <td colspan="4">
                    <div id="totalRow">
                      <label for="total">Total Price:</label>
                      <input
                        type="text"
                        name="total"
                        id="total"
                        value="0.00"
                        size="2"
                        disabled
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
            <!-- <input type='submit' id='emptyCart' value='Empty Cart' onclick=""/> -->
            <a href="<?php echo $_SERVER['PHP_SELF']; ?>?empty=1">Empty Cart</a>
        </div>
        <footer>
            <p>&copy 2024 SureShip. All rights reserved.</p>
        </footer>
    </div>
  </body>
</html>