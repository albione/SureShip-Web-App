<?php
    @ $db = new mysqli('localhost', 'root', '', 'sureship');

    if (mysqli_connect_errno()) {
        echo "Error: Could not connect to database.  Please try again later.";
        exit;
    }

    function getProdID() {
        global $db;
        $query = "SELECT prodID FROM products";
        $result = $db->query($query);
        $prodIDData = [];

        while ($row = $result->fetch_assoc()) {
            $prodIDData[] = $row['prodID'];
        }

        $result->free();
        return $prodIDData;
    }
    
    function getProdIDByName($keyword) {
        global $db;
        $query = "SELECT prodID FROM products WHERE prod_name LIKE '%$keyword%'";
        $result = $db->query($query);   
        $prodIDData = [];

        while ($row = $result->fetch_assoc()) {
            $prodIDData[] = $row['prodID'];
        }

        $result->free();
        return $prodIDData;
    }

    function getProdIDSortBy($sort) {
        global $db;
        if ($sort == 'price') {
            $query = "SELECT prodID FROM products ORDER BY $sort ASC";
        } else {
            $query = "SELECT prodID FROM products ORDER BY $sort DESC";
        }
        $result = $db->query($query);   
        $prodIDData = [];

        while ($row = $result->fetch_assoc()) {
            $prodIDData[] = $row['prodID'];
        }

        $result->free();
        return $prodIDData;
    }

    function getName() {
        global $db;
        $query = "SELECT prod_name FROM products";
        $result = $db->query($query);
        $nameData = [];

        while ($row = $result->fetch_assoc()) {
            $nameData[] = $row['prod_name'];
        }

        $result->free();
        return $nameData;
    }

    function getPrice() {
        global $db;
        $query = "SELECT price FROM products";
        $result = $db->query($query);
        $priceData = [];

        while ($row = $result->fetch_assoc()) {
            $priceData[] = $row['price'];
        }

        $result->free();
        return $priceData;
    }

    function getRating() {
        global $db;
        $query = "SELECT rating FROM products";
        $result = $db->query($query);
        $ratingData = [];

        while ($row = $result->fetch_assoc()) {
            $ratingData[] = $row['rating'];
        }

        $result->free();
        return $ratingData;
    }

    function getImgPath() {
        global $db;
        $query = "SELECT img_path FROM products";
        $result = $db->query($query);
        $imgPathData = [];

        while ($row = $result->fetch_assoc()) {
            $imgPathData[] = $row['img_path'];
        }

        $result->free();
        return $imgPathData;
    }

    function getDescText() {
        global $db;
        $query = "SELECT desc_text FROM products";
        $result = $db->query($query);
        $descData = [];

        while ($row = $result->fetch_assoc()) {
            $descData[] = $row['desc_text'];
        }

        $result->free();
        return $descData;
    }
?>