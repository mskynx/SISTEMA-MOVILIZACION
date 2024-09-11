$(function () {

   $("#send_solicitud").click(function () {

      var fecha = $("#fecha").val();
      var hora = $("#hora").val();
      var comienzo = $("#comienzo").val();
      var destino = $("#destino").val();
      var motivo = $("#motivo").val();
      var nombre = $("#nombre").val();
      var n_personas = $("#n_personas").val();
      var nombres = $("#nombres").val();

      var fields = [
         { value: fecha, message: "La fecha es obligatoria.", selector: "#fecha" },
         { value: hora, message: "La hora es obligatoria.", selector: "#hora" },
         { value: comienzo, message: "El comienzo es obligatorio.", selector: "#comienzo" },
         { value: destino, message: "El destino es obligatorio.", selector: "#destino" },
         { value: motivo, message: "El motivo es obligatorio.", selector: "#motivo" },
         { value: nombre, message: "El nombre es obligatorio.", selector: "#nombre" },
         { value: n_personas, message: "El número de personas es obligatorio.", selector: "#n_personas" },
         { value: nombres, message: "Los nombres son obligatorios.", selector: "#nombres" }
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
      var funcion = "solicitud_movil";
      var variables = {
         fecha: fecha, hora: hora, comienzo: comienzo, destino: destino,
         motivo: motivo, nombre: nombre,
         n_personas: n_personas, nombres: nombres
      };

      if (!hasError) {
         AjaxExt(variables, id, funcion);
      }

      });

});