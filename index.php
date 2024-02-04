<?php
session_start();
$_SESSION["usuario_id"] = null;
$_SESSION["usuario_tipo"] = null;

require("utiles/bdd.php");
inicializar_bdd_si_no_existe();

require("vistas/login.html");
