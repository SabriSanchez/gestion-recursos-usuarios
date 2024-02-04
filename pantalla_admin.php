<!DOCTYPE html>
<html>

<head>
    <title>Prantalla-Admin</title>
    <link rel="stylesheet" href="./utiles/bootstrap.min.css" />
</head>
<header>
    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand">GESTIÓN DE RECURSOS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php if ($_GET['ver'] == 'recursos') {
                                                echo "active";
                                            }; ?>" aria-current="page" href="pantalla_admin.php?ver=recursos">Recursos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($_GET['ver'] == 'reservas') {
                                                echo "active";
                                            }; ?>" href="pantalla_admin.php?ver=reservas">Reservas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($_GET['ver'] == 'usuarios') {
                                                echo "active";
                                            }; ?>" href="pantalla_admin.php?ver=usuarios">Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Cerrar Sesión</a>
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

    $ver = '';
    if (isset($_GET['ver'])) {
        $ver = $_GET['ver'];
    }

    switch ($ver) {
        case 'recursos':
            require_once("controladores/recursos.php");
            require("vistas/tabla_recursos.php");
            break;
        case 'reservas':
            require_once("controladores/reservas.php");
            require("vistas/tabla_reservas.php");
            break;
        case 'usuarios':
            require_once("controladores/usuarios.php");
            require("vistas/tabla_usuarios.php");
            break;
    }

    function control_acceso()
    {
        if ($_SESSION["usuario_tipo"] != "0") {
            $error_titulo = "Error de acceso";
            $error_mensaje = "Está intentando ingresar a una página a la que no tiene permiso";
            $pagina = "index.php";
            header("Location: vistas/errores.php?titulo=" . urlencode($error_titulo) . "&mensaje=" . urlencode($error_mensaje) . "&pagina=$pagina");
        }
    }
    ?>
    <script src="./utiles/bootstrap.bundle.min.js"></script>
</body>

</html>