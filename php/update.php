<?php
    session_start();//Iniciamos la sesión
    if (!isset($_SESSION['user']) || !isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
        header("Location: ../sesion.html");
        exit();
    }
    include("conexion.php");
    $con = mysqli_connect($server, $user, $pass, $db);
    $id = $_GET['id'];
    $usuario=$_POST['user'];
    $nombre=$_POST['name'];
    $apellido=$_POST['apellido'];
    $direccion=$_POST['direccion'];
    $email=$_POST['email'];
    $telefono=$_POST['telefono'];
    $sql="UPDATE clientes SET USUARIO='$usuario', NAME='$nombre', 
    APELLIDO='$apellido', DIRECCION='$direccion', EMAIL='$email', 
    TELEFONO='$telefono' WHERE ID='$id'";
    $q = mysqli_query($con, $sql);
    if($q){
        header("Location: ./admin.php");
    }else{
        echo "Error al actualizar";
    }