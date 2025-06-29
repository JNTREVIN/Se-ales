<?php
session_start();

// Verificar que exista una sesión y que sea un administrador
if (!isset($_SESSION['user']) || !isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: ../sesion.html");
    exit();
}

include("conexion.php");

// Obtener el ID del usuario a editar desde la URL
$id = $_GET['id'];

// Consultar la base de datos para obtener los datos del usuario con el ID proporcionado
$sql = "SELECT * FROM clientes WHERE ID='$id'";
$q = mysqli_query($con, $sql);
$row = mysqli_fetch_array($q);

// Verificar que se haya encontrado un usuario con ese ID
if (!$row) {
    // Redireccionar o mostrar un mensaje de error apropiado
    header("Location: ../error.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACTUALIZAR</title>
    <link rel="icon" href="Imagen/1.png" type="image/png">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="../src/diseñosForms.css">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="../index.html"><img src="../Imagen/1.png" style="height: 50px;" alt="Logo1"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../index.html">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../sesion.html">Servicios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#seccionFooter">Contacto</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="banner">
        <br>
        <h1>Editar usuario</h1>
    </div>
    <div class="formularioNuevoUsuario">
        <form action="update.php?id=<?php echo $id ?>" method="POST">
            <div class="card-body nuevoUsuario">
                <div class="form-group">
                    <label for="user">Usuario</label>
                    <input class="form-control" type="text" name="user" value="<?php echo $row['USUARIO']; ?>"><br>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label for="name">Nombre</label>
                        <input class="form-control" type="text" name="name" value="<?php echo $row['NAME']; ?>"><br>
                    </div>
                    <div class="col">
                        <label for="apellido">Apellido</label>
                        <input class="form-control" type="text" name="apellido" value="<?php echo $row['APELLIDO']; ?>"><br>
                    </div>
                </div>

                <div class="form-group">

                    <label for="direccion">Direccion</label>
                    <input class="form-control" type="text" name="direccion" value="<?php echo $row['DIRECCION']; ?>"><br>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="text" name="email" value="<?php echo $row['EMAIL']; ?>"><br>
                </div>
                <div class="form-group">

                    <label for="telefono">Telefono</label>
                    <input class="form-control" type="text" name="telefono" value="<?php echo $row['TELEFONO']; ?>"><br>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="botonInicio">Actualizar</button>
                    <button type="button" class="btn btn-danger"  onclick="redireccion()">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        function redireccion() {
            location.href = "admin.php";
        }
    </script>

    <!-- Footer -->
    <section id="seccionFooter">
        <footer class="footer">
            <div class="container">
                <a href="https://www.instagram.com/" target="_blank" class="social_link" id="f1">
                    <i class="bx bxl-instagram social_icon"></i>
                </a>
                <a href="https://es-la.facebook.com/" target="_blank" class="social_link">
                    <i class="bx bxl-facebook-circle social_icon"></i>
                </a>
                <a href="https://twitter.com/?lang=es" target="_blank" class="social_link">
                    <i class="bx bxl-twitter social_icon"></i>
                </a>
                <a href="https://www.tiktok.com/es/" target="_blank" class="social_link">
                    <i class="bx bxl-tiktok social_icon"></i>
                </a>
                <br>
                <p class="mb-0">RopaTech - Transformando moda en sostenibilidad. © 2024 Todos los derechos reservados.
                    <b>
                        <h6><a class="social_link tam" href="#">Aviso de privacidad</a> | <a class="social_link tam"
                                href="#">Términos de Servicio</a> | <a class="social_link tam" href="#">Contáctanos</a>
                        </h6>
                    </b>
                </p>
            </div>
        </footer>
    </section>
</body>

</html>