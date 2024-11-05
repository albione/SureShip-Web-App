<?php
  session_start();
  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
  }
  require_once 'cartItems.php';

  @ $db = new mysqli('localhost', 'root', '', 'sureship');

  if (mysqli_connect_errno()) {
     echo "Error: Could not connect to database.  Please try again later.";
     exit;
  }
      $numItem = count($_POST) / 3;
      
      for ($i = 0; $i < $numItem; $i++) {
        $prodID = intval($_POST['prodID'.$i]);
        $qty = intval($_POST['qty'.$i]);
        $price = doubleval($_POST['price'.$i]);
        $query = "insert into order_items(prodID, itemQty, itemPrice, shipped) values(?, ?, ?, 0)"; 
        $stmt = $db->prepare($query);
        $stmt->bind_param('iid', $prodID, $qty, $price);
        $stmt->execute();  
      }

  // echo '<script>alert("Order Successful!");</script>';
  unset($_SESSION['cart']);
  emptyCartItems(session_id());
  header('location: ' . 'cart.php'.'?'.SID);
  exit();
?> 
