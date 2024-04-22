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
        INNER JOIN permissoes_login on permissoes_login.id_permissao = login.id_perfil")->result_array();
    }

    public function select_senha($idDoLogin)
    {
        return $this->db->query("SELECT
        senha
        FROM login
        WHERE id_login = " .$this->db->escape($idDoLogin). "")->row_array();
    }

    public function select_perfil($id)
    {
        return $this->db->query("SELECT
        * 
        FROM permissoes_login
        WHERE id_permissao =  " .$this->db->escape($id). "")->result_array();
    }

    public function select_perfil_cadastro()
    {
        return $this->db->query("SELECT
        * 
        FROM permissoes_login")->result_array();
    }

    public function select_empresa_cadastro()
    {
        return $this->db->query("SELECT
        * 
        FROM empresa")->result_array();
    }

    public function inserte_login($login_info)
    {
        $this->db->insert("login", $login_info);
    }

    public function deleta($id)
    {
        $this->db->where('id_login', $id);
        $this->db->delete('login');
    }
}