<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_leave_table extends CI_Migration {

    public function up() {
        $fields = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'employee_id' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'leave_reason' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
            ),
            'leave_from' => array(
                'type' => 'DATE',
            ),
            'leave_to' => array(
                'type' => 'DATE',
            ),
            'description' => array(
                'type' => 'TEXT',
            ),
            'status' => array(
                'type' => 'ENUM("pending", "approved", "rejected")',
                'default' => 'pending',
            ),
            'applied_on' => array(
                'type' => 'DATETIME',
            ),
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('leave');
    }

    public function down() {
        $this->dbforge->drop_table('leave');
    }
}
