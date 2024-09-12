<?php
defined("BASEPATH") or exit("No direct script access allowed");

class ssan_mv_solicitudes_model extends CI_Model
{

    var $own    = "FACTURACION";
    var $ownGu  = "GUADMIN";

    public function __construct()
    {
        parent::__construct();
        //$this->load->model("sql_class/sqlclass_archivo"); //Opcional si se quiere agregar una clase externa. para dividir las SQL del Modelo
    }

    //Forma de realizar una consulta SQL
    public function getSQLPrueba()
    {
        $query = $this->db->query("SELECT * FROM $this->own.GG_TGPACTE");
        return $query->result_array();
    }

    public function get_solicitudes()
    {
        $query = $this->db->query("SELECT * FROM $this->own.TB_MV_SOLICITUD_MOVIL");
        return $query->result_array();
    }

    public function set_vehiculo($data)
    {
        $seq = $this->db->sequence($this->own, 'SEQ_MV_SOLICITUD_CONFIRMADA');
        $datos = array(
            'IDCORREL' => $seq,
            'PATENTE' => $data['PATENTE'],
            'SOLICITANTE' => $data['NOMBRE'],
            'IND_ESTADO' => 1,
            'FECHA' => $data['FECHA'],
            'DESTINO' => $data['DESTINO']
        );

        $this->db->trans_start();
        $this->db->insert($this->own . '.TB_MV_SOLICITUD_CONFIRMADA', $datos);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function update_solicitud($id)
    {
        $this->db->trans_start();

        $this->db->set('IND_ESTADO', 2);
        $this->db->where('IDCORREL',  $id);
        $this->db->update($this->own . '.TB_MV_SOLICITUD_MOVIL');

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function update_solicitud_reject($id, $motivo)
    {
        $this->db->trans_start();

        $this->db->set('IND_ESTADO', 3);
        $this->db->set('OBSERVACIONES', $motivo);
        $this->db->where('IDCORREL',  $id);
        $this->db->update($this->own . '.TB_MV_SOLICITUD_MOVIL');

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function get_solicitudes_by_fecha($fecha)
    {

        $query = $this->db->query("SELECT * FROM $this->own.TB_MV_SOLICITUD_CONFIRMADA WHERE IND_ESTADO <> 0 AND FECHA ='" . $fecha . "'");
        return $query->result_array();
    }
}
