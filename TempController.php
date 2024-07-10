<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class TempController extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('TempModel');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->form_validation->set_error_delimiters('<div class ="text-danger mt-1 mb-3">','</div>');


    }
    public function index (){
        if($this->session->userdata('id')) {
            redirect(base_url('TempController/all_data'));
        }
        $this->load->view('form');
    }
    public function myfunc(){
        // $this->load->helper('form');
        // $this->load->library('form_validation');
        $this->form_validation->set_rules('name','FullName','required|trim|min_length[3]|max_length[20]|alpha_numeric_spaces');
        $this->form_validation->set_rules('email','Email','required|trim|valid_email');
        $this->form_validation->set_rules('contact','Phone Number','required|trim|max_length[10]|min_length[10]');
        $this->form_validation->set_rules('password','Password','required|trim|min_length[7]');
        if(empty($_FILES['image']['name'])){
            $this->form_validation->set_rules('image','Document','required');
        }
        if($this->form_validation->run()){
            //for image
            $config['upload_path'] = './uploads';
            $config['allowed_types'] = '*';
            $this->load->library('upload',$config);
            $this->upload->do_upload('image');
            //to get data of the uploaded file
            $data = $this->upload->data();
            // echo "done!";
            $postData = $this->input->post();
            // to insert data of image in postData
            $postData['image'] = $data['file_name'];
            // $this->load->model('TempModel');
            $check = $this->TempModel->add_data($postData);
            if($check){
                // echo"";
                // echo"<h1>welcome $postData->name";
                $user_data = array(
                    'id' => $check,
                    'name' => $postData['name'],
                    'email' => $postData['email'],
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($user_data);
                 redirect(base_url('TempController/all_data'));
            }else{
                echo"Operation failed!";
            }
        }
        else {
            // $this->form_validation->set_error_delimiters('<div class ="text-danger mt-1 mb-3">','</div>');
            $this->load->view('form');
        }
    }
    //to go in homepage after submit 
    public function all_data($id =''){
        if(!$this->session->userdata('id')) {
            // User is not logged in, redirect to login page
            redirect(base_url('TempController/index'));
        }
        
        if($id!=''){
            $data['arr'] = $this->TempModel->all_data($id); 
            $this->load->view('form',$data);
        } else {
            // Load view
            $data['welcome_msg'] = $this->session->userdata('name');
            $data['arr'] = $this->TempModel->all_data();
            $this->load->view('home',$data);
        }
    }
    
    public function update_data(){
        $this->form_validation->set_rules('name', 'Full Name', 'required|trim|min_length[3]|max_length[20]|alpha_numeric_spaces');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('contact', 'Phone Number', 'required|trim|max_length[10]|min_length[10]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[7]');
        // Add rule for image only if it's empty
        if (empty($_FILES['image']['name'])) {
            $this->form_validation->set_rules('image', 'Profile Image', 'required');
        }
    
        if ($this->form_validation->run()) {
            // Configuring file upload
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 2048; // 2MB max file size
            $this->load->library('upload', $config);
    
            if (!$this->upload->do_upload('image')) {
                // If upload fails, display error
                $error = array('error' => $this->upload->display_errors());
                print_r($error);
            } else {
                // Upload successful, continue processing
                $data = $this->upload->data();
                $postData = $this->input->post();
                $postData['image'] = $data['file_name'];
    
                $check = $this->TempModel->update_data($postData);
                if ($check) {
                    redirect(base_url('TempController/all_data'));
                } else {
                    echo "Operation failed!";
                }
            }
        } else {
            // Form validation failed, load view with validation errors
            $id = $this->input->post("id");
            $data['arr'] = $this->TempModel->all_data($id); 
            $this->load->view('form', $data);
        } 
    }
    

    public function delete_data($id){
            $check = $this->TempModel->delete_data($id);
            if($check){
                redirect(base_url('TempController/all_data'));
            }else {
                echo "Operation failed!";
            }
    }
    public function login(){
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[7]');
    
        if($this->form_validation->run() == FALSE){
            // Validation failed, display form with error messages
            // $this->form_validation->set_error_delimiters('<div class ="text-danger mt-1 mb-3">','</div>');
            $this->load->view('login');
        } else {
            // Validation passed, attempt login
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $check = $this->TempModel->login($email,$password);
    
            if($check){
                // Set session data
                $user_data = array(
                    'id' => $check->id,
                    'name' => $check->name,
                    'email' => $check->email,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($user_data);
                // $this->session->set_flashdata('welcome msg','Welcome '.$check->name.'!');
                // Redirect to dashboard
                redirect(base_url('TempController/all_data'));
            } else {
                // Invalid credentials, show error message
                $data['error'] = 'Invalid email or password';
                // echo "Invalid email or password"
                $this->load->view('login',$data);
            }
        }
    }
    public function logout() {
        $this->session->unset_userdata('id');
        $this->session->sess_destroy();
        redirect(base_url('TempController/index'));
    }
    
    
    
}