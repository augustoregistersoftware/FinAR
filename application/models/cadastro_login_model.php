<?php

class Cadastro_login_model extends CI_Model {
    public function index()
    {
        return $this->db->query("SELECT
        login.*,
        empresa.nome_fantasia,
        permissoes_login.nome_permissao
        FROM login
        INNER JOIN empresa on empresa.id_empresa = login.id_empresa
        INNER JOIN permissoes_login on permissoes_login.id_login = login.id_login")->result_array();
    }


}