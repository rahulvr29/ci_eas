<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Leave_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function insert_leave_request($data)
    {
        // Assuming $data contains 'employee_id' as a field
        $this->db->insert('leave_requests', $data);
        $leave_id = $this->db->insert_id();

        // Check if insertion was successful
        return $leave_id ? true : false;
    }


    public function update_leave_status($leave_id, $status){
        // Update the status of the leave request
        $data = array('status' => $status);
        $this->db->where('id', $leave_id);
        $this->db->update('leave_requests', $data);
    }

    public function get_all_leave_requests()
    {
        return $this->db->get('leave_requests')->result_array();
    }

    public function get_pending_leave_requests()
    {
        $this->db->where('status', 'pending');
        return $this->db->get('leave_requests')->result_array();
    }

    public function get_leave_history($employee_id)
    {
        return $this->db->get_where('leave_requests', ['employee_id' => $employee_id])->result_array();
    }


}



?>