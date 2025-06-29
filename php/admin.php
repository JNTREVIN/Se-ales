<?php
session_start(); // Iniciamos la sesión
if (!isset($_SESSION['user']) || !isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: ../sesion.html");
    exit();
}
// Código de inicio de sesión del administrador
$_SESSION['admin'] = true;
include("conexion.php");
$con = mysqli_connect($server, $user, $pass, $db);

$sqlClientes = "SELECT * FROM clientes";
$qClientes = mysqli_query($con, $sqlClientes);

$sqlCitas = "SELECT * FROM citas";
$qCitas = mysqli_query($con, $sqlCitas);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
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
<div class="titulo">
<h1 >Bienvenido admin</h1>
</div>
    

    <div class="contenedores">
        <h2>Clientes</h2>
        <div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Email</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col" colspan="2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($rowCliente = mysqli_fetch_array($qClientes)) : ?>
                        <tr>
                            <td scope="row"><?php echo $rowCliente['ID']; ?></td>
                            <td><?php echo $rowCliente['USUARIO']; ?></td>
                            <td><?php echo $rowCliente['NAME']; ?></td>
                            <td><?php echo $rowCliente['APELLIDO']; ?></td>
                            <td><?php echo $rowCliente['DIRECCION']; ?></td>
                            <td><?php echo $rowCliente['EMAIL']; ?></td>
                            <td><?php echo $rowCliente['TELEFONO']; ?></td>
                            <td><a class="btn btn-primary" id="botonInicio" href="editar.php?id=<?php echo $rowCliente['ID']; ?>">Editar</a></td>
                            <td><a class="btn btn-primary" id="botonInicio" href="eliminar.php?id=<?php echo $rowCliente['ID']; ?>" onclick="return confirmDelete()">Eliminar</a></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <button type="button" class="btn btn-danger" id="botonInicio" onclick="redirAgregarUsuario()">Agregar Usuario</button>
        </div>
    </div>

    <div class="contenedores">
        <br><br>
        <h2>Citas</h2>
        <div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">ID_Cliente</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Material</th>
                        <th scope="col">Kilos</th>
                        <th scope="col">Estatus</th>
                        <th scope="col" colspan="2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($rowCita = mysqli_fetch_array($qCitas)) : ?>
                        <tr>
                            <td scope="row"><?php echo $rowCita['IDcitas']; ?></td>
                            <td><?php echo $rowCita['ID']; ?></td>
                            <td><?php echo obtenerUsuario($rowCita['ID'], $con); ?></td>
                            <td><?php echo $rowCita['DIRECCION']; ?></td>
                            <td><?php echo $rowCita['FECHA']; ?></td>
                            <td><?php echo $rowCita['MATERIAL']; ?></td>
                            <td><?php echo $rowCita['KILOS']; ?></td>
                            <td><?php echo $rowCita['ESTATUS']; ?></td>
                            <td><a class="btn btn-primary" id="botonInicio" href="editarcitas.php?id=<?php echo $rowCita['IDcitas']; ?>">Editar</a></td>
                            <td><a class="btn btn-primary" id="botonInicio" href="eliminarcitas.php?id=<?php echo $rowCita['IDcitas']; ?>" onclick="return confirmDelete()">Eliminar</a></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <br><br>
            <button type="button" class="btn btn-danger" onclick="pdf()">Generar reporte</button>
            <button type="button" class="btn btn-danger"  onclick="redireccion()">Cerrar sesión</button>
        </div>
    </div>
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
    <script src="../js/admin.js"></script>
    <script>
        function redirAgregarUsuario(){
            location.href = "../formulario.html?admin=true";
            exit();
        }
        function pdf(){
            location.href = "./genera.php";
        }
</script>
</body>
</html>
<?php
function obtenerUsuario($idCliente, $con)
{
    $sql = "SELECT USUARIO FROM clientes WHERE ID = '$idCliente'";
    $q = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($q);
    return $row['USUARIO'];
}
?>