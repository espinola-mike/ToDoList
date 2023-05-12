<!-- Modal de errores si existen estos -->
<?php if(!empty($errors)): ?>
    <div class="error">
        <ul>
            <li>
                <span class="headerError">Error</span>
                <span class="btnClose icon" title="Cerrar"><fa-icon class="fa fa-window-close"></fa-icon></span>
            </li>
            <hr class="line">
            <?php foreach($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<!-- modal para gestion de perfil -->
<div class="userModalConfig">
    <div class="userInfo">
        <div class="userImg">
            <?php if ($user->getUserImage()) : ?>
                <img src="static/img/profiles/<?php echo $user->getUserImage() ?>" alt="User Image">
            <?php else : ?>
                <img src="./static/img/user.png" alt="User image">
            <?php endif; ?>
            <!-- <img class="upload" src="./static/img/ionicons/camera.svg" alt="Camera image" title="Subir/Cambiar foto de perfil."> -->
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

<!-- Modal con formulario para subir foto de perfil -->
<div class="modalImageUpload">
    <div class="modalImageUpload-form">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
            <ul>
                <li class="modalImageUpload-header">
                    <span class="close">
                        <fa-icon class="fa fa-window-close"></fa-icon>
                    </span>
                    <header>
                        <h2>Imagen de perfil</h2>
                    </header>
                </li>
                <hr>
                <li>
                    <div class="imageProfile">
                        <?php if ($user->getUserImage()) : ?>
                            <img src="static/img/profiles/<?php echo $user->getUserImage() ?>" alt="User Image">
                        <?php else : ?>
                            <img src="./static/img/user.png" alt="User image">
                        <?php endif; ?>
                    </div>
                </li>
                <li class="input">
                    <div class="inputFile">
                        <input type="file" id="inputImage" name="image" accept="image/*" aria-label="Imagen a subir" title="No has seleccionado ninguna imagen" required>
                        <button id="btnInputImage" class="btnInputImage" title="Seleccionar imagen">
                            <span class="icon"><fa-icon class="fa fa-upload"></fa-icon></span>
                            <span class="title">Selecciona una imagen</span>
                        </button>
                    </div>
                    <div class="inputSubmit">
                        <input disabled type="submit" id="imageUpload" name="imageUpload" value="Subir Foto">
                    </div>
                </li>
            </ul>
        </form>
    </div>
</div>
<script src="static/js/moment.min.js"></script>
<script src="static/js/moment.locale.es.js"></script>
<script>
    let toggle = document.querySelector('.toggle');
    let navigation = document.querySelector('.navigation');
    let main = document.querySelector('.main');

    toggle.addEventListener('click', () => {
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