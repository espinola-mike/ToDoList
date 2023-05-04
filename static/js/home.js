document.addEventListener('DOMContentLoaded', () => {
    const user = document.querySelector('.user');
    const topbar = document.querySelector('.topbar');
    const userModalConfig = document.querySelector('.userModalConfig');
    const main = document.querySelector('.main');
    const navigation = document.querySelector('.navigation');
    const btnUploadImage = document.querySelector('.upload');
    const modalImageUpload = document.querySelector('.modalImageUpload');
    const modalImageUploadForm = document.querySelector('.modalImageUpload-form');
    const closeModalUpload = document.querySelector('.close');

    btnUploadImage.addEventListener('click', () => {
        modalImageUpload.classList.add('active');
    });

    closeModalUpload.addEventListener('click', () => {
        modalImageUpload.classList.remove('active')
    });
    
    user.addEventListener('click', () => {
        userModalConfig.classList.toggle('active');

    });
    // Agregar evento de clic al documento
    document.addEventListener('click', (e) => {
        // 'Delegando' eventos a elementos del documento
        // Boton y modal de configuracion de usuario (cambiar foto de perfil y cerrar sesion)
        let clickInModal = userModalConfig.contains(e.target);
        let clickInBtn = user.contains(e.target);
        // Boton y modal para cambiar la foto de usuario
        let clickInBackgroundModalImageUpload = modalImageUpload.contains(e.target);
        let clickInBtnModalImageUpload = btnUploadImage.contains(e.target);
        let clickInImageUploadForm = modalImageUploadForm.contains(e.target);
        // Si se hace click en cualquier elemento que no sean los elementos especificados el modal de configuracion
        // de usuario se ocultara
        if (!clickInModal && !clickInBtn && !clickInImageUploadForm && !clickInBackgroundModalImageUpload) {
            userModalConfig.classList.remove('active');
        }
        // Si se hace click en cualquier elemento que no sean los elementos especificados el modal para cambiar foto de
        // usuario se ocultara
        if(!clickInImageUploadForm && !clickInBtnModalImageUpload){
            modalImageUpload.classList.remove('active');
        }
    });

    today.textContent = moment(today.dataset.today).format("dddd MMMM DD");
    
    const btnNewTask = document.querySelector('.btnNewTask');
    const btnCancelTask = document.querySelector('.btnCancelTask');
    const newTask = document.querySelector('.newTask');
    const newTaskForm = document.querySelector('.newTaskForm');

    btnNewTask.addEventListener('click', ()=>{
        newTaskForm.classList.remove('disabled');
        newTask.classList.add('disabled');
    });

    btnCancelTask.addEventListener('click', (e)=>{
        e.preventDefault();
        newTaskForm.classList.add('disabled');
        newTask.classList.remove('disabled');
    });


});