<?php include_once("./includes/header.php");?>
<?php include_once("db.php");?>
<?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM PRODUCTS WHERE productId=?";
        $params = array($id);
        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
        $stmt = sqlsrv_query( $conn, $sql , $params, $options );

        if ($row_count = sqlsrv_num_rows( $stmt )) {
            $row = sqlsrv_fetch_array( $stmt);
            $product = $row[2];
            $category = $row['idCategory'];
            $price = $row['price'];
            $stock = $row['stock'];
            $is_active = $row['is_active'];
        }
;    }
?>
    <div class="container-form">
        <div class="form-header">
            <h3>Actualizar producto </h3>
        </div>
        <form action="update_product.php" method="post">
            <div class="form-elem">
                <label for="product">Producto</label>
                <input type="text" name="product" value="<?php echo $product?>" placeholder="nombre del producto">
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
                            if($row['categoryId'] == $category) echo "<option value='" . $row['categoryId']. "' selected>" . $row['category'] . "</option>";
                            else echo "<option value='" . $row['categoryId']. "' >" . $row['category'] . "</option>";
                        }
                        sqlsrv_close($conn);
                    ?>
                </select>
            </div>
            <div class="form-elem">
                <label for="price">Precio de venta</label>
                <input type="text" name="price" value="<?php echo $price?>">
            </div>
            <div class="form-elem">
                <label for="stock">Inventario actual</label>
                <input type="text" name="stock" value="<?php echo $stock?>">
            </div>
            <div class="form-elem">
                <?php
                    if ($is_active) echo "<input type='checkbox' name='is_acrive' checked>";
                    else echo "<input type='checkbox' name='is_acrive'>";
                ?>
                <label for="is_active">Visible al público</label>
            </div>
            <div class="form-elem save">
                <input type="submit" name="update_product" value="Actualizar">
            </div>
        </form>
    </div>


<?php include_once("./includes/footer.php");?>