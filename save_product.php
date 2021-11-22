<?php

    include("db.php");

    if(isset($_POST['save_product'])) {
        $product = $_POST['product'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $is_active = ($_POST['is_active']=='on') ? 1 : 0;

        if ($product == "" || $category == "" || $price == "" || $stock == "" || $is_active == "" ) {
            die();
        }
        // print json_encode(array($product, $category, $price, $stock, $is_active));
        
        $sql = "INSERT INTO PRODUCTS (product, idCategory, price, stock, is_active) 
                VALUES (?, ?, ?, ?, ?)";
        $params = array($product, $category, $price, $stock, $is_active);
    
        $stmt = sqlsrv_query( $conn, $sql, $params);
        if( $stmt === false ) {
            die( print_r( sqlsrv_errors(), true));
        } else {
            header("Location: ./");
            die();
        }
    }


?>