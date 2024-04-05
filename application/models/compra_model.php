<?php

class Compra_model extends CI_Model {
    public function index()
    {
        return $this->db->query("SELECT
        solicitacao_compra.id_solicitacao,
        solicitacao_compra.descricao,
        solicitacao_compra.valor_confirmado,
        DATE_FORMAT(STR_TO_DATE(solicitacao_compra.data_pedido, '%Y-%m-%d'), '%d/%m/%Y') as data_pedido,
        DATE_FORMAT(STR_TO_DATE(solicitacao_compra.data_entrega, '%Y-%m-%d'), '%d/%m/%Y') as data_entrega,
        solicitacao_compra.status,
        formas.nome as nome_pagamento,
        SUM(produtos_compra.quantidade * produto.custo) as valor,
        banco.nome_banco as nome_banco,
        CASE 
            WHEN STR_TO_DATE(solicitacao_compra.data_entrega, '%Y-%m-%d') < CURRENT_DATE() AND solicitacao_compra.status = 'F' THEN 'Atrasado'
            WHEN solicitacao_compra.status = 'T' THEN 'Finalizado'
            WHEN solicitacao_compra.status = 'C' THEN 'Cancelado'
            ELSE 'Normal'
        END as situacao,
        fornecedor.nome as nome_fornecedor
        FROM 
            solicitacao_compra
        INNER JOIN fornecedor ON fornecedor.id_fornecedor = solicitacao_compra.id_fornecedor
        INNER JOIN forma_pagamento ON forma_pagamento.id_forma_pagto = solicitacao_compra.id_forma_pgto
        INNER JOIN formas ON formas.id_forma = forma_pagamento.nome
        INNER JOIN banco ON banco.id_banco = forma_pagamento.id_banco
        INNER JOIN produtos_compra ON produtos_compra.id_pedido = solicitacao_compra.id_solicitacao
        INNER JOIN produto ON produto.id_produto = produtos_compra.id_produto
        GROUP BY
        solicitacao_compra.id_solicitacao;")->result_array();
    }

    public function select_qtd_id_produto($id)
    {
        return $this->db->query('SELECT
        id_produto,
        quantidade
        FROM produtos_compra
        WHERE id_pedido = '.$this->db->escape($id).'')->row_array();
    }

    public function select_dados_produto($idDoPedido)
    {
        return $this->db->query('SELECT
        produto.id_produto,
        produto.descricao,
        produto.cod_aux,
        produto.custo,
        produto.estoque_atual,
        produtos_compra.quantidade as qtd_comprada,
        produtos_compra.quantidade_recebida as qtd_recebida
        FROM produtos_compra
        INNER JOIN produto on produto.id_produto = produtos_compra.id_produto
        INNER JOIN solicitacao_compra on solicitacao_compra.id_solicitacao = produtos_compra.id_pedido
        WHERE produtos_compra.id_pedido = '.$this->db->escape($idDoPedido).'')->result_array();
    }

    public function select_qtdd_atrasado()
    {
        return $this->db->query('SELECT COUNT(*) as atrasada
        FROM solicitacao_compra
        WHERE data_entrega < CURRENT_DATE()
        AND status = "F"')->row_array();
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


    public function select_cancela($id)
    {
        return $this->db->query('SELECT
        id_produto,
        quantidade_recebida
        FROM
        produtos_compra
        WHERE
        id_pedido = '.$this->db->escape($id).'')->result_array();
    }

    public function select_produtos_compra($id)
    {
        return $this->db->query('SELECT
        produto.id_produto,
        produto.descricao,
        produto.cod_aux,
        produto.custo,
        produto.estoque_atual,
        produtos_compra.quantidade,
        produtos_compra.quantidade_recebida,
        (produto.custo * produtos_compra.quantidade) as total
        FROM produtos_compra
        INNER JOIN produto on produto.id_produto = produtos_compra.id_produto
        WHERE produtos_compra.id_pedido = ' .$this->db->escape($id). '')->result_array();
    }

    public function select_produtos_compra_condicao($id)
    {
        return $this->db->query('SELECT
        produto.id_produto,
        produto.descricao,
        produto.cod_aux,
        produto.custo,
        produto.estoque_atual,
        produtos_compra.quantidade,
        produtos_compra.quantidade_recebida,
        (produto.custo * produtos_compra.quantidade) as total
        FROM produtos_compra
        INNER JOIN produto on produto.id_produto = produtos_compra.id_produto
        WHERE produtos_compra.quantidade_recebida = 0 AND produtos_compra.id_pedido = ' .$this->db->escape($id). '')->result_array();
    }

    public function subtotal($id)
    {
        return $this->db->query('SELECT
        SUM(produto.custo * produtos_compra.quantidade) as subtotal
        FROM 
            produtos_compra
        INNER JOIN 
            produto ON produto.id_produto = produtos_compra.id_produto
        WHERE 
            produtos_compra.id_pedido =  ' .$this->db->escape($id). '')->row_array();
    }

    public function select_formas_pagto()
    {
        return $this->db->query('SELECT
        forma_pagamento.id_forma_pagto,
        formas.nome,
        banco.nome_banco
        FROM forma_pagamento
        INNER JOIN formas on formas.id_forma = forma_pagamento.nome
        INNER JOIN banco on banco.id_banco = forma_pagamento.id_banco')->result_array();
    }

    public function select_arquivo($id)
    {
        return $this->db->query('SELECT
        arquivo
        FROM documentos_compra
        WHERE id_documento_comp= '.$this->db->escape($id).'')->row_array();
    }

    public function select_todos_arquivos($id)
    {
        return $this->db->query('SELECT
        documentos_compra.*,
        solicitacao_compra.descricao
        FROM documentos_compra
        INNER JOIN solicitacao_compra on solicitacao_compra.id_solicitacao = documentos_compra.id_compra
        WHERE id_documento_comp = '.$this->db->escape($id).'')->result_array();
    }

    public function ultimo_id_select()
    {
        return $this->db->query('SELECT id_solicitacao FROM solicitacao_compra ORDER BY id_solicitacao DESC LIMIT 1')->row_array();
    }

    public function remover_item($id,$id_pedido)
    {
        $sql = "DELETE FROM produtos_compra WHERE id_produto = ? AND id_pedido = ?";
    
        // Executa a query com os parâmetros
        return $this->db->query($sql, array($id,$id_pedido));
    }

    public function encerrar($id,$pagamento,$subtotal)
    {
        $sql = "UPDATE solicitacao_compra SET id_forma_pgto = ?, valor_confirmado = ? WHERE id_solicitacao = ?";
    
        // Executa a query com os parâmetros
        return $this->db->query($sql, array($pagamento,$subtotal,$id));
    }

    public function update_cancela($quantidade_recebida,$id_produto)
    {
        $sql = "UPDATE produto SET estoque_atual = estoque_atual - ? WHERE id_produto = ?";
    
        // Executa a query com os parâmetros
        return $this->db->query($sql, array($quantidade_recebida,$id_produto));
    }

    public function update_cancela_status($status,$id)
    {
        $sql = "UPDATE solicitacao_compra SET status =  ? WHERE id_solicitacao = ?";
    
        // Executa a query com os parâmetros
        return $this->db->query($sql, array($status,$id));
    }

    public function update_pedido_fecha($id,$status)
    {
        $this->db->where("id_solicitacao",$id);
        return $this->db->update("solicitacao_compra",$status);
    }

    public function updt_estoque_produto($id_produto,$qtde)
    {
        $sql = "UPDATE produto SET estoque_atual = estoque_atual + ? WHERE id_produto = ?";
    
        // Executa a query com os parâmetros
        return $this->db->query($sql, array($qtde, $id_produto));
    }

    public function updt_recebido_produto($id_pedido,$id_produto,$qtde_recebida)
    {
        $sql = "UPDATE produtos_compra SET quantidade_recebida = ? WHERE id_produto = ? AND id_pedido = ?";
    
        // Executa a query com os parâmetros
        return $this->db->query($sql, array($qtde_recebida,$id_produto,$id_pedido));
    }

    public function update_fornecedor($id,$fornecedor_info)
    {
        $this->db->where("id_produto",$id);
        return $this->db->update("solicitacao_compra",$fornecedor_info);
    }

    public function inserte_compra_documento($compra_arquivo)
    {
        $this->db->insert("documentos_compra", $compra_arquivo);
    }

    public function inserte_compra_produto($compra_produto)
    {
        $this->db->insert("produtos_compra", $compra_produto);
    }

    public function inserte_compra_documentacao($compra_info)
    {
        $this->db->insert("solicitacao_compra", $compra_info);
        return $this->db->insert_id();
    }
}