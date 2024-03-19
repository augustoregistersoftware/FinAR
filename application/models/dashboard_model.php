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

}