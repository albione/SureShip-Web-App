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

  $message = "Your order has been confirmed." . "\r\n" . "\r\n"
    . "Order Details (Name, Price, Quantity, Subtotal):" . "\r\n" . "\r\n";

  $total = 0;

  $numItem = count($_POST) / 4;
  
  for ($i = 0; $i < $numItem; $i++) {
    global $message;
    global $total;
    
    $prodID = intval($_POST['prodID'.$i]);
    $qty = intval($_POST['qty'.$i]);

    // To simulate unsuccessful payment only, user shouldn't be allowed to enter 0 (should be validated in frontend)
    if ($qty == 0) {
      echo "<script>alert('Payment unsuccessful. Please try again.');";
      echo "window.location = 'cart.php?".session_id()."';</script>";
      exit();
    }

    else {
      $price = doubleval($_POST['price'.$i]);
      $total += number_format($qty * $price, 2, '.', '');

      $orderItem = $i+1 . ". " . $_POST['name'.$i] . ", $" . number_format($price, 2, '.', '') . ", " . 
      $qty .  ", $" . number_format($qty * $price, 2, '.', '') . "\r\n" . "\r\n";
      
      $message .= $orderItem;

      $query = "insert into order_items(prodID, itemQty, itemPrice, shipped) values(?, ?, ?, 0)"; 
      $stmt = $db->prepare($query);
      $stmt->bind_param('iid', $prodID, $qty, $price);
      $stmt->execute();  
    }
  }

  $to = 'f32ee@localhost';
  $subject = 'Order Confirmation';
  $message .= "Total Amount: $" . number_format($total, 2, '.', '') . "\r\n" . "\r\n" . "Thank you for shopping with us!";
  $headers = 'From: f32ee@localhost' . "\r\n" .
      'Reply-To: f32ee@localhost' . "\r\n" .
      'X-Mailer: PHP/' . phpversion();

  mail($to, $subject, $message, $headers,'-ff32ee@localhost');

  unset($_SESSION['cart']);
  emptyCartItems(session_id());
  echo "<script>alert('Payment successful. An email confirmation has been sent to your registered email address.');";
  echo "window.location = 'cart.php?".session_id()."';</script>";
  exit();
?> 
