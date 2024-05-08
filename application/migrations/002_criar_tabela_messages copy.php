<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_criar_tabela_messages extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id_mensagem' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'id_login_emissor' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'id_login' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'conteudo' => array(
                'type' => 'VARCHAR',
                'constraint' => '30',
            ),
            'horario' => array(
                'type' => 'TIME',
            ),
            'status' => array(
                'type' => 'CHAR',
                'constraint' => '1',
            ),
        ));
        $this->dbforge->add_key('id_mensagem', TRUE);
        $this->dbforge->create_table('messages');
    }

    public function down() {
        $this->dbforge->drop_table('messages');
    }
}
