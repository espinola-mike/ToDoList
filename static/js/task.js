// Clasificacion y estilizacion dinamica de las tareas pendientes
const taskDate = document.querySelectorAll('.taskDate');
let yesterday = moment().subtract(1, 'days').format('YYYY-MM-DD');
let today = moment().format('YYYY-MM-DD');
let tomorrow = moment().add(1, 'days').format('YYYY-MM-DD');

taskDate.forEach(task => {
    let date = task.dataset.taskdate;
    // Comprobando fechas de tareas pendientes y perdidas
    if(date == yesterday){
        task.textContent = 'Ayer';
        task.classList.add('lost');
    }else if (date == today) {
        task.textContent = 'Hoy';
        task.classList.add('today');
    }else if (date == tomorrow) {
        task.textContent = 'Mañana';
        task.classList.add('tomorrow');
    }else if(moment(today).week() == moment(date).week()){
        task.textContent = moment(date).format('dddd');
        if (moment(date).diff(today, 'days') < 0) {
            task.classList.add('lost');
        }else{
            task.classList.add('week');
        }
    }else{
        task.textContent = moment(date).format('dddd DD [de] MMMM [del] YYYY');
        if (moment(date).diff(today, 'days') < 0) {
            task.classList.add('lost');
        }else{
            task.classList.add('month');
        }
    }
});


// Contenedores de las tareas pendientes
const card = document.querySelectorAll('.cardBox .card');

card.forEach(cardElement => {
    cardElement.addEventListener('mouseover', () => {
        cardElement.querySelector('.taskActions').classList.remove('disabled');
    });
    cardElement.addEventListener('mouseout', () => {
        cardElement.querySelector('.taskActions').classList.add('disabled');
    });
});

// Boton para editar tarea
const cardBox = document.querySelector('.cardBox');
const templateForm = document.getElementById('newTaskForm');
const btnEditTask = document.querySelectorAll('.editTask');

// btnEditTask.forEach
btnEditTask.forEach(btnElement => {
    btnElement.addEventListener('click', (e) => {
        e.preventDefault();
        if (cardBox.querySelector('.newTaskForm')) {
            cardBox.querySelector('.newTaskForm').previousElementSibling.classList.remove('disabled');
            cardBox.querySelector('.newTaskForm').remove();
        }
        let card = btnElement.parentElement.parentElement;
        let taskName = card.querySelector('.taskName').textContent;
        let taskDescription = card.querySelector('.taskDescription').textContent;
        let taskDate = card.querySelector('.taskDate').dataset.taskdate;
        templateForm.content.querySelector('.taskName').value = taskName;
        templateForm.content.querySelector('.taskDescription').value = taskDescription;
        templateForm.content.querySelector('.taskDate').value = moment(taskDate).format('YYYY-MM-DD');
        templateForm.content.getElementById('section').value = btnElement.dataset.section;
        templateForm.content.getElementById('taskId').value = btnElement.dataset.id;
        card.insertAdjacentElement('afterend', templateForm.content.querySelector('.newTaskForm').cloneNode(true));
        card.classList.add('disabled');
        card.nextElementSibling.querySelector('.btnCancelTask').addEventListener('click', (e) => {
            e.preventDefault();
            card.nextElementSibling.remove();
            card.classList.remove('disabled');
        });
    });
});

