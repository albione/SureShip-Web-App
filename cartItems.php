<?php
    @ $db = new mysqli('localhost', 'root', '', 'sureship');

    if (mysqli_connect_errno()) {
        echo "Error: Could not connect to database.  Please try again later.";
        exit;
    }

    function insertCartItems($SID, $prodID, $qty) {
        global $db;
        $query = "INSERT INTO cart_items (sessionID, prodID, cartItemQty) VALUES (?, ?, ?)"; 
        $stmt = $db->prepare($query);
        $stmt->bind_param("sii", $SID, $prodID, $qty);
        $stmt->execute();

        echo '<script>window.history.back();</script>';
    }

    function emptyCartItems($SID, $curProdID) {
        global $db;
        $query = "DELETE FROM cart_items WHERE sessionID = ? AND prodID = ?"; 
        $stmt = $db->prepare($query);
        $stmt->bind_param("si", $SID, $curProdID);
        $stmt->execute();
    }

    function getCartItemQty() {
        global $db;
        $query = "SELECT cartItemQty FROM cart_items";
        $result = $db->query($query);
        $qtyData = [];

        while ($row = $result->fetch_assoc()) {
            $qtyData[] = $row['cartItemQty'];
        }

        $result->free();
        return $qtyData;
    }
?>