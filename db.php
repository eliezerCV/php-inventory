<?php

$serverName = "ELIEZER-LAPTOP\SQLEXPRESS";
$connectionInfo = array( "Database"=>"DB_VENTAS", "UID"=>"php", "PWD"=>"123");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
     // echo "Conexión establecida.<br />";
}else{
     echo "Conexión no se pudo establecer.<br />";
     die( print_r( sqlsrv_errors(), true));
}

?>