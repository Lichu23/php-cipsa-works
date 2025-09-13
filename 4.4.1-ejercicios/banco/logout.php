<?php
session_start();
require_once "logger.php";
if (isset($_SESSION["nombre"])) {
    registrarAcceso($_SESSION["nombre"] . " (logout)");
}
$_SESSION = [];
session_destroy();
header("Location: index.php");
die();
