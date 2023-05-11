<?php session_start();
    // Comprobando existencia de session activa
    if (isset($_SESSION['user'])) {
        // Ir al home o pagina principal
        header('Location: home.php');
    } else{
        // Ir a iniciar sesión
        header('Location: login.php');
    }

?>