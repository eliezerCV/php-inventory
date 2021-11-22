<?php include_once("./includes/header.php");?>
<?php include_once("db.php");?>
<?php

    if (isset($_POST['update_product'])) {
        echo "saving";
        $id = $_GET['id'];
        $product = $_POST['product'];
        $category = $_POST['category'];
        $supplier = $_POST['supplier'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $is_active = ($_POST['is_active']=='on') ? 1 : 0;

        if ($product == "" || $category == "" || $supplier == "" || $price == "" || $stock == "" || $is_active == "" ) {
            die();
        }
        print json_encode(array($product, $category, $price, $stock, $is_active));
        
        $sql = "UPDATE PRODUCTS SET product=(?), idCategory=(?), idSupplier=(?), price=(?), stock=(?), is_active=(?) 
                WHERE productId=" . $id;

        $params = array($product, $category, $supplier, $price, $stock, $is_active);

        $stmt = sqlsrv_query( $conn, $sql, $params);
        if( $stmt === false ) {
            die( print_r( sqlsrv_errors(), true));
        } else {
            header("Location: index.php");
            die();
        }
        sqlsrv_close($conn);
    } else if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM PRODUCTS WHERE productId=?";
        $params = array($id);
        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
        $stmt = sqlsrv_query( $conn, $sql , $params, $options );

        if ($row_count = sqlsrv_num_rows( $stmt )) {
            $row = sqlsrv_fetch_array( $stmt);
            $product = $row['product'];
            $category = $row['idCategory'];
            $supplier = $row['idSupplier'];
            $price = $row['price'];
            $stock = $row['stock'];
            $is_active = $row['is_active'];
        }
    }
?>
    <div class="container-form">
        <div class="form-header">
            <h3>Actualizar producto </h3>
        </div>
        <form action="edit-product.php?id=<?php echo $id?>" method="POST">
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
                    ?>
                </select>
            </div>
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
                <input type="text" name="price" value="<?php echo $price?>">
            </div>
            <div class="form-elem">
                <label for="stock">Inventario actual</label>
                <input type="text" name="stock" value="<?php echo $stock?>">
            </div>
            <div class="form-elem">
                <?php
                    if ($is_active) echo "<input type='checkbox' name='is_active' checked>";
                    else echo "<input type='checkbox' name='is_active'>";
                ?>
                <label for="is_active">Visible al público</label>
            </div>
            <div class="form-elem save">
                <input type="submit" name="update_product" value="Actualizar">
            </div>
        </form>
    </div>


<?php include_once("./includes/footer.php");?>