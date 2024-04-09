<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_criar_tabela_permissoes_login extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id_permissao' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'nome_permissao' => array(
                'type' => 'VARCHAR',
                'constraint' => '30',
            ),
            'dashboard' => array(
                'type' => 'CHAR',
                'constraint' => '1',
            ),
            'usuario' => array(
                'type' => 'CHAR',
                'constraint' => '1',
            ),
            'cliente' => array(
                'type' => 'CHAR',
                'constraint' => '1',
            ),
            'produto' => array(
                'type' => 'CHAR',
                'constraint' => '1',
            ),
            'fornecedor' => array(
                'type' => 'CHAR',
                'constraint' => '1',
            ),
            'localizacao' => array(
                'type' => 'CHAR',
                'constraint' => '1',
            ),
            'financeiro' => array(
                'type' => 'CHAR',
                'constraint' => '1',
            ),
            'empresa' => array(
                'type' => 'CHAR',
                'constraint' => '1',
            ),
            'id_login' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
        ));
        $this->dbforge->add_key('id_permissao', TRUE);
        $this->dbforge->create_table('permissoes_login');
    }

    public function down() {
        $this->dbforge->drop_table('permissoes_login');
    }
}
