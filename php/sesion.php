<?php
session_start();
include("conexion.php");

$user = $_POST['user'];
$pass = $_POST['pass'];

$buscar = "SELECT * FROM clientes WHERE USUARIO='$user' AND password='$pass'";
$q = mysqli_query($con, $buscar);

if (mysqli_num_rows($q) > 0) {
    $row = mysqli_fetch_array($q);

    // Inicio de sesión exitoso, guardar datos en sesión
    $_SESSION['user'] = array(
        'id' => $row['ID'], // Guardar el ID del usuario en la sesión
        'usuario' => $user, // Guardar el nombre de usuario en la sesión si es necesario
        // Otros datos del usuario según tu aplicación
    );

    if (strcasecmp($user, "admin") == 0) { // Comparación de cadena insensible a mayúsculas y minúsculas
        $_SESSION['admin'] = true;
        header("Location: ./admin.php");
    } else {
        $ID = $row['ID'];
        header("Location: ./cliente.php?id=$ID");
    }
    exit();
} else {
    // Credenciales incorrectas, redirigir de vuelta a sesion.html con un parámetro de error
    header("Location: ../sesion.html?error=1");
    exit();
}
?>
