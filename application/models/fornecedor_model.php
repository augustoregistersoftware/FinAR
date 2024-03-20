<?php

class Fornecedor_model extends CI_Model {
    public function index()
    {
        return $this->db->query("SELECT
        fornecedor.*,
        empresa.nome_fantasia
        FROM fornecedor
        INNER JOIN empresa on empresa.id_empresa = fornecedor.id_empresa
        WHERE fornecedor.id_empresa = 1")->result_array();
    }

    public function select_fornecedor_por_empresa($id)
    {
        return $this->db->query('SELECT
        fornecedor.*,
        empresa.nome_fantasia
        FROM fornecedor
        INNER JOIN empresa on empresa.id_empresa = fornecedor.id_empresa
        WHERE fornecedor.id_empresa = '.$this->db->escape($id).'')->result_array();
    }

    public function select_empresas()
    {
        return $this->db->query("SELECT
        id_empresa,
        razao_social
        FROM empresa;
        ")->result_array();
    }

    public function obter_dados($id) {
        $query = $this->db->query('SELECT *
        FROM produto
        WHERE id_fornecedor = '.$this->db->escape($id).'');
        return $query->result_array();
    }

    public function select_documentos($id)
    {
        return $this->db->query('SELECT
        documentos_fornecedor.id_documento_fornc,
        documentos_fornecedor.nome,
        documentos_fornecedor.arquivo,
        fornecedor.nome as razao_social
        FROM documentos_fornecedor
        INNER JOIN fornecedor on fornecedor.id_fornecedor = documentos_fornecedor.id_fornecedor
        WHERE documentos_fornecedor.id_fornecedor = '.$this->db->escape($id).'')->result_array();
    }

    public function update_fornecedor_ativa($id,$fornecedor_info)
    {
        $this->db->where("id_fornecedor",$id);
        return $this->db->update("fornecedor",$fornecedor_info);
    }

    public function update_fornecedor_inativa($id,$fornecedor_info)
    {
        $this->db->where("id_fornecedor",$id);
        return $this->db->update("fornecedor",$fornecedor_info);
    }
}