$(function() {

  // Fechas de iniciales calculadas con la libreria momentJS

  let fecha_completa = document.getElementById('fecha_completa');
  if (fecha_completa) {
    let radioBtn = fecha_completa.dataset.radiobtn;
    let fecha_inicial = fecha_completa.dataset.fechainicial;
    let fecha_final = fecha_completa.dataset.fechafinal;
    let rangeContainer = document.getElementById('rangeContainer');
    let mesContainer = document.getElementById('mesContainer');
    let mesContainerInput = document.getElementById('mes');
    let mesDateStart = document.getElementById('mesDateStart');
    let mesDateEnd = document.getElementById('mesDateEnd');
    let radioBtnRango = document.getElementById('radioBtnRango');
    let radioBtnMes = document.getElementById('radioBtnMes');
      if (radioBtn == 'rango'){
          var start = moment(fecha_inicial);
          var end = moment(fecha_final);
          var cualitativeTime = fecha_completa.dataset.cualitativetime;
          console.log(cualitativeTime);
          console.log('if');
          rangeContainer.style.display = 'block';
          mesContainer.style.display = 'none';
          radioBtnRango.checked = true;

          let fecha = fecha_inicial.slice(0,7);
          let mesDateStart = document.getElementById('mesDateStart');
          let mesDateEnd = document.getElementById('mesDateEnd');
          mesContainerInput.value = fecha;
          mesDateStart.value = moment(fecha).startOf('month').format('YYYY-MM-DD');
          mesDateEnd.value = moment(fecha).endOf('month').format('YYYY-MM-DD');
      } else {
          let fecha = fecha_inicial.slice(0,7);
          let mesDateStart = document.getElementById('mesDateStart');
          let mesDateEnd = document.getElementById('mesDateEnd');
          mesContainerInput.value = fecha;
          mesDateStart.value = moment(fecha).startOf('month').format('YYYY-MM-DD');
          mesDateEnd.value = moment(fecha).endOf('month').format('YYYY-MM-DD');
          rangeContainer.style.display = 'none';
          mesContainer.style.display = 'block';
          radioBtnMes.checked = true;
          var start = moment(fecha_inicial);
          var end = moment(fecha_final);
          var cualitativeTime = 'Mes de ' + moment(fecha_inicial).format('MMMM');
      }
  } else{
      let mesContainerInput = document.getElementById('mes');
      var start = moment();
      var end = moment();
      var cualitativeTime = 'Hoy';
      let fecha = start.format('YYYY-MM');
      let mesDateStart = document.getElementById('mesDateStart');
      let mesDateEnd = document.getElementById('mesDateEnd');
      mesContainerInput.value = fecha
      mesDateStart.value = moment(fecha).startOf('month').format('YYYY-MM-DD');
      mesDateEnd.value = moment(fecha).endOf('month').format('YYYY-MM-DD');
      console.log('else', fecha);
  }
 

  function cb(start, end) {
    // Lista de rangos (Hoy, Ayer, Hace 7 dias, etc...)
    let ranges = document.querySelector(".ranges ul");

    // Se delega el evento y se asigna el valor de su textContent a cualitativeTime
    ranges.addEventListener('click', (e) => {
      cualitativeTime = e.target.textContent;
    });

    // Se escribe el rango en pantalla para el usuario
    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY') + ' <b>(' + cualitativeTime + ')</b>');

    // Se guarda el rango (fecha inicial y fecha final) en sus respectivos inputs
    $('#rangoDateStart').attr("value", start.format('YYYY-MM-DD'));
    $('#rangoDateEnd').attr("value", end.format('YYYY-MM-DD'));
    $('#cualitativeTime').attr("value", cualitativeTime);
  }

  // inicailizacion de la libreria DateRangePicker con las opciones y configuraciones requeridas
  $('#reportrange').daterangepicker({
      startDate: start,
      endDate: end,
      "applyButtonClasses": "btn-success",
      "cancelButtonClasses": "btn-danger",
      locale: {
        cancelLabel: 'Cancelar',
        applyLabel: 'Aplicar',
        customRangeLabel: 'Personalizar Rango'
      },

      ranges: {
         'Hoy': [moment(), moment()],
         'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
         'Última Semana': [moment().subtract(6, 'days'), moment()],
         'Este Mes': [moment().startOf('month'), moment()],
         'Mes Pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      }
      
  }, cb);

  cb(start, end);

});