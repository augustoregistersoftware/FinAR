<?php

class Message_model extends CI_Model {
    public function quantidade_mensagem($id)
    {
        return $this->db->query("SELECT COUNT(*) as quantidade_messagem
        FROM messages 
        WHERE id_login = ".$this->db->escape($id)." AND status = 'F'")->row_array();
    }

    public function conteudos_mensagem_listagem($id)
    {
        return $this->db->query("SELECT
        login.nome,
        messages.conteudo,
        CASE
            WHEN TIMESTAMPDIFF(HOUR, messages.horario, CURRENT_TIME()) > 0 THEN 
                CONCAT(TIMESTAMPDIFF(HOUR, messages.horario, CURRENT_TIME()), ' horas')
            WHEN TIMESTAMPDIFF(MINUTE, messages.horario, CURRENT_TIME()) > 0 THEN 
                CONCAT(TIMESTAMPDIFF(MINUTE, messages.horario, CURRENT_TIME()), ' minutos')
            ELSE
                CONCAT(TIMESTAMPDIFF(SECOND, messages.horario, CURRENT_TIME()), ' segundos')
        END AS tempo_passado
    FROM
        messages
    INNER JOIN login ON login.id_login = messages.id_login_emissor
    WHERE messages.id_login = ".$this->db->escape($id)." AND status = 'F'")->result_array();
    }

    public function ciencia_mensagem($id)
    {
        $this->db->query("UPDATE messages SET status = 'T' WHERE id_login = ".$this->db->escape($id)." AND status = 'F'");
        redirect("dashboard");
    }

}