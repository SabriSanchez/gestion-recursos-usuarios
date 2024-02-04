<?php

/**Este módulo gestionará enteramente toda operación que requiera conexion a la base de datos
 * Por diseño NUNCA se retornarán conexiones y SIEMPRE se cerrarán dentro de este mismo módulo 
 */

// CONFIGURACIÓN
$host = "";
$user = "";
$pass = "";
$db_name = "";


// METODOS PUBLICOS (crean y cierran la conexión)

function inicializar_bdd_si_no_existe()
{
    $con = abrir_conexion_primera_vez();
    $esquema = mysqli_query($con, "SELECT SCHEMA_NAME
                FROM INFORMATION_SCHEMA.SCHEMATA
                WHERE SCHEMA_NAME = '" . $GLOBALS["db_name"] . "';");

    if (mysqli_num_rows($esquema) == 0) { // Si existe
        inicializar_bdd($con);
    }
    cerrar_conexion($con);
}

function obtener_usuario($nombre, $hash_contrasena)
{
    $con = abrir_conexion();
    $usuario = mysqli_query($con, "SELECT id_usuario, nombre, tipo
        FROM usuario
        WHERE nombre='$nombre'
        AND pass = '$hash_contrasena';");
    cerrar_conexion($con);
    return obtener_array($usuario);
}

function obtener_reservas_bdd($usuario_id)
{
    $con = abrir_conexion();
    $reservas = mysqli_query($con, "SELECT r.id_reserva reserva, u.nombre nombre, e.nombre recurso, turno
    FROM reserva r, usuario u, recurso e
    WHERE r.usuario = u.id_usuario
    AND r.recurso = e.id_recurso
    AND u.id_usuario = $usuario_id;");
    cerrar_conexion($con);
    return $reservas;
}

function obtener_reservas_admin_bdd()
{
    $con = abrir_conexion();
    $reservas = mysqli_query($con, "SELECT r.id_reserva reserva, u.nombre nombre, e.nombre recurso, turno
        FROM reserva r, usuario u, recurso e
        WHERE r.usuario = u.id_usuario
        AND r.recurso = e.id_recurso;");
    cerrar_conexion($con);
    return $reservas;
}

function borrar_reservas_todas_bdd()
{
    $con = abrir_conexion();
    mysqli_query($con, "DELETE FROM reserva;");
    cerrar_conexion($con);
}

function borrar_reservas_usuario_bdd($usuario)
{
    $con = abrir_conexion();
    mysqli_query($con, "DELETE FROM reserva WHERE usuario = $usuario;");
    cerrar_conexion($con);
}

function borrar_reservas_bdd($reservas)
{
    $con = abrir_conexion();
    mysqli_query($con, "DELETE FROM reserva WHERE id_reserva IN ($reservas);");
    cerrar_conexion($con);
}

function obtener_recursos_bdd()
{
    $con = abrir_conexion();
    $recursos = mysqli_query($con, "SELECT id_recurso, nombre
        FROM recurso;");
    cerrar_conexion($con);
    return $recursos;
}

function crear_reserva_bdd($usuario, $recurso, $turno)
{
    $con = abrir_conexion();
    mysqli_query($con, "INSERT INTO reserva(usuario, recurso, turno)
        VALUE ('$usuario', '$recurso', '$turno');");
    cerrar_conexion($con);
}

function reserva_existe($recurso, $turno)
{
    $con = abrir_conexion();
    $reservas = mysqli_query($con, "SELECT id_reserva
                FROM reserva
                WHERE recurso = '$recurso'
                AND turno = '$turno'");

    if (mysqli_num_rows($reservas) == 0) { // Está libre
        cerrar_conexion($con);
        return false;
    } else { // Está ocupada
        cerrar_conexion($con);
        return true;
    }
}

function obtener_usuarios_bdd()
{
    $con = abrir_conexion();
    $usuario = mysqli_query($con, "SELECT id_usuario, nombre, pass, tipo
        FROM usuario;");
    cerrar_conexion($con);
    return $usuario;
}

function borrar_usuario_bdd($id)
{
    $con = abrir_conexion();
    mysqli_query($con, "DELETE FROM usuario WHERE id_usuario IN ($id);");
    cerrar_conexion($con);
}

function alta_usuario_bdd($nombre, $pass, $tipo)
{
    $con = abrir_conexion();
    mysqli_query($con, "INSERT INTO usuario(id_usuario, nombre, pass, tipo)
        VALUE (null, '$nombre', '$pass', '$tipo');");
    cerrar_conexion($con);
}

function modificar_usuario_bdd($id, $nombre, $pass, $tipo)
{
    $con = abrir_conexion();
    mysqli_query($con, "UPDATE usuario
        SET nombre='$nombre', pass='$pass', tipo='$tipo'
        WHERE id_usuario='$id';");
    cerrar_conexion($con);
}

function borrar_recurso_bdd($id)
{
    $con = abrir_conexion();
    mysqli_query($con, "DELETE FROM recurso WHERE id_recurso IN ($id);");
    cerrar_conexion($con);
}

function alta_recurso_bdd($nombre)
{
    $con = abrir_conexion();
    mysqli_query($con, "INSERT INTO recurso(id_recurso, nombre)
        VALUE (null, '$nombre');");
    cerrar_conexion($con);
}

function modificar_recurso_bdd($id, $nombre)
{
    $con = abrir_conexion();
    mysqli_query($con, "UPDATE recurso
        SET nombre='$nombre'
        WHERE id_recurso='$id';");
    cerrar_conexion($con);
}

// METODOS PRIVADOS (reusan la conexión)

function obtener_array($resultado)
{
    return mysqli_fetch_array($resultado);
}

function abrir_conexion_primera_vez()
{
    $con = mysqli_connect($GLOBALS["host"], $GLOBALS["user"], $GLOBALS["pass"]) or die("Error al conectar con la base de datos");
    return $con;
}

function abrir_conexion()
{
    $con = abrir_conexion_primera_vez();
    mysqli_select_db($con, $GLOBALS["db_name"]);
    return $con;
}

function cerrar_conexion($con)
{
    mysqli_close($con);
}

function inicializar_bdd($con)
{
    mysqli_query($con, "CREATE DATABASE " . $GLOBALS["db_name"] . ";");
    mysqli_select_db($con, $GLOBALS["db_name"]);

    mysqli_query($con, "CREATE TABLE usuario(id_usuario int primary key auto_increment, 
    nombre varchar(255), pass varchar(255), tipo int)");
    mysqli_query($con, "INSERT INTO usuario(nombre, pass, tipo) 
    VALUES ('admin', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', 0)");

    mysqli_query($con, "CREATE TABLE recurso(id_recurso int primary key auto_increment,
    nombre varchar(255))");
    mysqli_query($con, "INSERT INTO recurso(nombre)
    VALUES ('Recurso de prueba')");

    mysqli_query($con, "CREATE TABLE reserva(id_reserva int primary key auto_increment, 
    usuario int, foreign key(usuario) references usuario(id_usuario) ON DELETE CASCADE, recurso int, foreign key(recurso) 
    references recurso(id_recurso) ON DELETE CASCADE, turno int)");
}
