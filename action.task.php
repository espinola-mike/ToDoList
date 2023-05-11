<?php
require 'lib/Database.php';
require 'models/User.php';
require 'models/Task.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['finish_task'])) {
        Task::deleteTask($_GET['finish_task']);
    } else {
        Task::deleteTask($_GET['delete_task']);
    }
    header('Location: task.php?section='.$_GET['section']);
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateTask'])) {
    $task_name = $_POST['taskName'];
    $task_description = $_POST['taskDescription'];
    $task_date = $_POST['taskDate'];

    $errors = [];
    $error_task_name = '<span>Error de nombre de tarea:</span>';
    $error_task_description = '<span>Error de descripción de tarea:</span>';
    $error_task_date = '<span>Error de fecha de tarea:</span>';

    if (!empty($task_name)) {
        // Validando nombre de tarea
        $task_name = filter_var(trim($task_name), FILTER_SANITIZE_STRING);
    }else{
        $errors['task_name'] = $error_task_name . ' Completa el campo de nombre de tarea.';
    }

    if (!empty($task_description)) {
        // Validando descripcion de tarea
        $task_description = filter_var(trim($task_description), FILTER_SANITIZE_STRING);
    }else {
        $errors['task_description'] = $error_task_description . ' Completa el campo de descripción de tarea.';
    }

    if (!empty($task_date)) {
        // Validando la fecha de tarea
        $date_array = explode('-', $task_date);
        if (!checkdate(intval($date_array[1]), intval($date_array[2]), intval($date_array[0]))) {
            $errors['task_date'] = $error_task_date . ' La fecha introducida es inválida.';
        }
    }else{
        $errors['task_date'] = $error_task_date . ' Completa el campo de fecha de tarea.';
    }

    // Si no existen errores
    if (empty($errors)) {
        $task = Task::newTask($_POST);
        $task->updateTask($_POST['taskId']);
        header('Location: task.php?section='.$_POST['section']);
    }
}

?>