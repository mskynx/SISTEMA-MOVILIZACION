<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class ssan_mv_nueva_solicitud extends CI_Controller {

   var $empresa;

   function __construct() {
       parent::__construct();
       //Valida que la sesión no haya expirado.
       $this->load->is_session();
       $this->load->model("ssan_mv_nueva_solicitud_model");
   }

   public function index() {
       //JS de la extension a cargar
       $this->output->set_template("theme_principal/lightboot");

       //Recupera variables de Session
       $this->empresa = $this->session->userdata("COD_ESTAB");

       //Carga de JS y CSS propios de la Extensión
       $this->load->js("assets/ssan_mv_nueva_solicitud/js/javascript.js");
       $this->load->css("assets/ssan_mv_nueva_solicitud/css/styles.css");

       //Carga vista por defecto de la Extensión
       $this->load->view("ssan_mv_nueva_solicitud/ssan_mv_nueva_solicitud_view");
   }

   public function funcionPrueba() {
       if (!$this->input->is_ajax_request()) { show_404(); }

       //Recupera variables de Session
       $empresa = $this->session->userdata("COD_ESTAB");
       //Recupera variables pasadas por Ajax
       $id     = $this->input->post("id");
       $nombre = $this->input->post("nombre");

       //Muestro los Resultados con un Echo o un <script>
       $html = "Resultados obtenidos con Ajax. Id= ".$id.", Nombre= ".$nombre.".";

       $html.= "bla bla bla";

       $this->output->set_output($html);
   }


   public function solicitud_movil()
    {
        $data = array(
            'fecha' => $this->input->post('fecha'),
            'hora' => $this->input->post('hora'),
            'comienzo' => $this->input->post('comienzo'),
            'destino' => $this->input->post('destino'),
            'motivo' => $this->input->post('motivo'),
            'nombre' => $this->input->post('nombre'),
            'n_personas' => $this->input->post('n_personas'),
            'nombres' => $this-> input->post('nombres')
        );

        $insert = $this->ssan_mv_nueva_solicitud_model->save_solicitud($data);

        if($insert){
            $html = "<script>";
            $html .=  "alert('Solicitud enviada con exito');";
            $html .= "</script>";
        }else{
            $html = "<script>";
            $html .=  "alert('Error al guardar solicitud');";
            $html .= "</script>";
        }
        

        $this->output->set_output($html);
    }
}
