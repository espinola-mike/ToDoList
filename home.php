<?php session_start();

date_default_timezone_set('America/Caracas');

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
}

require 'models/User.php';
$email = $_SESSION['user'];
$user = User::getUserByEmail($email);
require 'uploadImage.php';


require 'views/home.view.php';


?>