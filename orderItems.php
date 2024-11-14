<?php
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    require_once 'userAccountUpdate.php';

    @ $db = new mysqli('localhost', 'root', '', 'sureship');

    if (mysqli_connect_errno()) {
        echo "Error: Could not connect to database.  Please try again later.";
        exit;
    }
    
    function getOrderItemID() {
        global $db;
        $query = "SELECT orderItemID FROM order_items";
        $result = $db->query($query);
        $orderItemIDData = [];

        while ($row = $result->fetch_assoc()) {
            $orderItemIDData[] = $row['orderItemID'];
        }

        $result->free();
        return $orderItemIDData;
    }

    function getOrderItemProdID() {
        global $db;
        $query = "SELECT prodID FROM order_items";
        $result = $db->query($query);
        $prodIDData = [];

        while ($row = $result->fetch_assoc()) {
            $prodIDData[] = $row['prodID'];
        }

        $result->free();
        return $prodIDData;
    }

    function getOrderItemQty() {
        global $db;
        $query = "SELECT itemQty FROM order_items";
        $result = $db->query($query);
        $qtyData = [];

        while ($row = $result->fetch_assoc()) {
            $qtyData[] = $row['itemQty'];
        }

        $result->free();
        return $qtyData;
    }

    function getOrderItemPrice() {
        global $db;
        $query = "SELECT itemPrice FROM order_items";
        $result = $db->query($query);
        $priceData = [];

        while ($row = $result->fetch_assoc()) {
            $priceData[] = $row['itemPrice'];
        }

        $result->free();
        return $priceData;
    }

    function isShipped() {
        global $db;
        $query = "SELECT shipped FROM order_items";
        $result = $db->query($query);
        $shippedData = [];

        while ($row = $result->fetch_assoc()) {
            $shippedData[] = $row['shipped'];
        }

        $result->free();
        return $shippedData;
    }

    function updateShipping($orderItemID, $curName) {
        global $db;
        $query = "UPDATE order_items SET shipped=1 where orderItemID=?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("i", $orderItemID);
        $stmt->execute();

        $username = $_SESSION['username'];
        $address = getUserData($username)["address"];

        $to = 'f32ee@localhost';
        $subject = 'Shipping Status Update';
        $message = "Your order \"$curName\" has been shipped to your address." . "\r\n" . "\r\n" . 
        "Your address: " . $address . "\r\n" . "\r\n" . 
        "Thank you for shopping with us!";
        $headers = 'From: f32ee@localhost' . "\r\n" .
            'Reply-To: f32ee@localhost' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers,'-ff32ee@localhost');
    }

?>