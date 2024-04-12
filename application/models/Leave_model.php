<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leave_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function insert_leave_request($data) {
        // Assuming $data contains 'employee_id' as a field
        $this->db->insert('leave', $data);
        $leave_id = $this->db->insert_id();
        
        // Join query to fetch employee details associated with the leave request
        $query = $this->db->query("SELECT employee.* FROM employee 
                                   INNER JOIN `leave` ON employee.id = `leave`.employee_id 
                                   WHERE `leave`.id = $leave_id");
        
        // Return the result of the query
        return $query->result();
    }
    
    public function update_leave_status($leave_id, $status) {
        // Update the status of the leave request
        $data = array('status' => $status);
        $this->db->where('id', $leave_id);
        $this->db->update('leave', $data);
    }
    

    public function select_leave() {
        $this->db->order_by('leave.id', 'DESC');
        $this->db->from("leave");
        $this->db->join("employee_department", 'employee_department.employee_id = leave.employee_id'); // Corrected join condition
        $this->db->join("department", 'department.id = employee_department.department_id');
        $qry = $this->db->get();
        if ($qry->num_rows() > 0) {
            $result = $qry->result_array();
            return $result;
        }
    }

    function select_department_byID($id){

        $this->db->where('id',$id);
        $qry=$this->db->get('employee_department');
        if($qry->num_rows()>0)
        {
            $result=$qry->result_array();
            return $result;
        }
    }

    function select_leave_byStaffID($staffid){
        $this->db->order_by('leave.id','DESC');
        $this->db->where('leave.employee_id',$staffid);
        $this->db->select("leave.*,employee.image,employee.name,employee.gender,employee.birth_date,employee.hire_date,employee.shift_id,employee.email,department.name");
        $this->db->from("leave");
        $this->db->join("employee", 'employee.id = leave.employee_id');
        $this->db->join("employee_department", 'employee.id = employee_department.employee_id'); // Corrected join condition
        $this->db->join("department", 'department.id = employee_department.department_id');;
        $qry=$this->db->get();
        if($qry->num_rows()>0)
        {
            $result=$qry->result_array();
            return $result;
        }
    }

    function select_leave_forApprove(){
        $this->db->where('leave.status', 0); // Assuming status 0 represents pending requests
        $this->db->from("leave");
        // $this->db->join("employee", 'employee.id = leave.employee_id');
        // $this->db->join("employee_department", 'employee.id = employee_department.employee_id');
        // $this->db->join("department", 'department.id = employee_department.department_id'); // Corrected join to include department
        $qry = $this->db->get();
        if ($qry->num_rows() > 0) {
            $result = $qry->result_array();
            return $result;
        }
    }

    public function get_leave_data() {
        // Fetch all data from the leave table
        $query = $this->db->get('leave');

        // Return the result as an array
        return $query->result_array();
    }
    

    function delete_department($id){
        $this->db->where('id', $id);
        $this->db->delete("department");
        $this->db->affected_rows();
    }

    // public function update_leave_status($id, $status) {
    //     $this->db->where('id', $id);
    //     $this->db->update('leave', array('status' => $status));
    //     return $this->db->affected_rows() > 0;
    // }

    public function get_all_leave_requests() {
        return $this->db->get('leave')->result_array();
    }

    public function get_pending_leave_requests() {
        $this->db->where('status', 'pending');
        return $this->db->get('leave')->result_array();
    }

    public function getAllEmployeeData($username){
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

    


}



?>
