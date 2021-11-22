<?php include_once("./includes/header.php");?>

    <div class="container-form">
        <div class="form-header">
            <h3>Registrar nuevo producto</h3>
        </div>
        <form action="save_product.php" method="post">
            <div class="form-elem">
                <label for="product">Producto</label>
                <input type="text" name="product" placeholder="nombre del producto">
            </div>
            <div class="form-elem">
                <label for="category">Categoría</label>
                <select name="category">
                    <?php
                        include("db.php");

                        $sql = "SELECT * FROM CATEGORIES";
                        $params = array();
                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                        $stmt = sqlsrv_query( $conn, $sql , $params, $options );
                        
                        while( $row = sqlsrv_fetch_array( $stmt) ) {
                            echo "<option value='" . $row['categoryId']. "' >" . $row['category'] . "</option>";
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