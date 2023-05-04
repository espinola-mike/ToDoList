<?php session_start();

require 'models/User.php';

// Si existe una sesion activa ir a index.php
if (isset($_SESSION['user'])) {
    header('Location: index.php');
}

$errors = [];

// Verificacion de todos los datos enviados a traves del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Seteando datos
    $email = $_POST['email'];
    $user_name = $_POST['user_name'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    // Posibles errores
    $error_email = '<span>Error en el Email</span>';
    $error_user_name = '<span>Error en el Nombre de Usuario</span>';
    $error_password = '<span>Error de Contraseña</span>';
    $error_db = '<span>Error al Crear Usuario</span>';
    // Expresiones regulares
    $reg_exp_email = '/^[a-zA-Z0-9-_.]+@[a-zA-Z0-9-_.]+(\.[a-zA-Z]{2,4}){1,2}?$/';
    $reg_exp_user_name = '/^([a-zA-Z0-9-_.!]+){8,16}?$/';
    $reg_exp_pass = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&#.$($)$-$_])[A-Za-z\d$@$!%*?&#.$($)$-$_]{8,16}$/';

    // Saneamiento de los datos del usuario
    // Verificacion de email
    if (!empty($email)) {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || preg_match($reg_exp_email, $email) == 0) {
            $errors['email'] = $error_email . ': ' . 'Por favor ingresa un correo válido.';
        }
    }else {
        $errors['email'] = $error_email . ': ' .'Por favor ingresa un correo.';
    }

    // Verificacion de nombre de usuario
    if (!empty($user_name)) {
        $user_name = trim($user_name);
        $user_name = filter_var($user_name, FILTER_SANITIZE_STRING);
        if (strpos($user_name,' ') || preg_match($reg_exp_user_name, $user_name) == 0) {
            $errors['user_name'] = $error_user_name . ': ' .'Los espacios no estan permitidos.';
        }
    }else {
        $errors['user_name'] = $error_user_name . ': ' .'Por favor ingrese un nombre de usuario.';
    }

    // Verificacion de contraseña.
    if (!empty($password1) && !empty($password2)) {
        // Evaluando la contraseña por medio de la expresion regular correspondiente.
        if (preg_match($reg_exp_pass, $password1) == 0 || preg_match($reg_exp_pass, $password2) == 0) {
            $errors['password'] = $error_password . ': ' .'La contraseña no puede contener espacios.';
        }else {
            // Verificando si las contraseñas son iguales.
            if ($password1 != $password2) {
                $errors['password'] = $error_password . ': ' .'Las contraseñas ingresadas no coinciden.';
            }
        }
    }else {
        $errors['password'] = $error_password . ': ' .'Por favor complete la contraseña.';
    }

    if (empty($errors)) {
        $user = User::newUser($_POST);
        $query = $user->createUser();
        if($query){
            header('Location: login.php');
        }else{
            $errors['db'] = $error_db . ': ' . 'Intentelo nuevamente.';
        }
    }
    
}

require 'views/register.view.php';

?>