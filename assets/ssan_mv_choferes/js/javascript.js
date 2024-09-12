//Contenido JS de la Extensión ssan_mv_choferes.

$(function () {

   cargaAjaxPrueba();

   $('#rut').Rut({
      on_error: function () {
         $('#error_rut').html('Rut Incorrecto');
         $("#error_rut").show('slow').fadeOut('slow').fadeIn('slow');
         $('#error_rut').data("valido", '');
         swal("Aviso", "Rut No Valido.", "warning");
      },
      on_success: function () {
         $('#error_rut').html('');
         $("#error_rut").hide('slow');
      },
      format_on: 'keyup'
   });

   $("#save_chofer").click(function () {
      var nombre = $("#nombre").val();
      var apellido = $("#apellido").val();
      var rut = $("#rut").val();

      var fields = [
         { value: nombre, message: "El nombre es obligatorio.", selector: "#nombre" },
         { value: apellido, message: "El apellido es obligatorio.", selector: "#apellido" },
         { value: rut, message: "El rut es obligatorio.", selector: "#rut" }
      ];

      var hasError = false;
      for (var i = 0; i < fields.length; i++) {
         if (!fields[i].value) {
            alert(fields[i].message);
            $(fields[i].selector).focus();
            hasError = true;
            break;
         }
      }

      var id = "respuesta";
      var funcion = "save_chofer"; // funciont del controlador a ejecutar
      var variables = {
         nombre: nombre, apellido: apellido, rut: rut //Variables a pasar al Controlador
      };

      if (!hasError) {
         AjaxExt(variables, id, funcion);
      }
   });
});

function cargaAjaxPrueba() {
   var id = "respuesta"; //Div o ID de los resultados
   var funcion = "funcionPrueba"; //Funcion del Controlador a Ejecutar
   var variables = { "id": "001", "nombre": "Casa Azul" }; //Variables pasadas por ajax a la funcion

   AjaxExt(variables, id, funcion); //Funcion que Ejecuta la llamada del ajax
}

function showAsignarVehiculoModal(choferId) {
   // Asignar el ID del chofer al campo oculto del modal
   document.getElementById('choferId').value = choferId;

   $('#asignarVehiculoModal').modal('show');
}

function asignarVehiculo() {
   var choferId = $('#choferId').val();
   var patente = $("#patenteVehiculo").val();

   var id = "respuesta"; //Div o ID de los resultados
   var funcion = "set_vehiculo"; //Funcion del Controlador a Ejecutar
   var variables = { patente: patente, choferId: choferId }; //Variables pasadas por ajax a la funcion

   AjaxExt(variables, id, funcion); //Funcion que Ejecuta la llamada del ajax
}

function out_chofer(id_chofer) {
   var id = "respuesta"; //Div o ID de los resultados
   var funcion = "update_chofer"; //Funcion del Controlador a Ejecutar
   var variables = { "id": id_chofer, "update": 2 }; //Variables pasadas por ajax a la funcion

   AjaxExt(variables, id, funcion); //Funcion que Ejecuta la llamada del ajax
}

function in_chofer(id_chofer) {
   var id = "respuesta"; //Div o ID de los resultados
   var funcion = "update_chofer"; //Funcion del Controlador a Ejecutar
   var variables = { "id": id_chofer, "update": 2 }; //Variables pasadas por ajax a la funcion

   AjaxExt(variables, id, funcion); //Funcion que Ejecuta la llamada del ajax
}