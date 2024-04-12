<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leave extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Leave_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $this->load->view('leave/apply_leave');
    }

    public function insert(){
        $this->form_validation->set_rules('txtreason', 'Reason', 'required');
        $this->form_validation->set_rules('txtleavefrom', 'Leave From', 'required');
        $this->form_validation->set_rules('txtleaveto', 'Leave To', 'required');
    
        $employee_id = $this->session->userdata('username'); // Correct session key here
        $reason = $this->input->post('txtreason');
        $leave_from = $this->input->post('txtleavefrom');
        $leave_to = $this->input->post('txtleaveto');
        $description = $this->input->post('txtdescription');
        $applied_on = date('Y-m-d');
    
        $data = array(
            'employee_id' => $employee_id,
            'leave_reason' => $reason,
            'leave_from' => $leave_from,
            'leave_to' => $leave_to,
            'description' => $description,
            'applied_on' => $applied_on
        );
    
        $insert_result = $this->Leave_model->insert_leave_request($data);
    
        if($insert_result) {
            $this->session->set_flashdata('success', "New Leave Applied Successfully"); 
        } else {
            $this->session->set_flashdata('error', "Sorry, New Leave Apply Failed.");
        }
    
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function approve() {
        // Fetch leave list data from the model
        $data['leave_list'] = $this->Leave_model->get_all_leave_requests();
    
        // Load the view to display leave list
        $this->load->view('leave/approve_leave', $data);
    }
    public function approve_leave($leave_id) {
        // Update leave status to 'approved' in the database
        $this->Leave_model->update_leave_status($leave_id, 'approved');
        
        // Redirect back to the leave list page
        redirect('leave/approve');
    }
    public function reject_leave($leave_id) {
        // Update leave status to 'rejected' in the database
        $this->Leave_model->update_leave_status($leave_id, 'rejected');
        
        // Redirect back to the leave list page
        redirect('leave/approve');
    }
    

    public function manage() {
        $data['content']=$this->Leave_model->select_leave();
        $this->load->view('leave/manage-leave',$data);
    }

    public function view()
    {
        $employee_id=$this->session->userdata('employee_id');
        $data['content']=$this->Leave_model->select_leave_byStaffID($employee_id);
        $this->load->view('leave/view-leave',$data);
    }

    public function insert_approve($id)
    {
        $data=$this->Leave_model->update_leave_status($id,1);
        if($this->db->affected_rows() > 0)
        {
            $this->session->set_flashdata('success', "Leave Approved Succesfully"); 
        }else{
            $this->session->set_flashdata('error', "Sorry, Leave Approve Failed.");
        }
        redirect($_SERVER['HTTP_REFERER']);
    }


    public function insert_reject($id)
    {
        $data=$this->Leave_model->update_leave_status($id,2);
        if($this->db->affected_rows() > 0)
        {
            $this->session->set_flashdata('success', "Leave Rejected Succesfully"); 
        }else{
            $this->session->set_flashdata('error', "Sorry, Leave Reject Failed.");
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    
}
?>
