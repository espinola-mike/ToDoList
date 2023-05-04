<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro | TODO App</title>
    <link rel="stylesheet" href="./static/css/main.css">
</head>
<body>
    <div class="container form">
        <div class="form">
            <div class="header">
                <h2>Registro</h2>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" id="form">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Ingrese Email" value="<?php if(!empty($errors) && isset($email)) echo $email ?>" required>

                <label for="user_name">Usuario</label>
                <input type="text" name="user_name" id="user_name" maxlength="16" placeholder="Ingrese Nombre de Usuario" value="<?php if(!empty($errors) && isset($user_name)) echo $user_name ?>" required>
                
                <label for="password1">Contraseña</label>
                <div>
                    <input type="password" name="password1" id="password1" maxlength="16" placeholder="Ingrese contraseña" value="<?php if(!empty($errors) && isset($password1)) echo $password1 ?>" required>
                </div>
                
                <label for="password2">Repetir contraseña</label>
                <div class="seePassword">
                    <input type="password" name="password2" id="password2" maxlength="16" placeholder="Repita la contraseña" value="<?php if(!empty($errors) && isset($password2)) echo $password2 ?>" required>
                    <div class="iconBox" id="see">
                            <ion-icon name="eye-outline"></ion-icon>
                    </div>
                </div>
                
                <div class="btnSubmit">
                    <button type="submit">Registrar</button>
                </div>
            </form>
            
            <?php if(!empty($errors)): ?>
                <div class="errors">
                    <div class="errorHeader">
                        <h4>Error</h4>
                    </div>
                    <div>
                        <ul>
                            <?php foreach($errors as $error): ?>
                                <li><?php echo $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="go_to_form">
            <span>¿Ya tienes cuenta? <a href="http://localhost:84/ToDoList/login.php">Iniciar Sesión</a></span>
        </div>
    </div>
    
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- TIPS: la ruta del archivo register.js se escribe con respecto al archivo register.php y no register.view.php -->
    <script type="text/javascript" src="./static/js/register.js"></script>


</body>
</html>