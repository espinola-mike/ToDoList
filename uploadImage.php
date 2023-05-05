<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['imageUpload']) && !empty($_FILES)) {
    $image = $_FILES['image'];
    $check = getimagesize($image['tmp_name']);
    if($check) {
        // definiendo ruta de guardado
        $path = 'static/img/profiles/';
        // definiendo ruta de guardado/subida completo
        $upload_path = $path . $image['name'];
        // funcion que mueve el archivo a la ruta especificada
        move_uploaded_file($image['tmp_name'], $upload_path);
        // actualizando modelo y base de datos
        $user->setUserImage($image['name']);
        $user->updateUser();
        
        header('Location: index.php');
    }else{
        $error = "El archivo subido no es una imagen o es muy pesado.";
    }
}

?>