<?php

require_once("utiles/bdd.php");

function obtener_resevas()
{
    if ($_SESSION["usuario_tipo"] == "0") {
        return obtener_reservas_admin_bdd();
    } else {
        return obtener_reservas_bdd($_SESSION["usuario_id"]);
    }
}

function borrar_reservas_todas()
{
    if (isset($_POST['borrar_todo']) && $_SESSION["usuario_tipo"] == "0") {
        borrar_reservas_todas_bdd("");
    }
    if (isset($_POST['borrar_todo']) && $_SESSION["usuario_tipo"] == "1") {
        borrar_reservas_usuario_bdd($_SESSION["usuario_id"]);
    }
}

function borrar_reservas($reservas)
{
    borrar_reservas_bdd($reservas);
}

function crear_reserva($recurso, $turno)
{
    if (reserva_existe($recurso, $turno)) {
        $error_titulo = "Recurso no disponible";
        $error_mensaje = "El recurso está ocupado en ese turno, intente en otro horario";
        $pagina = "pantalla_usuario.php";
        header("Location: vistas/errores.php?titulo=" . urlencode($error_titulo) . "&mensaje=" . urlencode($error_mensaje) . "&pagina=$pagina");
    } else {
        crear_reserva_bdd($_SESSION["usuario_id"], $recurso, $turno);
    }
}
