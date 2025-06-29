<?php
    include("conexion.php");
    $con = mysqli_connect($server, $user, $pass, $db);
    $IDcitas=$_GET['id'];
    $sql="DELETE FROM citas WHERE IDcitas='$IDcitas'";
    $q = mysqli_query($con, $sql);
    if($q){
        header("Location: ./admin.php");
    }else{
        echo "Error al eliminar";
    }
?>