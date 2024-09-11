<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class ssan_mv_choferes_model extends CI_Model {

   var $own    = "ADMIN";
   var $ownGu  = "GUADMIN";

   public function __construct() {
       parent::__construct();
       //$this->load->model("sql_class/sqlclass_archivo"); //Opcional si se quiere agregar una clase externa. para dividir las SQL del Modelo
   }

   //Forma de realizar una consulta SQL
   public function getSQLPrueba(){
       $query = $this->db->query("SELECT * FROM $this->own.GG_TGPACTE");
       return $query->result_array();
   }mmmm

}
