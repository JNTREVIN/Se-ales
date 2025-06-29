<?php
    session_start();//Iniciamos la sesión
    if (!isset($_SESSION['user']) || !isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
        header("Location: ../sesion.html");
        exit();
    }
    include("conexion.php");
    $con = mysqli_connect($server, $user, $pass, $db);
    $id = $_GET['id'];
    $id = $_POST['id'];
    $DIRECCION = $_POST['direccion'];
    $FECHA = $_POST['fecha'];
    $MATERIAL = $_POST['material'];
    $KILOS = $_POST['kilos'];
    $ESTATUS = $_POST['estatus'];
    $sql="UPDATE citas SET DIRECCION='$DIRECCION', FECHA='$FECHA', MATERIAL='$MATERIAL', 
    KILOS='$KILOS', ESTATUS='$ESTATUS' WHERE IDcitas='$id'";
    $q = mysqli_query($con, $sql);
    if($q){
        header("Location: ./admin.php");
    }else{
        echo "Error al actualizar";
    }
?>