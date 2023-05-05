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
$tasks = Task::fetchAllTasks(User::getUserId($email));

require 'uploadImage.php'; # Script encargado de subir foto de perfil
require 'addTask.php'; # Script encargado de recibir datos de la tarea desde el formulario y registrarlo en la base de datos
require 'views/home.view.php'; # Plantilla o vista del home


?>