<?php

class Cadastro_login_model extends CI_Model {
    public function index()
    {
        return $this->db->query("SELECT
        login.*,
        empresa.nome_fantasia
        FROM login
        INNER JOIN empresa on empresa.id_empresa = login.id_empresa")->result_array();
    }


}