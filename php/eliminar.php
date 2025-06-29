<?php
    include("conexion.php");
    $con = mysqli_connect($server, $user, $pass, $db);
    $cliente=$_GET['id'];
    $sql="DELETE FROM clientes WHERE ID='$cliente'";
    $q = mysqli_query($con, $sql);
    if($q){
        header("Location: ./admin.php");
    }else{
        echo "Error al eliminar";
    }
?>