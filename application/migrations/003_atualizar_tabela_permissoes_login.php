<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_atualizar_tabela_permissoes_login extends CI_Migration {

    public function up() {
        $fields = array(
            'vendas' => array(
                'type' => 'CHAR',
                'constraint' => '1',
                'null' => TRUE,
            ),
            'cobranca' => array(
                'type' => 'CHAR',
                'constraint' => '1',
                'null' => TRUE,
            ),
            'viagem' => array(
                'type' => 'CHAR',
                'constraint' => '1',
                'null' => TRUE,
            ),
            'bancos' => array(
                'type' => 'CHAR',
                'constraint' => '1',
                'null' => TRUE,
            ),
            'forma_de_pagamento' => array(
                'type' => 'CHAR',
                'constraint' => '1',
                'null' => TRUE,
            ),
            'status' => array(
                'type' => 'CHAR',
                'constraint' => '1',
                'null' => TRUE,
            ),
        );

        $this->dbforge->add_column('permissoes_login', $fields);
    }

    public function down() {
        $this->dbforge->drop_column('permissoes_login', 'vendas');
        $this->dbforge->drop_column('permissoes_login', 'cobranca');
        $this->dbforge->drop_column('permissoes_login', 'viagem');
        $this->dbforge->drop_column('permissoes_login', 'bancos');
        $this->dbforge->drop_column('permissoes_login', 'forma_de_pagamento');
        $this->dbforge->drop_column('permissoes_login', 'status');
    }
}
