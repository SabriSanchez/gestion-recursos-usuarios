<!DOCTYPE html>
<html>

<head>
    <title>Prantalla-Usuario</title>
    <link rel="stylesheet" href="utiles/bootstrap.min.css">
</head>
<header>
    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand">GESTIÓN RECURSOS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<body>
    <?php
    session_start();
    control_acceso();
    require_once("controladores/recursos.php");
    require_once("controladores/reservas.php");
    require_once("controladores/reservas.php");
    echo "<div class='container'>
        <div class='row text-center p-3'><h3>Bienvenid@ a su página de usuario</h3></div>";
    echo "<div class='row p-3'>";
    require('vistas/tabla_reservas.php');
    echo "</div>";
    echo "<div class='row p-3'>";
    require('vistas/crear_reservas.php');
    echo "</div></div>";

    function control_acceso()
    {
        if ($_SESSION["usuario_tipo"] != "1") {
            $error_titulo = "Error de acceso";
            $error_mensaje = "Está intentando ingresar a una página a la que no tiene permiso";
            $pagina = "index.php";
            header("Location: vistas/errores.php?titulo=" . urlencode($error_titulo) . "&mensaje=" . urlencode($error_mensaje) . "&pagina=$pagina");
        }
    }
    ?>
    <script src="utiles/bootstrap.bundle.min.js"></script>
</body>

</html>