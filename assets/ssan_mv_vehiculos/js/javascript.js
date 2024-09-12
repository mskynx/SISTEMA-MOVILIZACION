//Contenido JS de la Extensión ssan_mv_vehiculos.

$(function () {

   $("#save_vehiculo").click(function () {
      var patente = $("#patente").val();
      var marca = $("#marca").val();
      var modelo = $("#modelo").val();
      var anio = $("#anio").val();
      var cant_asientos = $("#cant_asientos").val();

      var fields = [
         { value: patente, message: "La patente es obligatoria.", selector: "#patente" },
         { value: marca, message: "La marca es obligatoria.", selector: "#marca" },
         { value: modelo, message: "El modelo es obligatorio.", selector: "#modelo" },
         { value: anio, message: "El año es obligatorio.", selector: "#anio" },
         { value: cant_asientos, message: "La cantidad de asientos es obligatorio.", selector: "#cant_asientos" }
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
      var funcion = "save_vehiculo"; // funciont del controlador a ejecutar
      var variables = {
         patente: patente, marca: marca, modelo: modelo, anio: anio, cant_asientos: cant_asientos //Variables a pasar al Controlador
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

function out_vehiculo(id_vehiculo) {
   var id = "respuesta"; //Div o ID de los resultados
   var funcion = "update_vehiculo"; //Funcion del Controlador a Ejecutar
   var variables = { "id": id_vehiculo, "update": 2 }; //Variables pasadas por ajax a la funcion

   AjaxExt(variables, id, funcion); //Funcion que Ejecuta la llamada del ajax
}

function in_vehiculo(id_vehiculo) {
   var id = "respuesta"; //Div o ID de los resultados
   var funcion = "update_vehiculo"; //Funcion del Controlador a Ejecutar
   var variables = { "id": id_vehiculo, "update": 1 }; //Variables pasadas por ajax a la funcion

   AjaxExt(variables, id, funcion); //Funcion que Ejecuta la llamada del ajax
}