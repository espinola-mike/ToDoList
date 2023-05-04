document.addEventListener('DOMContentLoaded', () => {
/**---------------------------------------------------------
 * Elementos del formulario seleccionados
 */
const see = document.getElementById('see');
const email = document.getElementById('email');
const password = document.getElementById('password');

const RegExpEmail = new RegExp(/^[a-zA-Z0-9-_.]+@[a-zA-Z0-9-_.]+(\.[a-zA-Z]{2,4}){1,2}?$/);

/**---------------------------------------------------------
 * TemplateStrings utilizados para mensajes informativos
 */
const invalidEmailTemplateString = `
                                    <div class="invalid_email">
                                        <span><b>Error:</b> Dirección de email inválida.</span>
                                        </div>`;

// Dejar ver las constraseñas
see.addEventListener('click', () => {
    see.classList.toggle('active');
    if (password.getAttribute('type') == 'password') {
        password.setAttribute('type', 'text');
    } else {
        password.setAttribute('type', 'password');
    }
});

/** Declaracion de eventos
 * ---------------------------------------------------------
 */
email.addEventListener('focusout', (e) => {
    createEmailError(e.target);
});

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

});