<?php include_once("./includes/header.php");?>
<?php include_once("db.php");?>

<?php

if (isset($_POST['save_product'])) {
    $product = $_POST['product'];
    $category = $_POST['category'];
    $supplier = $_POST['supplier'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $is_active = ($_POST['is_active']=='on') ? 1 : 0;

    if ($product == "" || $category == "" || $price == "" || $stock == "" || $is_active == "" ) die();
    
    $sql = "INSERT INTO PRODUCTS (product, idCategory, idSupplier, price, stock, is_active) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $params = array($product, $category, $supplier, $price, $stock, $is_active);

    $stmt = sqlsrv_query( $conn, $sql, $params);
    if( $stmt === false ) {
        die( print_r( sqlsrv_errors(), true));
    } else {
        header("Location: ./");
        die();
    }
}

?>

    <div class="container-form">
        <div class="form-header">
            <h3>Registrar nuevo producto</h3>
        </div>
        <form action="new-product.php" method="POST">
            <div class="form-elem">
                <label for="product">Producto</label>
                <input type="text" name="product" placeholder="nombre del producto">
            </div>
            <div class="form-elem">
                <label for="category">Categoría</label>
                <select name="category">
                    <?php

                        $sql = "SELECT * FROM CATEGORIES";
                        $params = array();
                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                        
                        while( $row = sqlsrv_fetch_array( $stmt) ) {
                            echo "<option value='" . $row['categoryId']. "' >" . $row['category'] . "</option>";
                        }
                    ?>
                </select>
            </div><!--CATEGORIAS-->

            <div class="form-elem">
                <label for="supplier">Proveedor</label>
                <select name="supplier">
                    <?php

                        $sql = "SELECT * FROM SUPPLIERS";
                        $params = array();
                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                        
                        while( $row = sqlsrv_fetch_array( $stmt) ) {
                            echo "<option value='" . $row['supplierId']. "' >" . $row['supplier'] . "</option>";
                        }
                        sqlsrv_close($conn);
                    ?>
                </select>
            </div>
            <div class="form-elem">
                <label for="price">Precio de venta</label>
                <input type="text" name="price" placeholder="Precio del producto">
            </div>
            <div class="form-elem">
                <label for="stock">Inventario actual</label>
                <input type="text" name="stock" placeholder="inventario actual">
            </div>
            <div class="form-elem">
                <input type="checkbox" name="is_active" checked>
                <label for="is_active">Visible al público</label>
            </div>
            <div class="form-elem save">
                <input type="submit" name="save_product" value="Guardar">
            </div>
        </form>
    </div>
<?php include_once("./includes/footer.php");?>