<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/home.css">
    <title>Home</title>
</head>
<body>
<div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon"><ion-icon name="person-add-outline"></ion-icon></span>
                        <span class="title"><?php echo $user->getUserName(); ?></span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><ion-icon name="people-outline"></ion-icon></span>
                        <span class="title">Customers</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><ion-icon name="chatbox-ellipses-outline"></ion-icon></span>
                        <span class="title">Message</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><ion-icon name="help-outline"></ion-icon></span>
                        <span class="title">Help</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><ion-icon name="settings-outline"></ion-icon></span>
                        <span class="title">Settings</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                        <span class="title">Password</span>
                    </a>
                </li>
                <li>
                    <!-- <a href="http://localhost:84/ToDoList/close.php"> -->
                    <a href="./close.php">
                        <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
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
                    <ion-icon name="menu-outline"></ion-icon>
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
            <!-- Formulario de registro de tareas pendientes -->
            <div class="newTaskContainer">
                <header>
                    <h2>Hoy</h2>
                    <span id="today" data-today="<?php echo date('Y/m/d', strtotime('now')); ?>"></span>
                </header>
                <div class="newTask">
                    <div class="btnNewTask">
                        <span class="icon"><ion-icon name="add"></ion-icon></span>
                        <span class="title">Añadir tarea</span>
                    </div>
                </div>
                <div class="newTaskForm disabled">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                        <input class="taskName" type="text" name="taskName" placeholder="Nombre de la tarea" maxlength="100" required>
                        <textarea class="taskDescription" name="taskDescription" placeholder="Descripción" maxlength="150" required></textarea>
                        <div class="dateSubmitContainer">
                            <input class="taskDate" type="date" name="taskDate" min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>" required>
                            <div class="btnTaskContainer">
                                <button class="btnCancelTask">Cancelar</button>
                                <input class="btnAddTask" type="submit" name="addTask" value="Añadir tarea">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers">1,504</div>
                        <div class="cardName">Daily Views</div>
                    </div>
                    <div class="iconBox">
                        <ion-icon name="eye-outline"></ion-icon>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers">80</div>
                        <div class="cardName">Sales</div>
                    </div>
                    <div class="iconBox">
                        <ion-icon name="cart-outline"></ion-icon>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers">284</div>
                        <div class="cardName">Comments</div>
                    </div>
                    <div class="iconBox">
                        <ion-icon name="chatbubbles-outline"></ion-icon>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers">$7,842</div>
                        <div class="cardName">Earning</div>
                    </div>
                    <div class="iconBox">
                        <ion-icon name="cash-outline"></ion-icon>
                    </div>
                </div>
            </div> -->

            <!-- Tareas de usuario -->
            <div class="cardBox">
                <?php foreach($tasks as $task): ?>
                    <div class="card">
                        <div>
                            <div class="numbers"><?php echo $task['task_name']; ?></div>
                            <div class="cardName"><?php echo $task['task_description']; ?></div>
                        </div>
                        <div class="iconBox">
                            <span><?php echo $task['created_at']; ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
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