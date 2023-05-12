// Elementos del DOM para subir imagen de usuario
const inputImage = document.getElementById('inputImage');
const btnInputImage = document.getElementById('btnInputImage');
const inputTitle = btnInputImage.querySelector('.title');
const inputSubmit = document.querySelector('.modalImageUpload-form .input .inputSubmit input')

btnInputImage.addEventListener('click', (e) => {
    e.preventDefault();
    inputImage.click();
});

inputImage.addEventListener('change', (e) => {
    let imageFile = inputImage.files[0];
    if(imageFile){
        if (imageFile.type.includes('image')) {
            inputTitle.textContent = imageFile.name;
            btnInputImage.classList.add('valid'); 
            btnInputImage.classList.remove('invalid');
            inputSubmit.removeAttribute('disabled');
        }else{
            inputTitle.textContent = 'Archivo no válido' + imageFile.name;
            btnInputImage.classList.add('invalid');
            btnInputImage.classList.remove('valid');
            inputSubmit.setAttribute('disabled', 'true');
        }
    }else{
        inputTitle.textContent = 'No se ha seleccionado ningún archivo.';
        btnInputImage.classList.add('invalid');
        btnInputImage.classList.remove('valid');
        inputSubmit.setAttribute('disabled', 'true');
    }
});

// Ventana de error (en caso de que no sea una imagen valida)

const windowError = document.querySelector('.error');

if(windowError){
    const btnWindowClose = windowError.querySelector('.btnClose');
    btnWindowClose.addEventListener('click', () => { windowError.remove(); });
}
