<?php

require_once("utiles/bdd.php");

function login_usuario($nombre, $contrasena)
{
    $hash_contrasena = hash("sha512", $contrasena);
    $usuario = obtener_usuario($nombre, $hash_contrasena);
    if ($usuario == null) { // NO SE ENCUENTRA EL USUARIO
        $error_titulo = "Credenciales incorrectas";
        $error_mensaje = "Nombre de usuario y/o contraseña incorrectos";
        $pagina = "index.php";
        header("Location: vistas/errores.php?titulo=" . urlencode($error_titulo) . "&mensaje=" . urlencode($error_mensaje) . "&pagina=$pagina");
    } else {
        $_SESSION["usuario_id"] = $usuario["id_usuario"];
        $_SESSION["usuario_tipo"] = $usuario["tipo"];
        redireccionar_segun_tipo();
    }
}

function obtener_usuarios()
{
    return obtener_usuarios_bdd();
}

function borrar_usuario($id)
{
    return borrar_usuario_bdd($id);
}

function alta_usuario($nombre, $contrasena, $tipo)
{
    $hash_contrasena = hash("sha512", $contrasena);
    return alta_usuario_bdd($nombre, $hash_contrasena, $tipo);
}

function modificar_usuario($id, $nombre, $contrasena, $tipo)
{
    $hash_contrasena = hash("sha512", $contrasena);
    return modificar_usuario_bdd($id, $nombre, $hash_contrasena, $tipo);
}
