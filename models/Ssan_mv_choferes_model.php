<?php
defined("BASEPATH") or exit("No direct script access allowed");

class ssan_mv_choferes_model extends CI_Model
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

    public function get_choferes()
    {
        $query = $this->db->query("SELECT * FROM $this->own.TB_MV_CHOFERES WHERE IND_ESTADO <> 0");
        return $query->result_array();
    }

    public function save_chofer($data)
    {
        $seq = $this->db->sequence($this->own, 'SEQ_MV_CHOFERES');
        $datos = array(
            'IDCORREL' => $seq,
            'NOMBRE' => $data['NOMBRE'] . " " . $data['APELLIDO'],
            'RUT' => $data['RUT'],
            'IND_ESTADO' => 1
        );

        $this->db->trans_start();
        $this->db->insert($this->own . '.TB_MV_CHOFERES', $datos);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function update_chofer($data)
    {
        $this->db->trans_start();

        $this->db->set('IND_ESTADO', $data['val']);
        $this->db->where('IDCORREL',  $data["id"]);
        $this->db->update($this->own . '.TB_MV_CHOFERES');

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function set_vehiculo($data)
    {
        $this->db->trans_start();

        $this->db->set('PATENTE_VEHICULO', $data['PATENTE']);
        $this->db->where('IDCORREL',  $data["CHOFER_ID"]);
        $this->db->update($this->own . '.TB_MV_CHOFERES');

        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}
