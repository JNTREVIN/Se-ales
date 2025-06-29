<?php
    $server="localhost";
    $user="root";
    $pass="admin";
    $db="usuarios";
    $con = new mysqli($server, $user, $pass, $db);
    if($con->connect_error){
        die("Error en la conexión: " . $con->connect_error);
    }else{
        // echo "Conexión exitosa";
    }
    return $con;//Retornamos la conexión
?>