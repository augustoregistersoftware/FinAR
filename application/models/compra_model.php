<?php

class Compra_model extends CI_Model {
    public function index()
    {
        return $this->db->query("SELECT
        solicitacao_compra.id_solicitacao,
        solicitacao_compra.descricao,
        DATE_FORMAT(STR_TO_DATE(solicitacao_compra.data_pedido, '%Y-%m-%d'), '%d/%m/%Y') as data_pedido,
        DATE_FORMAT(STR_TO_DATE(solicitacao_compra.data_entrega, '%Y-%m-%d'), '%d/%m/%Y') as data_entrega,
        solicitacao_compra.valor,
        solicitacao_compra.status,
        formas.nome as nome_pagamento,
        banco.nome_banco as nome_banco,
        CASE 
        WHEN solicitacao_compra.data_entrega > CURDATE() THEN
        'Atrasado'
        ELSE
        'Normal'
        END as situacao,
        fornecedor.nome as nome_fornecedor
        FROM solicitacao_compra
        INNER JOIN fornecedor on fornecedor.id_fornecedor = solicitacao_compra.id_fornecedor
        INNER JOIN forma_pagamento on forma_pagamento.id_forma_pagto = solicitacao_compra.id_forma_pgto
        INNER JOIN formas on formas.id_forma = forma_pagamento.nome
        INNER JOIN banco on banco.id_banco = forma_pagamento.id_banco")->result_array();
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

    public function select_editar($id)
    {
        return $this->db->query('SELECT
        *
        FROM fornecedor
        WHERE id_fornecedor = '.$this->db->escape($id).'')->row_array();
    }

    public function select_arquivo($id)
    {
        return $this->db->query('SELECT
        arquivo
        FROM documentos_fornecedor
        WHERE id_documento_fornc = '.$this->db->escape($id).'')->row_array();
    }

    public function delete_documento($id)
    {
        $this->db->where("id_documento_fornc",$id);
        return $this->db->delete("documentos_fornecedor");
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

    public function update_fornecedor($id,$fornecedor_info)
    {
        $this->db->where("id_fornecedor",$id);
        return $this->db->update("fornecedor",$fornecedor_info);
    }

    public function inserte_documentos($fornecedor)
    {
        $this->db->insert("documentos_fornecedor", $fornecedor);
    }

    public function inserte_fornecedor($fornecedor_info)
    {
        $this->db->insert("fornecedor", $fornecedor_info);
    }
}