<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_leavereq extends CI_Migration {

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
            'null' => TRUE, // Add nullability option
        ),
        'employeeName' => array( // Change from camelCase to snake_case
            'type' => 'VARCHAR',
            'constraint' => 255,
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
        'created_at' => array(
            'type' => 'DATETIME',
            'default' => 'CURRENT_TIMESTAMP',
        ),
        'updated_at' => array(
            'type' => 'TIMESTAMP', // Change from DATETIME to TIMESTAMP
            'default' => 'CURRENT_TIMESTAMP',
            'on update' => 'CURRENT_TIMESTAMP',
        ),
    );
    $this->dbforge->add_field($fields);
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('leave_requests'); // Changed table name
}

public function down() {
    $this->dbforge->drop_table('leave_requests'); // Changed table name
}
}











