<?php

$serverName = "ELIEZER";
$connectionInfo = array( "Database"=>"DB_INVENTARIOS", "UID"=>"eliezer", "PWD"=>"bastardog");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
    //  echo "Conexión establecida.<br />";
}else{
     echo "Conexión no se pudo establecer.<br />";
     die( print_r( sqlsrv_errors(), true));
}

?>