<?php

class Clientes_model extends CI_Model {
    public function index()
    {
        return $this->db->query("SELECT
         cliente.*,
         empresa.nome_fantasia as empresa
         FROM cliente
         INNER JOIN empresa on empresa.id_empresa = cliente.id_empresa
         ORDER BY cliente.data_registro DESC LIMIT 5")->result_array();
    }


}