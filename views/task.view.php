<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/home.css">
    <link rel="stylesheet" href="./static/fontawesome-free-6.4.0-web/css/all.min.css">
    <title>Home | Bandeja de Entrada</title>
</head>
<body>
<div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="./index.php">
                        <span class="icon"><font-aw-icon class="fa fa-home-user"></font-aw-icon></span>
                        <span class="title"><?php echo $user->getUserName(); ?></span>
                    </a>
                </li>
                <li>
                    <a href="./task.php?section=inbox">
                        <span class="icon"><font-aw-icon class="fa fa-inbox"></font-aw-icon></span>
                        <span class="title">Bandeja de entrada</span>
                        <span><?php echo count($allTasks) ?></span>
                    </a>
                </li>
                <li>
                    <a href="./task.php?section=today">
                        <span class="icon"><font-aw-icon class="fa fa-calendar-day"></font-aw-icon></span>
                        <span class="title">Hoy</span>
                        <span><?php echo count($todayTasks) ?></span>
                    </a>
                </li>
                <li>
                    <a href="./task.php?section=next">
                        <span class="icon"><font-aw-icon class="fa fa-calendar-days"></font-aw-icon></span>
                        <span class="title">Próximo</span>
                        <span><?php echo count($nextTasks) ?></span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><font-aw-icon class="fa fa-key"></font-aw-icon></span>
                        <span class="title">Password</span>
                    </a>
                </li>
                <li>
                    <a href="./close.php">
                        <span class="icon"><font-aw-icon class="fa fa-outdent"></font-aw-icon></span>
                        <span class="title">Cerrar Sesión</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- main -->
        <div class="main">
            <!-- Barra superior -->
            <div class="topbar">
                <div class="toggle">
                    <font-aw-icon class="fa fa-burger"></font-aw-icon>
                </div>
                <!-- Imagen de usuario -->
                <div class="user">
                    <?php if($user->getUserImage()): ?>
                        <img src="static/img/profiles/<?php echo $user->getUserImage() ?>" alt="User Image">
                    <?php else: ?>
                        <img src="./static/img/user.png" alt="User image">
                    <?php endif; ?>
                </div>
            </div>
            <!-- modal para gestion de perfil -->
                <div class="userModalConfig">
                    <div class="userInfo">
                        <div class="userImg">
                            <?php if($user->getUserImage()): ?>
                                <img src="static/img/profiles/<?php echo $user->getUserImage() ?>" alt="User Image">
                            <?php else: ?>
                                <img src="./static/img/user.png" alt="User image">
                            <?php endif; ?>
                            <img class="upload" src="./static/img/ionicons/camera.svg" alt="Camera image" title="Subir/Cambiar foto de perfil.">
                        </div>
                        <div class="userName">
                            <span><?php echo $user->getUserName(); ?></span>
                            <span><?php echo $user->getEmail(); ?></span>
                        </div>
                    </div>
                    <hr>
                    <div class="closeSession">
                        <a href="./close.php">
                            <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
                            <span class="title">Cerrar Sesión</span>
                        </a>
                    </div>
                </div>

            <!-- Tareas de usuario -->
            <div class="cardBox">
                <?php if(!empty($tasks)): ?>
                    <?php foreach($tasks as $task): ?>
                        <div class="card">
                            <div class="taskName"><?php echo $task['task_name']; ?></div>
                            <div class="taskDescription"><?php echo $task['task_description']; ?></div>
                            <div class="taskDate" data-taskdate="<?php echo $task['task_date']; ?>"></div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <h2>No Hay Tareas Pendientes</h2>
                <?php endif; ?>
            </div>

           
        </div> 
        <!-- main final -->
    </div>
    <!-- container final -->
            
        <!-- Modal con formulario para subir foto de perfil -->
            <div class="modalImageUpload">
                <div class="modalImageUpload-form">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                        <ul>
                            <li class="modalImageUpload-header">
                                <span class="close">
                                    <ion-icon name="close-circle-outline"></ion-icon>
                                </span>
                                <header><h2>Imagen de perfil</h2></header>
                            </li>
                            <li>
                                <div class="imageProfile">
                                    <?php if($user->getUserImage()): ?>
                                        <img src="static/img/profiles/<?php echo $user->getUserImage() ?>" alt="User Image">
                                    <?php else: ?>
                                        <img src="./static/img/user.png" alt="User image">
                                    <?php endif; ?>
                                </div>
                            </li>
                            <li class="inputFile">
                                <!-- <label for="image">Cambiar Foto de Perfil</label> -->
                                <input type="file" id="image" name="image" aria-label="Imagen a subir" title="No has seleccionado ninguna imagen" required>
                            </li>
                            <li class="inputSubmit">
                                <input type="submit" id="imageUpload" name="imageUpload" value="Subir Foto">
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
    
    <!-- <script type="module" src="/static/js/ionicons.esm.js"></script>
    <script nomodule src="/static/js/ionicons.js"></script> -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="static/js/moment.min.js"></script>
    <script src="static/js/moment.locale.es.js"></script>
    <script src="static/js/task.js"></script>
    <script>
        let toggle = document.querySelector('.toggle');
        let navigation = document.querySelector('.navigation');
        let main = document.querySelector('.main');

        toggle.addEventListener('click', ()=>{
            navigation.classList.toggle('active');
            main.classList.toggle('active');
        });


        // Agregar una clase hovered a un elemento de navegacion seleccionado

        let list = document.querySelectorAll('.navigation ul li');
        function activeLink() {
            list.forEach(item => {
                item.classList.remove('hovered');
                this.classList.add('hovered');
            });
        }
        list.forEach(item => {
            item.addEventListener('mouseover', activeLink);
        });
    </script>
    <script src="./static/js/home.js"></script>
</body>
</html>