document.addEventListener('DOMContentLoaded', ()=>{

/**---------------------------------------------------------
 * Elementos del formulario seleccionados
 */
const see = document.getElementById('see');
const form = document.getElementById('form');
const email = document.getElementById('email');
const user_name = document.getElementById('user_name');
const password1 = document.getElementById('password1');
const password2 = document.getElementById('password2');

/**---------------------------------------------------------
 * TemplateStrings utilizados para mensajes informativos
 */
const passwordErrorContainer = `<div class="password_error_container"></div>`

const passwordErrorTemplateString = `
                                    <div class="password_error">
                                        <span><b>Error:</b> La contraseña no cumple con los requerimientos.</span>
                                        <ul>
                                            <li>Al menos una letra mayúscula.</li>
                                            <li>Al menos una letra minúscula.</li>
                                            <li>Al menos un caracter numérico.</li>
                                            <li>No se permiten espacios en blanco.</li>
                                            <li>Al menos 8 caracteres y máximo 16.</li>
                                            <li>Al menos un caracter especial <b>[.-_@#$%&]</b></li>
                                        </ul>
                                    </div>`;

const noEqualsPasswordsTemplateString = `
                                        <div class="no_equals">
                                            <span><b>Error:</b> Las contraseñas no coinciden.</span>
                                        </div>`;

const invalidEmailTemplateString = `
                                    <div class="invalid_email">
                                        <span><b>Error:</b> Dirección de email inválida.</span>
                                    </div>`;

const invalidUserNameTemplateString = `
                        <div class="invalid_user_name">
                            <span><b>Error:</b> Nombre de usuario invalido.</span>
                            <ul>
                                <li>Al menos 8 caracteres y máximo 16.</li>
                                <li>Caracteres permitidos: <b>[a-z|A-Z|0-9]|.-_!</b></li>
                            </ul>
                        </div>
                        `;                                  

// const RegExpPass = new RegExp(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){8,15}$/);
// const RegExpEmail = new RegExp(/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i);
const RegExpPass = new RegExp(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&#.$($)$-$_])[A-Za-z\d$@$!%*?&#.$($)$-$_]{8,16}$/);
const RegExpEmail = new RegExp(/^[a-zA-Z0-9-_.]+@[a-zA-Z0-9-_.]+(\.[a-zA-Z]{2,4}){1,2}?$/);
const RegExpUserName = new RegExp(/^([a-zA-Z0-9-_.!]+){8,16}?$/);

// Dejar ver las constraseñas
see.addEventListener('click', () => {
    see.classList.toggle('active');
    if (password1.getAttribute('type') == 'password') {
        password1.setAttribute('type', 'text');
        password2.setAttribute('type', 'text');
    } else {
        password1.setAttribute('type', 'password');
        password2.setAttribute('type', 'password');
    }
});

/** Declaracion de eventos
 * ---------------------------------------------------------
 */

email.addEventListener('focusout', (e) => {
    createEmailError(e.target);
});

user_name.addEventListener('focusout', (e) => {
    createUserNameError(e.target);
});

password1.addEventListener('focusout', (e) => {
    passwordError(e.target);
    comparePassword(e.target, password2);
});

password2.addEventListener('focusout', (e) => {
    passwordError(e.target);
    comparePassword(e.target, password1);
});

/**---------------------------------------------------------
 * Declaracion de eventos 
 */


/**---------------------------------------------------------
 * Escribe en el DOM un mensaje de error, se ejecuta si el email ingresado es incorrecto
 */
function createEmailError(email){
    if (validInput(email, RegExpEmail)) {
        if(document.querySelector('.invalid_email')){
            document.querySelector('.invalid_email').remove();
        }
    }else{
        if(!document.querySelector('.invalid_email')){
            email.insertAdjacentHTML('afterend', invalidEmailTemplateString);
        }
    }
}

/**---------------------------------------------------------
 * Escribe en el DOM un mensaje de error, se ejecuta si el nombre de usuario ingresado es incorrecto
 */
function createUserNameError(userName){
    if(validInput(userName, RegExpUserName)){
        if(document.querySelector('.invalid_user_name')){
            document.querySelector('.invalid_user_name').remove();
        }
    }else{
        if (!document.querySelector('.invalid_user_name')) {
            userName.insertAdjacentHTML('afterend', invalidUserNameTemplateString);
        }
    }
}

/** Funciones de validacion de contraseña
 * ---------------------------------------------------------
 */
// Comprueba si los campos pasados por parametro cumplen con los criterios de validez
// Tambien agrega las clases valid e invalid a los campos correspondientes
function validInput(domElement, regexp){
    if (regexp.test(domElement.value)) {
        domElement.classList.remove('invalid');
        domElement.classList.add('valid');
        return true;
    } else {
        domElement.classList.remove('valid');
        domElement.classList.add('invalid');
        return false;
    }
}

// Escribe en el DOM un mensaje de error en el cual se especifican los valores correctos que puede tener la contraseña
function passwordError(password){
    createPasswordErrorContainer(password);
    if (validInput(password, RegExpPass)) {
        if (password.parentElement.nextElementSibling.querySelector('.password_error')){
            password.parentElement.nextElementSibling.querySelector('.password_error').remove();
        }
    }else{
        if (!password.parentElement.nextElementSibling.querySelector('.password_error')) {
            password.parentElement.nextElementSibling.insertAdjacentHTML('beforeend', passwordErrorTemplateString);
        }
    }
}

// Verifica si las contraseñas son iguales a su vez utiliza la funcion passwordEqualsError para escribir o no el mensaje de error correspondiente.
function comparePassword(password1, password2){
    if (password2.value.length > 8) {
        if (password1.value == password2.value) {
            password1.classList.add('valid');
            password2.classList.add('valid');
            password1.classList.remove('invalid');
            password2.classList.remove('invalid');
            passwordEqualsError(password1, true, password2);
        }else{
            password1.classList.add('invalid');
            password2.classList.add('invalid');
            password1.classList.remove('valid');
            password2.classList.remove('valid');
            passwordEqualsError(password1, false, password2);
        }
    }
}

// Escribe en el DOM el mensaje de error/informativo indicando que las contraseñas no coinciden
// En caso de que estas si coincidan elimina estos elementos del DOM
function passwordEqualsError(password, equal, password2){
    createPasswordErrorContainer(password);
    if (equal) {
        if (password.parentElement.nextElementSibling.querySelector('.no_equals')) {
            password.parentElement.nextElementSibling.querySelector('.no_equals').remove();
        }
        if (password2.parentElement.nextElementSibling.querySelector('.no_equals')) {
            password2.parentElement.nextElementSibling.querySelector('.no_equals').remove();
        }
    }else{
        if (!password.parentElement.nextElementSibling.querySelector('.no_equals')) {
            password.parentElement.nextElementSibling.insertAdjacentHTML('beforeend', noEqualsPasswordsTemplateString);
        }
    }
}

// Comprueba la existencia del contenedor de errores a traves de la comprobacion de la clase 'password_error_container'
function createPasswordErrorContainer(password){
    if(!password.parentElement.nextElementSibling.classList.contains('password_error_container')){
        password.parentElement.insertAdjacentHTML('afterend', passwordErrorContainer);
    }
}

});

