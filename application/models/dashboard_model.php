<?php

class Dashboard_model extends CI_Model {
    public function select_total_cobranca(){
        return $this->db->query("SELECT COUNT(*) AS quantidade FROM cobranca")->result_array();
    }

    public function select_total_viagem(){
        return $this->db->query("SELECT COUNT(*) AS quantidade FROM viagem")->result_array();
    }

    public function select_total_receber(){
        return $this->db->query("SELECT SUM(receber) AS total_receber
        FROM (
            SELECT
                banco.id_banco,
                COALESCE((
                    SELECT SUM(cobranca.valor)
                    FROM cobranca
                    WHERE cobranca.id_forma_pagto = forma_pagamento.id_forma_pagto 
                      AND cobranca.status = 'T'
                ), 0) AS receber
            FROM banco
            INNER JOIN forma_pagamento ON forma_pagamento.id_banco = banco.id_banco
        ) AS subquery;
        ")->result_array();
    }

    public function select_total_devendo()
    {
        return $this->db->query("SELECT COALESCE(SUM(valor_confirmado), 0.00) AS total_confirmado
        FROM solicitacao_compra
        WHERE status = 'T';        
        ")->result_array();
    }

    public function select_diferenca_compra()
    {
        return $this->db->query("SELECT
        hoje.quantidade AS quantidade_hoje,
        ontem.quantidade AS quantidade_ontem,
        ROUND(
            IF(ontem.quantidade = 0,
               100 * IF(hoje.quantidade > 0, 1, 0),  -- Se ontem = 0 e hoje > 0, 100%; se hoje = 0, 0%
               ((hoje.quantidade - ontem.quantidade) / ontem.quantidade) * 100),
            2
        ) AS diferenca_percentual
    FROM
        (SELECT COUNT(*) AS quantidade
         FROM solicitacao_compra
         WHERE DATE(data_pedido) = CURDATE()) AS hoje,
        (SELECT COUNT(*) AS quantidade
         FROM solicitacao_compra
         WHERE DATE(data_pedido) = CURDATE() - INTERVAL 1 DAY) AS ontem;            
        ")->row_array();
    }

}