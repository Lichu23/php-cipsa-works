<?php 

    session_start();

    $_SESSION = array();

    //elimina cookies con id de session: PHPSESSID
    if(isset($_COOKIE[session_name()])) {
        setcookie(session_name(), "" , -1);
    }

    session_destroy();
    header("Location: inicio.php");
    die();
?>