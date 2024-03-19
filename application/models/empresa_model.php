<?php

class Empresa_model extends CI_Model {
    public function index()
    {
        return $this->db->query("SELECT * FROM empresa")->result_array();
    }

    public function select_editar($id)
    {
        return $this->db->query("SELECT * FROM empresa WHERE id_empresa = " . $this->db->escape($id))->row_array();
    }

    public function inserte_empresa($empresa_info)
    {
        $this->db->insert("empresa", $empresa_info);
    }

    public function update_empresa_ativa($id,$empresa_info)
    {
        $this->db->where("id_empresa",$id);
        return $this->db->update("empresa",$empresa_info);
    }

    public function update_empresa_inativa($id,$empresa_info)
    {
        $this->db->where("id_empresa",$id);
        return $this->db->update("empresa",$empresa_info);
    }

    public function update_empresa($id,$empresa_info)
    {
        $this->db->where("id_empresa",$id);
        return $this->db->update("empresa",$empresa_info);
    }

}