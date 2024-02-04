<?php
session_start();
require_once("controladores/usuarios.php");

$accion = $_POST['accion'];
switch ($accion) {
    case 'login':
        $nombre = $_POST['nombre'];
        $contrasena = $_POST['contrasena'];
        login_usuario($nombre, $contrasena);
        break;

    case 'borrar_reserva':
        require("controladores/reservas.php");
        if (isset($_POST['borrar_seleccionado'])) {
            $reservas = implode(",", $_POST['reservas']);
            borrar_reservas($reservas);
        } else if (isset($_POST['borrar_todo'])) {
            borrar_reservas_todas();
        }
        redireccionar_segun_tipo();
        break;

    case 'crear_reserva':
        require("controladores/reservas.php");
        crear_reserva($_POST["recurso"], $_POST["turno"]);
        redireccionar_segun_tipo('reservas');
        break;

    case 'gestionar_usuarios':
        if (isset($_POST['alta'])) {
            alta_usuario($_POST['nuevo_nombre'], $_POST['nueva_contrasena'], $_POST['nuevo_tipo']);
        }
        if (isset($_POST['modificar'])) {
            modificar_usuario($_POST['usuario'], $_POST['nuevo_nombre'], $_POST['nueva_contrasena'], $_POST['nuevo_tipo']);
        }
        if (isset($_POST['borrar'])) {
            borrar_usuario($_POST['usuario']);
        }
        redireccionar_segun_tipo('usuarios');
        break;

    case 'gestionar_recursos':
        require("controladores/recursos.php");
        if (isset($_POST['alta'])) {
            alta_recurso($_POST['nuevo_nombre']);
        }
        if (isset($_POST['modificar'])) {
            modificar_recurso($_POST['recurso'], $_POST['nuevo_nombre']);
        }
        if (isset($_POST['borrar'])) {
            borrar_recurso($_POST['recurso']);
        }
        redireccionar_segun_tipo('recursos');
        break;
}

function redireccionar_segun_tipo($destino = '')
{
    if ($_SESSION["usuario_tipo"] == "0") { // ES ADMIN
        switch ($destino) {
            case 'reservas':
                header("Location: pantalla_admin.php?ver=reservas");
                break;
            case 'usuarios':
                header("Location: pantalla_admin.php?ver=usuarios");
                break;
            case 'recursos':
                header("Location: pantalla_admin.php?ver=recursos");
                break;
            default:
                header("Location: pantalla_admin.php?ver=reservas");
                break;
        }
    } else { // NO ES ADMIN
        header("Location: pantalla_usuario.php");
    }
}
