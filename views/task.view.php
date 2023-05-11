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
    <!-- Contenido principal -->
    <div class="container">
        <!-- Menu lateral o aside -->
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon"><fa-icon class="fa fa-user-circle"></fa-icon></span>
                        <span class="title"><?php echo $user->getUserName(); ?></span>
                    </a>
                </li>
                <li>
                    <a href="./index.php">
                        <span class="icon"><fa-icon class="fa fa-home-user"></fa-icon></span>
                        <span class="title">Inicio</span>
                    </a>
                </li>
                <li>
                    <a href="./task.php?section=inbox">
                        <span class="icon"><fa-icon class="fa fa-inbox"></fa-icon></span>
                        <span class="title">Bandeja de entrada</span>
                        <span><?php echo count($allTasks) ?></span>
                    </a>
                </li>
                <li>
                    <a href="./task.php?section=today">
                        <span class="icon"><fa-icon class="fa fa-calendar-day"></fa-icon></span>
                        <span class="title">Hoy</span>
                        <span><?php echo count($todayTasks) ?></span>
                    </a>
                </li>
                <li>
                    <a href="./task.php?section=next">
                        <span class="icon"><fa-icon class="fa fa-calendar-days"></fa-icon></span>
                        <span class="title">Próximo</span>
                        <span><?php echo count($nextTasks) ?></span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><fa-icon class="fa fa-key"></fa-icon></span>
                        <span class="title">Password</span>
                    </a>
                </li>
                <li>
                    <a href="./close.php">
                        <span class="icon"><fa-icon class="fa fa-sign-out"></fa-icon></span>
                        <span class="title">Cerrar Sesión</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- aside -->

        <!-- main -->
        <div class="main">
            <!-- Barra superior -->
            <div class="topbar">
                <div class="toggle">
                    <fa-icon class="fa fa-bars"></fa-icon>
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
                            <fa-icon class="upload fa fa-camera" title="Subir/Cambiar foto de perfil."></fa-icon>
                        </div>
                        <div class="userName">
                            <span><?php echo $user->getUserName(); ?></span>
                            <span><?php echo $user->getEmail(); ?></span>
                        </div>
                    </div>
                    <hr>
                    <div class="closeSession">
                        <a href="./close.php">
                            <span class="icon"><fa-icon class="fa fa-sign-out"></fa-icon></span>
                            <span class="title">Cerrar Sesión</span>
                        </a>
                    </div>
                </div>

            <!-- Tareas de usuario -->
            <div class="cardBox">
                <?php if(!empty($tasks)): ?>
                    <?php foreach($tasks as $task): ?>
                        <div class="card">
                            <div class="cardInfo">
                                <div class="taskName"><?php echo $task['task_name']; ?></div>
                                <div class="taskDescription"><?php echo $task['task_description']; ?></div>
                                <div class="taskDate" data-taskdate="<?php echo $task['task_date']; ?>"></div>
                            </div>
                            <div class="taskActions disabled">
                                <a href="./action.task.php?finish_task=<?php echo $task['id']; ?>&section=<?php echo $_GET['section']; ?>" title="Tarea Finalizada">
                                    <span class="icon"><fa-icon class="fa fa-check-square"></fa-icon></span>
                                </a>
                                <a href="./action.task.php?delete_task=<?php echo $task['id']; ?>&section=<?php echo $_GET['section']; ?>" title="Eliminar Tarea">
                                    <span class="icon"><fa-icon class="fa fa-delete-left"></fa-icon></span>
                                </a>
                                <a class="editTask" data-id="<?php echo $task['id']; ?>" data-section="<?php echo $_GET['section']; ?>" href="#" title="Editar Tarea">
                                    <span class="icon"><fa-icon class="fa fa-pencil-square"></fa-icon></span>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <template id="newTaskForm">
                        <div class="newTaskForm">
                            <form action="./action.task.php" method="POST">
                                <input class="taskName" type="text" name="taskName" placeholder="Nombre de la tarea" maxlength="100" required>
                                <textarea class="taskDescription" name="taskDescription" placeholder="Descripción" maxlength="500" required></textarea>
                                <div class="dateSubmitContainer">
                                    <input class="taskDate" type="date" name="taskDate" min="<?php echo date('Y-m-d'); ?>" required>
                                    <div class="btnTaskContainer">
                                        <button class="btnCancelTask">Cancelar</button>
                                        <input class="btnAddTask" type="submit" name="updateTask" value="Añadir tarea">
                                    </div>
                                </div>
                                <div class="hiddenInputs">
                                    <input type="text" name="section" id="section">
                                    <input type="number" name="taskId" id="taskId">
                                </div>
                            </form>
                        </div>
                    </template>
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
                                    <fa-icon class="fa fa-window-close"></fa-icon>
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
                            <li class="input">
                                <div class="inputFile">
                                    <input type="file" id="inputImage" name="image" accept="image/*" aria-label="Imagen a subir" title="No has seleccionado ninguna imagen" required>
                                    <button id="btnInputImage" class="btnInputImage">
                                        <span class="icon"><fa-icon class="fa fa-upload"></fa-icon></span>
                                        <span>Selecciona una imagen</span>
                                    </button>
                                </div>
                                <div class="inputSubmit">
                                    <input type="submit" id="imageUpload" name="imageUpload" value="Subir Foto">
                                </div>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
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
    <script src="./static/js/uploadimage.js"></script>

</body>
</html>