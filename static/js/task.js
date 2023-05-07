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
    }else if(moment(today).week() == moment(date).week() && moment(date).diff(today, 'days') > 0){
        task.textContent = moment(date).format('dddd');
        task.classList.add('week');
    }else{
        task.textContent = moment(date).format('DD-MM-YYYY');
        if (moment(date).diff(today, 'days') < 0) {
            task.classList.add('lost');
        }else{
            task.classList.add('month');
        }
    }
});