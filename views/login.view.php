<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión | TODO App</title>
    <link rel="stylesheet" href="./static/css/main.css">
    <link rel="stylesheet" href="./static/fontawesome-free-6.4.0-web/css/all.min.css">
</head>
<body>
    <div class="container form">
        <div class="form">
            <div class="header">
                <h2>Incio de Sesión</h2>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" id="form">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Ingrese Email" value="<?php if(!empty($errors) && isset($email)) echo $email ?>" required>
                <label for="password">Contraseña</label>
                <div class="seePassword">
                    <input type="password" name="password" id="password" maxlength="16" placeholder="Ingrese contraseña" value="<?php if(!empty($errors) && isset($password)) echo $password ?>" required>
                    <div class="iconBox" id="see">
                        <fa-icon class="fa fa-eye"></fa-icon>
                    </div>
                </div>
                <div class="btnSubmit">
                    <button type="submit">Iniciar Sesión</button>
                </div>
            </form>
            <?php if(!empty($errors)): ?>
                <div class="errors">
                    <div class="errorHeader">
                        <h4>Error(s) Encontrados</h4>
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
            <span>¿Aún no estas registrado? <a href="http://localhost:84/ToDoList/register.php">Registrarse</a></span>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script type="text/javascript" src="./static/js/login.js"></script>
</body>
</html>