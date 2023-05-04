<?php session_start();

if (isset($_SESSION['user'])) {
    session_destroy();
    $_SESSION['user'] = array();
}

// Redireccion
header('Location: index.php');

?>