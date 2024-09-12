<?php
defined("BASEPATH") or exit("No direct script access allowed");

class ssan_mv_vehiculos_model extends CI_Model
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

    public function get_vehiculos()
    {
        $query = $this->db->query("SELECT * FROM $this->own.TB_MV_VEHICULOS WHERE IND_ESTADO <> 0");
        return $query->result_array();
    }

    public function save_vehiculo($data)
    {
        $seq = $this->db->sequence($this->own, 'SEQ_MV_VEHICULOS');
        $datos = array(
            'IDCORREL' => $seq,
            'PATENTE' => $data['PATENTE'],
            'MARCA' => $data['MARCA'],
            'MODELO' => $data['MODELO'],
            'ANIO' => $data['ANIO'],
            'IND_ESTADO' => 1,
            'CANT_ASIENTOS' => $data['CANT_ASIENTOS']
        );

        $this->db->trans_start();
        $this->db->insert($this->own . '.TB_MV_VEHICULOS', $datos);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function update_vehiculo($data)
    {
        $this->db->trans_start();

        $this->db->set('IND_ESTADO', $data['val']);
        $this->db->where('IDCORREL',  $data["id"]);
        $this->db->update($this->own . '.TB_MV_VEHICULOS');

        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}
