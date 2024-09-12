<?php
defined("BASEPATH") or exit("No direct script access allowed");

class ssan_mv_nueva_solicitud extends CI_Controller
{

    var $empresa;

    function __construct()
    {
        parent::__construct();
        //Valida que la sesión no haya expirado.
        $this->load->is_session();
        $this->load->model("ssan_mv_nueva_solicitud_model");

        $this->load->library('Phpmailer_lib');
    }

    public function index()
    {
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

    public function funcionPrueba()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        //Recupera variables de Session
        $empresa = $this->session->userdata("COD_ESTAB");
        //Recupera variables pasadas por Ajax
        $id     = $this->input->post("id");
        $nombre = $this->input->post("nombre");

        //Muestro los Resultados con un Echo o un <script>
        $html = "Resultados obtenidos con Ajax. Id= " . $id . ", Nombre= " . $nombre . ".";

        $html .= "bla bla bla";

        $this->output->set_output($html);
    }


    public function solicitud_movil()
    {
        $fecha = $this->input->post('fecha');
        $hora = $this->input->post('hora');
        $comienzo = $this->input->post('comienzo');
        $destino = $this->input->post('destino');
        $motivo = $this->input->post('motivo');
        $nombre = $this->input->post('nombre');
        $n_personas = $this->input->post('n_personas');
        $nombres = $this->input->post('nombres');
        $correo = $this->input->post('correo');

        $data = array(
            'fecha' => $fecha,
            'hora' => $hora,
            'comienzo' => $comienzo,
            'destino' => $destino,
            'motivo' => $motivo,
            'nombre' => $nombre,
            'n_personas' => $n_personas,
            'nombres' => $nombres,
            'correo' => $correo
        );

        $insert = $this->ssan_mv_nueva_solicitud_model->save_solicitud($data);

        if ($insert) {
            // Crear el cuerpo del correo para el encargado
            $body_encargado = "NUEVA SOLICITUD DE MOVILIZACION CON DESTINO: " . $destino . " SOLICITADO POR: " . $nombre . " PARA: " . $n_personas . " CANTIDAD DE PERSONAS, PARA EL DÍA: " . $fecha;

            // Crear el cuerpo del correo para el solicitante
            $body_solicitante = "SE HA ENVIADO LA SOLICITUD DE MOVILIZACION CON DESTINO: " . $destino . " PARA EL DÍA: " . $fecha;

            // Enviar correo al encargado
            $correo_encargado = $this->phpmailer_lib->sendMail($body_encargado, 'noresponder@araucanianorte.cl', 'daniel.valenzuela@araucanianorte.cl', 'NUEVA SOLICITUD DE MOVILIZACION', "", "");

            // Enviar correo al solicitante
            $correo_solicitante = $this->phpmailer_lib->sendMail($body_solicitante, 'noresponder@araucanianorte.cl', $correo, 'SOLICITUD ENVIADA', "", "");

            // Verificar si ambos correos fueron enviados con éxito
            if ($correo_encargado && $correo_solicitante) {
                $html_output = '<script>swal("Ok","Solicitud enviada","success");
                    setTimeout(function() {
                        location.reload();
                    }, 2000);</script>';
            } else {
                // Identificar cuál de los correos falló
                if (!$correo_encargado) {
                    $error_message = 'Error al enviar el correo al encargado.';
                } elseif (!$correo_solicitante) {
                    $error_message = 'Error al enviar el correo al solicitante.';
                } else {
                    $error_message = 'Error al enviar los correos.';
                }

                $html_output = '<script>swal("Notification","La solicitud fue ingresada. Pero hay: ' . $error_message . '","error");</script>';
            }
        } else {
            $html_output = '<script>swal("Notification","Hubo un error al guardar la solicitud","error");</script>';
        }

        $this->output->set_output($html_output);
    }
}
