//Contenido JS de la Extensión ssan_mv_solicitudes.

$(function () {

});

function cargaAjaxPrueba() {
   var id = "respuesta"; //Div o ID de los resultados
   var funcion = "funcionPrueba"; //Funcion del Controlador a Ejecutar
   var variables = { "id": "001", "nombre": "Casa Azul" }; //Variables pasadas por ajax a la funcion

   AjaxExt(variables, id, funcion); //Funcion que Ejecuta la llamada del ajax
}

function confirm_movil(solicitanteid, fecha, nombre, destino) {
   // Asignar el ID del chofer al campo oculto del modal
   document.getElementById('solicitanteid').value = solicitanteid;
   document.getElementById('fecha').value = fecha;
   document.getElementById('destino').value = destino;
   document.getElementById('nombre').value = nombre;

   $('#asignarVehiculoModal').modal('show');
}

function asignarVehiculo() {
   var solicitanteid = $('#solicitanteid').val();
   var fecha = $('#fecha').val();
   var destino = $("#destino").val();
   var nombre = $("#nombre").val();
   var patente = $("#patenteVehiculo").val();

   var id = "respuesta"; //Div o ID de los resultados
   var funcion = "set_vehiculo"; //Funcion del Controlador a Ejecutar
   var variables = { patente: patente, solicitanteid: solicitanteid, fecha: fecha, destino: destino, nombre: nombre }; //Variables pasadas por ajax a la funcion

   AjaxExt(variables, id, funcion); //Funcion que Ejecuta la llamada del ajax
}

function rejectmovil(id_solicitud) {
   swal({
      title: 'Motivo de rechazo',
      html: '<p><input id="input-field" class="form-control" required>' +
         '<p id="error-message" style="color: red; display: none;">El motivo es obligatorio.</p>',
      showCancelButton: true,
      closeOnConfirm: false,
      allowOutsideClick: false
   }, function (isConfirm) {
      if (isConfirm) {
         var motivo = $('#input-field').val().trim();
         var errorMessage = $('#error-message');

         if (motivo === '') {
            errorMessage.show();
            return false;
         } else {
            errorMessage.hide();
            var variables = { "id_solicitud": id_solicitud, "motivo": motivo };
            AjaxExt(variables, 'respuesta', 'rejectSolicitud');
            swal.close();
         }
      }
   });
}
function loadTable() {
   var fecha = $('#fecha').val();
   var variables = { fecha: fecha };

   AjaxExt(variables, 'resultado', 'get_solicitudes');
}
