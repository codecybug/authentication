<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Login extends CI_Controller {



    public function __construct(){
        parent::__construct();
        $this->load->model('login_model');
        $this->load->library('form_validation');
    }
    public function index(){
        $this->load->view('login');
    }

    public function singin(){
        $this->form_validation->set_rules('email','Email','required|trim|valid_email',array('is_unique'=> "Use another email"));
        $this->form_validation->set_rules('password','Password','required|trim');
        if($this->form_validation->run()){
            $email=$this->input->post('email');
            $password=$this->input->post('password');
            $result=$this->login_model->canLogin($email,$password);
            if($result === true){
                redirect('dashboard');
            }
            else{
                $this->session->set_flashdata('error',$result);
                redirect('login');
            }
        }
        else{
            $this->index();
        }

    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('login');
    }


}




















?>