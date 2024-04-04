<?php

class Login_model extends CI_Model {
    public function index()
    {
        return $this->db->query("SELECT * FROM empresa")->result_array();
    }

}