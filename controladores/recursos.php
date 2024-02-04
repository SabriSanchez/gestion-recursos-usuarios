<?php

require_once("utiles/bdd.php");

function obtener_recursos()
{
    return obtener_recursos_bdd();
}

function alta_recurso($nombre)
{
    alta_recurso_bdd($nombre);
}

function borrar_recurso($id)
{
    borrar_recurso_bdd($id);
}

function modificar_recurso($id, $nombre)
{
    modificar_recurso_bdd($id, $nombre);
}
