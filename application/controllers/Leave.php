<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Leave extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Leave_model');
        $this->load->model('Public_model');
        $this->load->database();
        $this->load->library('form_validation');
    }
    public function index()
    {
        $this->load->view('leave/apply_leave');
    }
    public function insert()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txtreason', 'Reason', 'required');
        $this->form_validation->set_rules('txtleavefrom', 'Leave From', 'required');
        $this->form_validation->set_rules('txtleaveto', 'Leave To', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
        } else {
            $username = $this->session->userdata('username');
            $data = $this->db->get_where('users', ['username' => $username])->row_array();
            $e_id = $data['employee_id'];

            // Retrieve data from the employee table based on the obtained employee_id
            $data = $this->db->get_where('employee', ['id' => $e_id])->row_array();

            if ($data) {
                $employee_id = $data['id']; // Assuming 'id' contains employee_id
                $employee_email = $data['email']; // Assuming 'email' is the field name for employee name
                $reason = $this->input->post('txtreason');
                $leave_from = $this->input->post('txtleavefrom');
                $leave_to = $this->input->post('txtleaveto');
                $description = $this->input->post('txtdescription');

                // Prepare data array
                $data = array(
                    'employee_id' => $employee_id,
                    'employeeName' => $employee_email,
                    'leave_reason' => $reason,
                    'leave_from' => $leave_from,
                    'leave_to' => $leave_to,
                    'description' => $description,
                    'applied_on' => date('Y-m-d')
                );

                // Insert data into database
                $this->load->model('Leave_model');
                $insert_result = $this->Leave_model->insert_leave_request($data);

                if ($insert_result) {
                    $this->session->set_flashdata('success', "New Leave Applied Successfully");
                } else {
                    $this->session->set_flashdata('error', "Sorry, New Leave Apply Failed.");
                }
            } else {
                // Handle case where user data retrieval failed
                $this->session->set_flashdata('error', "Unable to retrieve user data.");
            }
        }

        redirect($_SERVER['HTTP_REFERER']);
    }
    public function history()
    {
        $username = $this->session->userdata('username');

        // Retrieve the employee_id from the users    table based on the username
        $data = $this->db->get_where('users', ['username' => $username])->row_array();
        $employee_id = $data['employee_id'];
        $data['leave_history'] = $this->Leave_model->get_leave_history($employee_id);
        $this->load->view('leave/employee_leave', $data);
    }
    public function approve()
    {
        // Fetch leave list data from the model
        $data['leave_list'] = $this->Leave_model->get_all_leave_requests();

        // Remove approved and rejected leave from the list
        $data['leave_list'] = array_filter($data['leave_list'], function ($leave) {
            return $leave['status'] != 'approved' && $leave['status'] != 'rejected';
        });

        // Load the view to display leave list
        $this->load->view('leave/approve_leave', $data);
    }
    public function approve_leave($leave_id){
        // Update leave status to 'approved' in the database
        $this->Leave_model->update_leave_status($leave_id, 'approved');
        // Set flash message for successful approval
        $this->session->set_flashdata('success', 'Successfully approved the leave');
        // Redirect back to the leave list page
        redirect('leave/approve');
    }
    
    public function reject_leave($leave_id){
        // Update leave status to 'rejected' in the database
        $this->Leave_model->update_leave_status($leave_id, 'rejected');
        // Set flash message for successful rejection
        $this->session->set_flashdata('success', 'Successfully rejected the leave');
        // Redirect back to the leave list page
        redirect('leave/approve');
    }
    public function leave_history()
    {
        $data['leave_list'] = $this->Leave_model->get_all_leave_requests();
        $this->load->view('leave/view_leave', $data);
    }
}
?>