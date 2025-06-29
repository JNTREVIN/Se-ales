<?php
session_start(); // Iniciamos la sesión
if(!isset($_SESSION['user'])){
    header("Location: ../sesion.html");
    exit();
}

include("conexion.php");
$con = mysqli_connect($server, $user, $pass, $db);

if (!isset($_POST['id'])) {
    echo "ID de cliente no proporcionado.";
    exit();
}

$id = $_POST['id'];
$DIRECCION = $_POST['direccion'];
$FECHA = $_POST['date'];
$MATERIAL = $_POST['material'];
$KILOS = $_POST['kilos'];
$ESTATUS = "PENDIENTE";
//echo $id, $DIRECCION, $FECHA, $MATERIAL, $KILOS, $ESTATUS;

$sql = "INSERT INTO citas (ID, DIRECCION, FECHA, MATERIAL, KILOS, ESTATUS) 
        VALUES ('$id', '$DIRECCION', '$FECHA', '$MATERIAL', '$KILOS', '$ESTATUS')";
//echo $sql;
$q = mysqli_query($con, $sql);
if ($q) {
    echo "<script>alert('Cita creada correctamente'); window.location.href = './cliente.php?id=$id';</script>";
} else {
    $error = mysqli_error($con);
    echo "<script>alert('No se pudo crear la cita. Error: $error'); window.location.href = './cliente.php?id=$id';</script>";
}
?>
