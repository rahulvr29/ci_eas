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

    public function select_leave(){
        $this->db->order_by('leave.id', 'DESC');
        $this->db->from("leave_requests");
        $this->db->join("employee_department", 'employee_department.employee_id = leave.employee_id'); // Corrected join condition
        $this->db->join("department", 'department.id = employee_department.department_id');
        $qry = $this->db->get();
        if ($qry->num_rows() > 0) {
            $result = $qry->result_array();
            return $result;
        }
    }

    public function get_leave_data()
    {
        // Fetch all data from the leave table
        $query = $this->db->get('leave_requests');

        // Return the result as an array
        return $query->result_array();
    }
    function delete_department($id)
    {
        $this->db->where('id', $id);
        $this->db->delete("department");
        $this->db->affected_rows();
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

    public function getAllEmployeeData($username)
    {
        $data = $this->db->get_where('users', ['username' => $username])->row_array();
        $e_id = $data['employee_id'];

        $query = "SELECT employee.id AS `id`,
                         employee.name AS `name`,
                         employee.gender AS `gender`,
                         employee.image AS `image`,
                         employee.birth_date AS `birth_date`,
                         employee.hire_date AS `hire_date`,
                         department.name AS `department`
                   FROM employee
             INNER JOIN employee_department ON employee.id = employee_department.employee_id
             INNER JOIN department ON employee_department.department_id = department.id
                  WHERE `employee`.`id` = $e_id";

        return $this->db->query($query)->row_array();
    }

    public function get_leave_history($employee_id)
    {
        return $this->db->get_where('leave_requests', ['employee_id' => $employee_id])->result_array();
    }


}



?>