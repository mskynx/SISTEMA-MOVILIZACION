<?php
defined("BASEPATH") or exit("No direct script access allowed");

class ssan_mv_choferes extends CI_Controller
{

    var $empresa;

    function __construct()
    {
        parent::__construct();
        //Valida que la sesión no haya expirado.
        $this->load->is_session();
        $this->load->model("ssan_mv_choferes_model");
        $this->load->model("ssan_mv_vehiculos_model");
    }

    public function index()
    {
        //JS de la extension a cargar
        $this->output->set_template("lightboot_manu");

        //Recupera variables de Session
        $this->empresa = $this->session->userdata("COD_ESTAB");

        //Carga de JS y CSS propios de la Extensión
        $this->load->js("assets/ssan_mv_choferes/js/javascript.js");
        $this->load->css("assets/ssan_mv_choferes/css/styles.css");

        $data['vehiculos'] = $this->load_vehiculo();
        $data['choferes'] = $this->load_choferes();
        //Carga vista por defecto de la Extensión
        $this->load->view("ssan_mv_choferes/ssan_mv_choferes_view", $data);
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

    public function load_vehiculo()
    {
        $select = $this->ssan_mv_vehiculos_model->get_vehiculos();
        if ($select) {
            return $select;
        }
    }

    public function load_choferes()
    {
        $select = $this->ssan_mv_choferes_model->get_choferes();
        if ($select) {
            return $select;
        }
    }

    public function save_chofer()
    {
        $nombre = $this->input->post('nombre');
        $apellido = $this->input->post('apellido');
        $rut = $this->input->post('rut');

        $data = array(
            'NOMBRE' => $nombre,
            'APELLIDO' => $apellido,
            'RUT' => $rut
        );

        $insert = $this->ssan_mv_choferes_model->save_chofer($data);

        if ($insert) {
            $html_output = '<script>swal("Save","chofer guardado","success");
        setTimeout(function() {
            location.reload();
        }, 2000);</script>';
        } else {
            $html_output = '<script>swal("Notification","Hubo un error","error");</script>';
        }

        $this->output->set_output($html_output);
    }

    public function set_vehiculo()
    {
        $patente = $this->input->post('patente');
        $choferId = $this->input->post('choferId');

        $data = array(
            'PATENTE' => $patente,
            'CHOFER_ID' => $choferId
        );

        $update = $this->ssan_mv_choferes_model->set_vehiculo($data);

        if ($update) {
            $html_output = '<script>swal("Save","vehiculo asociado","success");
        setTimeout(function() {
            location.reload();
        }, 2000);</script>';
        } else {
            $html_output = '<script>swal("Notification","Hubo un error","error");</script>';
        }

        $this->output->set_output($html_output);
    }

    public function update_chofer()
    {
        $id = $this->input->post('id');
        $val = $this->input->post('update');

        $data = array(
            'id' => $id,
            'val' => $val
        );

        $update = $this->ssan_mv_choferes_model->update_chofer($data);

        if ($update) {
            $html_output = '<script>swal("Update","estado actualizado","success");
        setTimeout(function() {
            location.reload();
        }, 2000);</script>';
        } else {
            $html_output = '<script>swal("Notification","Hubo un error","error");</script>';
        }

        $this->output->set_output($html_output);
    }
}
