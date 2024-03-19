<?php

class Produtos_model extends CI_Model {
    public function index()
    {
        return $this->db->query("SELECT
        produto.*,
        localizacao.nome as nome_localizacao,
        fornecedor.nome as nome_fornecedor,
        empresa.razao_social
        FROM produto
        LEFT JOIN localizacao on localizacao.id_localizacao = produto.id_localizacao
        LEFT JOIN fornecedor on fornecedor.id_fornecedor = produto.id_fornecedor
        INNER JOIN empresa on empresa.id_empresa = produto.id_empresa
        WHERE produto.id_empresa = 1")->result_array();
    }

    public function select_produto_por_empresa($id)
    {
        return $this->db->query('SELECT
        produto.*,
        localizacao.nome as nome_localizacao,
        fornecedor.nome as nome_fornecedor,
        empresa.razao_social
        FROM produto
        LEFT JOIN localizacao on localizacao.id_localizacao = produto.id_localizacao
        LEFT JOIN fornecedor on fornecedor.id_fornecedor = produto.id_fornecedor
        INNER JOIN empresa on empresa.id_empresa = produto.id_empresa
        WHERE produto.id_empresa = '.$this->db->escape($id).'')->result_array();
    }

    public function select_produto_por_empresa_sem_id()
    {
        return $this->db->query('SELECT
        produto.*,
        localizacao.nome as nome_localizacao,
        fornecedor.nome as nome_fornecedor,
        empresa.id_empresa,
        empresa.razao_social
        FROM produto
        LEFT JOIN localizacao on localizacao.id_localizacao = produto.id_localizacao
        LEFT JOIN fornecedor on fornecedor.id_fornecedor = produto.id_fornecedor
        INNER JOIN empresa on empresa.id_empresa = produto.id_empresa')->result_array();
    }

    public function select_dashboard()
    {
        return $this->db->query("SELECT
        produto.*,
        localizacao.nome as nome_localizacao,
        fornecedor.nome as nome_fornecedor,
        empresa.razao_social
        FROM produto
        LEFT JOIN localizacao on localizacao.id_localizacao = produto.id_localizacao
        LEFT JOIN fornecedor on fornecedor.id_fornecedor = produto.id_fornecedor
        INNER JOIN empresa on empresa.id_empresa = produto.id_empresa
        ORDER BY produto.id_produto desc
        LIMIT 5")->result_array();
    }
    public function select_total()
    {
        return $this->db->query("SELECT
        produto.descricao,
        produto.cod_aux,
        SUM(produto.estoque_atual) as estoque_atual
        FROM produto
        INNER JOIN empresa on empresa.id_empresa = produto.id_empresa
        WHERE status = 'T'
        AND
        empresa.situacao = 'T'
        GROUP BY produto.descricao;
        ")->result_array();
    }

    public function select_empresas()
    {
        return $this->db->query("SELECT
        id_empresa,
        razao_social
        FROM empresa;
        ")->result_array();
    }

    public function select_fornecedor()
    {
        return $this->db->query("SELECT
        id_fornecedor,
        nome
        FROM fornecedor;
        ")->result_array();
    }

    public function select_fotos_produto($id)
    {
        return $this->db->query('SELECT
        documentos_produto.id_documento_prod,
        documentos_produto.nome,
        documentos_produto.arquivo,
        produto.descricao
        FROM documentos_produto
        INNER JOIN produto ON produto.id_produto = documentos_produto.id_produto
        WHERE produto.id_produto = '.$this->db->escape($id).' AND arquivo <> ""
        ')->result_array();
    }

    public function select_historico($id)
    {
        return $this->db->query('SELECT
        historico_produto.id_historico, 
        produto.descricao,
        historico_produto.quantidade_antiga as "Quantidade Anterior",
        historico_produto.quantidade_atual as "Quantidade Atual",
        (historico_produto.quantidade_atual - historico_produto.quantidade_antiga) as "Quantidade Movimentada",
        DATE_FORMAT(historico_produto.data_hora, "%d/%m/%Y") as "Data da Atualizacao",
        TIME_FORMAT(historico_produto.data_hora, "%H:%i") as "Hora da Atualizacao",
        historico_produto.operacao as "Tipo da Operação",
        CASE
            WHEN historico_produto.quantidade_antiga > historico_produto.quantidade_atual THEN
                "Baixa De Estoque"
            WHEN historico_produto.quantidade_antiga < historico_produto.quantidade_atual THEN
                "Aumento De Estoque"
            WHEN historico_produto.quantidade_antiga = historico_produto.quantidade_atual THEN
                "Não houve Alteração"
            END as "Status Operação",
        historico_produto.quantidade_atual - historico_produto.quantidade_antiga AS "Movimento"
    FROM historico_produto
    INNER JOIN produto ON produto.id_produto = historico_produto.id_produto
    WHERE historico_produto.id_produto = ' .$this->db->escape($id). '')->result_array();
    }

    public function select_localizacao()
    {
        return $this->db->query('SELECT
        id_localizacao,
        nome
        FROM localizacao;
        ')->result_array();
    }        

    public function select_editar($id)
    {
        return $this->db->query('SELECT
        *
        FROM produto
        WHERE id_produto = ' .$this->db->escape($id).'')->row_array();
    }

    public function inserte($data)
    {
        $this->db->insert("produto", $data);
    }

    public function inserte_documento($data_foto)
    {
        $this->db->insert("documentos_produto", $data_foto);
    }

    public function update_produto_inativa($id,$data)
    {
        $this->db->where("id_produto",$id);
        return $this->db->update("produto",$data);
    }

    public function update_produto_ativa($id,$data)
    {
        $this->db->where("id_produto",$id);
        return $this->db->update("produto",$data);
    }

    public function update_produto($id,$produto_info)
    {
        $this->db->where("id_produto",$id);
        return $this->db->update("produto",$produto_info);
    }


    public function delete_foto($id)
    {
        $this->db->where("id_documento_prod",$id);
        return $this->db->delete("documentos_produto");
    }
  
}