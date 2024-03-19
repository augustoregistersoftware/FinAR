<?php

class Localizacao_model extends CI_Model {
    public function index()
    {
        return $this->db->query("SELECT
        localizacao.id_localizacao,
        localizacao.nome,
        localizacao.status,
        empresa.nome_fantasia,
        empresa.cnpj,
        empresa.cep,
        empresa.cidade,
        empresa.endereco
        FROM localizacao
        INNER JOIN empresa on empresa.id_empresa = localizacao.id_empresa
        WHERE empresa.situacao = 'T'")->result_array();
    }

    public function select_documentos($id)
    {
        return $this->db->query('SELECT
        documentos_localizacao.id_documento_loc,
        documentos_localizacao.nome_documento,
        documentos_localizacao.arquivo,
        localizacao.nome as nome_loc
        FROM documentos_localizacao
        INNER JOIN localizacao on localizacao.id_localizacao = documentos_localizacao.id_localizacao
        WHERE documentos_localizacao.id_localizacao = '.$this->db->escape($id).'')->result_array();
    }

    public function select_arquivo($id)
    {
        return $this->db->query('SELECT
        arquivo
        FROM documentos_localizacao
        WHERE id_documento_loc = '.$this->db->escape($id).'')->row_array();
    }

    public function delete_documento($id)
    {
        $this->db->where("id_documento_loc",$id);
        return $this->db->delete("documentos_localizacao");
    }

    public function select_empresas()
    {
        return $this->db->query('SELECT
        *
        FROM empresa' )->result_array();
    }

    public function select_editar($id)
    {
        return $this->db->query('SELECT
        localizacao.*,
        empresa.razao_social
        FROM localizacao
        INNER JOIN empresa on empresa.id_empresa = localizacao.id_empresa
        WHERE localizacao.id_localizacao = '.$this->db->escape($id).'' )->row_array();
    }

    public function update_localizacao($id,$localizacao_info)
    {
        $this->db->where("id_localizacao",$id);
        return $this->db->update("localizacao",$localizacao_info);
    }

    public function update_localizacao_ativa($id,$localizacao_info)
    {
        $this->db->where("id_localizacao",$id);
        return $this->db->update("localizacao",$localizacao_info);
    }

    public function update_localizacao_inativa($id,$localizacao_info)
    {
        $this->db->where("id_localizacao",$id);
        return $this->db->update("localizacao",$localizacao_info);
    }

    public function inserte_localizacao($localizacao_info)
    {
        $this->db->insert("localizacao", $localizacao_info);
    }
    
    public function inserte_documentos($localizacao)
    {
        $this->db->insert("documentos_localizacao", $localizacao);
    }
    
}