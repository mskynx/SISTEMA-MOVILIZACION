<?php
defined("BASEPATH") or exit("No direct script access allowed");

class ssan_mv_solicitudes extends CI_Controller
{

    var $empresa;

    function __construct()
    {
        parent::__construct();
        //Valida que la sesión no haya expirado.
        $this->load->is_session();
        $this->load->model("ssan_mv_solicitudes_model");
        $this->load->model("ssan_mv_vehiculos_model");
        $this->load->library('Phpmailer_lib');
    }

    public function index()
    {
        //JS de la extension a cargar
        $this->output->set_template("lightboot_manu");

        //Recupera variables de Session
        $this->empresa = $this->session->userdata("COD_ESTAB");

        //Carga de JS y CSS propios de la Extensión
        $this->load->js("assets/ssan_mv_solicitudes/js/javascript.js");
        $this->load->css("assets/ssan_mv_solicitudes/css/styles.css");

        $data["solicitudes"] = $this->load_solicitudes();
        $data["vehiculos"] = $this->load_vehiculo();
        //Carga vista por defecto de la Extensión
        $this->load->view("ssan_mv_solicitudes/ssan_mv_solicitudes_view", $data);
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

    public function load_solicitudes()
    {
        $select = $this->ssan_mv_solicitudes_model->get_solicitudes();
        if ($select) {
            return $select;
        }
    }

    public function load_vehiculo()
    {
        $select = $this->ssan_mv_vehiculos_model->get_vehiculos();
        if ($select) {
            return $select;
        }
    }

    public function get_solicitudes()
    {
        $fecha = $this->input->post('fecha');
        $result = $this->ssan_mv_solicitudes_model->get_solicitudes_by_fecha($fecha);

        // Generar la tabla HTML
        $table = '<table class="table table-bordered">';
        $table .= '<thead><tr><th>PATENTE</th><th>SOLICITANTE</th><th>DESTINO</th></tr></thead><tbody>';
        if (!empty($result)) {
            foreach ($result as $item) {
                $table .= '<tr>';
                $table .= '<td>' . htmlspecialchars($item['PATENTE']) . '</td>';
                $table .= '<td>' . htmlspecialchars($item['SOLICITANTE']) . '</td>';
                $table .= '<td>' . htmlspecialchars($item['DESTINO']) . '</td>';
                $table .= '</tr>';
            }
        } else {
            $table .= '<tr><td colspan="3">No hay resultados para la fecha seleccionada.</td></tr>';
        }
        $table .= '</tbody></table>';

        $this->output->set_output($table);
    }

    public function set_vehiculo()
    {
        $patente = $this->input->post('patente');
        $solicitanteid = $this->input->post('solicitanteid');
        $fecha = $this->input->post('fecha');
        $destino = $this->input->post('destino');
        $nombre = $this->input->post('nombre');

        $data = array(
            'PATENTE' => $patente,
            'FECHA' => $fecha,
            'DESTINO' => $destino,
            'NOMBRE' => $nombre
        );

        $insert = $this->ssan_mv_solicitudes_model->set_vehiculo($data);

        $body = "SU SOLICITUD DE MOVILIZACION CON DESTINO: " . $destino . " AH SIDO CONFIRMADA PARA EL DÍA: " . $fecha . " EN EL VEHICULO: " . $patente;

        $correo_confirmacion = $this->phpmailer_lib->sendMail($body, 'noresponder@araucanianorte.cl', 'daniel.valenzuela@araucanianorte.cl', 'CONFIRMACION DE SOLICITUD', "", "");

        if ($insert) {
            $update = $this->ssan_mv_solicitudes_model->update_solicitud($solicitanteid);
            if ($update) {
                if ($correo_confirmacion) {
                    $html_output = '<script>swal("Ok","Solicitud enviada","success");
                        setTimeout(function() {
                            location.reload();
                        }, 2000);</script>';
                } else {
                    // Identificar cuál de los correos falló
                    if (!$correo_confirmacion) {
                        $error_message = 'Error al enviar el correo de confirmacion.';
                    }
                    $html_output = '<script>swal("Notification","La solicitud fue cofirmada. Pero hay: ' . $error_message . '","error");</script>';
                }
            } else {
                $html_output = '<script>swal("Notification","Hubo un error al actualizar la solicitud","error");</script>';
            }
        } else {
            $html_output = '<script>swal("Notification","Hubo un error al confirmar la solicitud","error");</script>';
        }

        $this->output->set_output($html_output);
    }

    public function rejectSolicitud()
    {
        $id_solicitud = $this->input->post('id_solicitud');
        $motivo = $this->input->post('motivo');

        $update = $this->ssan_mv_solicitudes_model->update_solicitud_reject($id_solicitud, $motivo);

        $body = "SU SOLICITUD DE MOVILIZACION AH SIDO RECHAZADA POR EL MOTIVO DE: " . $motivo;

        $correo_confirmacion = $this->phpmailer_lib->sendMail($body, 'noresponder@araucanianorte.cl', 'daniel.valenzuela@araucanianorte.cl', 'RESPUESTA A SOLICITUD', "", "");

        if ($update) {
            if ($correo_confirmacion) {
                $html_output = '<script>swal("Ok","Solicitud enviada","success");
                    setTimeout(function() {
                        location.reload();
                    }, 2000);</script>';
            } else {
                // Identificar cuál de los correos falló
                if (!$correo_confirmacion) {
                    $error_message = 'Error al enviar el correo de confirmacion.';
                }
                $html_output = '<script>swal("Notification","La solicitud fue cofirmada. Pero hay: ' . $error_message . '","error");</script>';
            }
        } else {
            $html_output = '<script>swal("Notification","Hubo un error al actualizar la solicitud","error");</script>';
        }
        $this->output->set_output($html_output);
    }
}
