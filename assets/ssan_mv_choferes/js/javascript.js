//Contenido JS de la Extensión ssan_mv_choferes.

$(function () {

   cargaAjaxPrueba();
});

function cargaAjaxPrueba(){
   var id="respuesta"; //Div o ID de los resultados
   var funcion = "funcionPrueba"; //Funcion del Controlador a Ejecutar
   var variables={"id": "001","nombre": "Casa Azul"}; //Variables pasadas por ajax a la funcion

   AjaxExt(variables,id,funcion); //Funcion que Ejecuta la llamada del ajax
}