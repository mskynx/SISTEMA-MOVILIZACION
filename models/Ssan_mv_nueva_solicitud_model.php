<?php
defined("BASEPATH") or exit("No direct script access allowed");

class ssan_mv_nueva_solicitud_model extends CI_Model
{

    var $own    = "FACTURACION";
    var $ownGu  = "GUADMIN";

    public function __construct()
    {
        parent::__construct();
        //$this->load->model("sql_class/sqlclass_archivo"); //Opcional si se quiere agregar una clase externa. para dividir las SQL del Modelo
    }

    //Forma de realizar una consulta SQL

    public function save_solicitud($data)
    {
        $seq = $this->db->sequence($this->own, 'SEQ_MV_SOLICITUD_MOVIL');
        $datos = array(
            'IDCORREL' => $seq,
            'FECHA' => $data['fecha'],
            'HORA' => $data['hora'],
            'COMIENZO' => $data['comienzo'],
            'DESTINO' => $data['destino'],
            'MOTIVO' => $data['motivo'],
            'NOMBRE' => $data['nombre'],
            'N_PERSONAS' => $data['n_personas'],
            'NOMBRES' => $data['nombres'],
            'IND_ESTADO' => 1,
            'FECHA_SOLICITUD' => 'SYSDATE'
        );

        $this->db->trans_start();
        $this->db->insert($this->own . '.TB_MV_SOLICITUD_MOVIL', $datos);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}
