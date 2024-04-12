<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_leave extends CI_Migration {

    public function up()
    {
        // Create the leave_requests table
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
                'unsigned' => TRUE,
            ),
            'start_date' => array(
                'type' => 'DATE',
                'null' => FALSE,
            ),
            'end_date' => array(
                'type' => 'DATE',
                'null' => FALSE,
            ),
            'reason' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
            ),
            'status' => array(
                'type' => 'ENUM',
                'constraint' => "'pending','approved','rejected'",
                'default' => 'pending',
            ),
            'created_at' => array(
                'type' => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP',
            ),
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('leave_requests');
    }

    public function down()
    {
        $this->dbforge->drop_table('leave_requests');
    }
}
?>
