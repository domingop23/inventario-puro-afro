<?php
	
    // Connecting the data base
    $server = 'localhost';
    $user = 'root';
    $password = '';
    $data_base = 'inventario_puro_afro';

    $conexion = mysqli_connect($server, $user, $password, $data_base);

    if(!$conexion){
        echo "Connection error: ".mysqli_connect_error();
    }
?>