<?php
session_start(); // Iniciamos la sesión
if (!isset($_SESSION['user'])) {
    header("Location: ../sesion.html");
    exit();
}
$id = $_GET['id'];
    if ($_SESSION['user']['id'] != $id) {
        echo "No tienes permiso para acceder a este cliente.";
        exit();
    }
include("conexion.php");
$con = mysqli_connect($server, $user, $pass, $db);
if (!isset($_GET['id'])) {
    echo "ID de cliente no proporcionado.";
    exit();
}
$id = $_GET['id'];
$sql = "SELECT * FROM clientes WHERE ID = '$id'";
$q = mysqli_query($con, $sql);
if (mysqli_num_rows($q) == 0) {
    echo "Cliente no encontrado.";
    exit();
}
$row = mysqli_fetch_array($q);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GENERAR CITA</title>
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
        <br><br>
        <h1>Generar cita</h1>
    </div>

    <div class="formularioNuevoUsuario">
        <form action="./citas.php" method="POST" onsubmit="return validarFormulario()">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="card-body nuevoUsuario">
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Direccion" name="direccion" id="direccion"><br>
                </div>
                <div class="form-group">
                    <input class="form-control" type="date" name="date" id="date"><br>
                </div>
                <div class="form-row">
                    <div class="col">
                        <input class="form-control" type="text" placeholder="Material" name="material" id="material"><br>
                    </div>
                    <div class="col">
                        <input class="form-control" type="number" placeholder="Kilogramos" name="kilos" id="kilos"><br>
                    </div>
                </div>
                <div class="form-group">
                    <input class="form-control" type="tel" placeholder="Telefono" name="telefono" id="telefono"><br>
                </div>
                <div class="form-group">

                    <button type="submit" class="btn btn-primary" id="botonInicio"> Agendar cita</button>
                    <button type="button" class="btn btn-danger" onclick="re(<?php echo $id; ?>)">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
    <div>
    </div>
    <script>
        function re(id) {
            location.href = "./cliente.php?id=" + id;
        }
        function validarFormulario() {
            var date = document.getElementById("date").value;
            var material = document.getElementById("material").value;
            var kilos = document.getElementById("kilos").value;
            var direccion = document.getElementById("direccion").value;
            var telefono = document.getElementById("telefono").value;
            if (date === "" || material === "" ||kilos === "" || direccion === "" || email === "" || telefono === "") {
                alert("Todos los campos deben estar llenos");
                return false;
            }
            return true;
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