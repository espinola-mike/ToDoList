<?php session_start();

date_default_timezone_set('America/Caracas');

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
}
require 'lib/Database.php';
require 'models/User.php'; # Requiriendo el modelo user
require 'models/Task.php';

$email = $_SESSION['user']; # Tomando email desde la sesion activa
$user = User::getUserByEmail($email); # Instanciando un objeto de la clase usuario a traves del email

// Consultando tareas
$allTasks = Task::getAllTasks(User::getUserId($email));
$todayTasks = Task::getTodayTasks(User::getUserId($email));
$nextTasks = Task::getNextTasks(User::getUserId($email));

// Comprobando la seccion seleccionada
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    switch ($_GET['section']) {
        case 'inbox':
            $tasks = &$allTasks;
            break;

        case 'today':
            $tasks = &$todayTasks;
            break;

        case 'next':
            $tasks = &$nextTasks;
            break;
        
        default:
            header('Location: index.php');
            break;
    }
}

require 'uploadImage.php'; # Script encargado de subir foto de perfil
require 'views/task.view.php'; # Plantilla o vista del inbox


?>