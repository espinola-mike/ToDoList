<?php session_start();

require 'lib/Database.php';
require 'models/User.php';

if (isset($_SESSION['user'])) {
    header('Location: index.php');
}

$errors = [];

// Verificando metodo de envio de formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Seteando datos
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Posibles errores
    $error_email = '<span>Error en el Email</span>';
    $error_password = '<span>Error</span>';
    $error_db = '<span>Error</span>';
    // Expresiones regulares
    $reg_exp_email = '/^[a-zA-Z0-9-_.]+@[a-zA-Z0-9-_.]+(\.[a-zA-Z]{2,4}){1,2}?$/';
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

    // Verificacion validez de contraseña.
    if (!empty($password)) {
        // Evaluando la contraseña por medio de la expresion regular correspondiente.
        if (preg_match($reg_exp_pass, $password) == 0) {
            $errors['password'] = $error_password . ': ' .'Usuario o contraseña invalidos.';
        }
    }else {
        $errors['password'] = $error_password . ': ' .'Por favor complete la contraseña.';
    }

    if(empty($errors)){
        try{
            $pdo = new Database();
            $pdo = $pdo->connect();
            $sql = "SELECT * FROM users WHERE email = :email AND password = :password";
            $query = $pdo->prepare($sql);
            $query->execute([':email'=>$email, ':password'=>hash('sha512', $password)]);
            $user = $query->fetch();
            if (!$user) {
                $errors['db'] = $error_db . ': '. 'Usuario o contraseña invalidos.';
            }else{
                $_SESSION['user'] = $user['email'];
                header('Location: index.php');
            }
        }catch(PDOException $e){
            $errors['db'] = $error_db . ': '. 'Fallo en la conexión con la base de datos. <br><b>Tipo de error:</b>' . $e;
        }
    }

}

require 'views/login.view.php'

?>