<?php
  session_start();

  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
  }
  require_once 'orderItems.php';
  $orderItemID = getOrderItemID();
  $orderItemProdID = getOrderItemProdID();
  $orderItemQty = getOrderItemQty();
  $orderItemPrice = getOrderItemPrice();
  $isShipped = isShipped();

  require_once 'getProdData.php';
  $name = getName();
  $imgPath = getImgPath();

  if (isset($_GET['orderItemID'])) {
    $curOrderItemID = $_GET['orderItemID'];
    $curName = $_GET['name'];
    updateShipping($curOrderItemID, $curName);
    header('location: ' . $_SERVER['PHP_SELF']);
    exit();
  }
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
              echo "<a href=\"myAccount.php\">My Account</a>";
              echo "<a href=\"logout.php\">Logout</a>";
              echo "</div>";
              echo "</div>";
            } else {
              echo "<a href=\"login.html\">Login</a>&nbsp;&nbsp;&nbsp";
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
            <h2>Admin Page</h2>
            <table border="1">
                <tr>
                    <td><b>Order Item ID</b></td>
                    <td><b>Product Image</b></td>
                    <td><b>Name</b></td>
                    <td><b>Price</b></td>
                    <td><b>Quantity</b></td>
                    <td><b>Subtotal</b></td>
                    <td><b>Shipped?</b></td>
                    <td></td>
                </tr>
                <?php
                $length = count($orderItemID);
                for ($i = 0; $i < $length; $i++) {
                    $curOrderItemID = intval($orderItemID[$i]);
                    $curImgPath = $imgPath[$orderItemProdID[$i]-1];
                    $curName = $name[$orderItemProdID[$i]-1];
                    $curPrice = doubleval($orderItemPrice[$i]);
                    $curQty = intval($orderItemQty[$i]);
                    $curTotal = $curPrice * $curQty;
                    $curIsShipped = $isShipped[$i] ? "Yes" : "No";
                    echo "<tr>";
                    echo "<td>".$curOrderItemID."</td>";
                    echo "<td><img src=".$curImgPath." width='150px'/></td>";
                    echo "<td>".$curName."</td>";
                    echo "<td>\$".number_format($curPrice, 2, '.', '')."</td>";
                    echo "<td>$curQty</td>";
                    echo "<td>\$" .number_format($curTotal, 2, '.', '')."</td>";
                    echo "<td>".$curIsShipped."</td>";
                    echo "<input type='text' name='shipped".$i."' id='shipped".$i."' value='".$curIsShipped."' hidden/>";
                    $button = $isShipped[$i] ? "<input type='button' id='update".$i."' value='Update Shipping' disabled/>" 
                    : "<input type='button' id='update".$i."' value='Update Shipping'/>";
                    echo "<td><a href='".$_SERVER['PHP_SELF']."?orderItemID=$curOrderItemID&name=$curName'>$button</a></td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
        <footer>
            <p>&copy 2024 SureShip. All rights reserved.</p>
        </footer>
    </div>
  </body>
</html>