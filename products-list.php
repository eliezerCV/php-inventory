<div class="container">
    <div class="header-table">
        <h3>Lista de productos</h3>
        <a href="new-product.php">Nuevo Producto</a>
    </div>
    <div class="table">
        <div class="table-header">
            <div class="header-elem">
                <span>ID</span>
            </div>
            <div class="header-elem">
                <span>Producto</span>
            </div>
            <div class="header-elem">
                <span>Categoría</span>
            </div>
            <div class="header-elem">
                <span>Proveedor</span>
            </div>
            <div class="header-elem">
                <span>Precio</span>
            </div>
            <div class="header-elem">
                <span>Stock</span>
            </div>
            <div class="header-elem">
                <span>Estado</span>
            </div>
            <div class="header-elem">
                <span>Acción</span>
            </div>
        </div>
        
        <div class="table-body">
            <?php
                require("db.php");

                $sql = "SELECT productId, product, price, stock, is_active, S.supplier, c.category 
                            FROM PRODUCTS P
                            INNER JOIN SUPPLIERS S
                            ON P.idSupplier=S.supplierId
                            INNER JOIN CATEGORIES C
                            ON P.idCategory=C.categoryId";
                $params = array();
                $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                $stmt = sqlsrv_query( $conn, $sql , $params, $options );

                $row_count = sqlsrv_num_rows( $stmt );
                
                $class = "";
                $counter = 1;
                while( $row = sqlsrv_fetch_array( $stmt) ) {
                    // print json_encode($row);
                    if($counter%2==0) $class="diff";
                    echo "<div class='body-elem ". $class."'>";
                        echo "<span>" . $row['productId'] . "</span>";
                        echo "<span>" . $row['product'] . "</span>";
                        echo "<span>" . $row['category'] . "</span>";
                        echo "<span>" . $row['supplier'] . "</span>";
                        echo "<span>" . $row['price'] . "</span>";
                        echo "<span>" . $row['stock'] . "</span>";
                        if ($row['is_active']) echo "<span class='active'>Activo</span>";
                        else echo "<span class='no-active'>Inactivo</span>";
                        echo "<span>";
                        echo "<a href='edit-product.php?id=". $row['productId']."'>editar | </a>";
                        echo "<a href='edit-product.php'>eliminar</a>";
                        echo "</span>";
                        
                    echo "</div>";
                    $counter++;
                    $class = "";
                }

                sqlsrv_close($conn);
            ?>
        </div>

    </div>
</div>