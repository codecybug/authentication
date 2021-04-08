<?php defined('BASEPATH') OR die("No direct script access allowed");




class Passwordreset extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('passwordreset_model');
        $this->load->library('form_validation');
    }


    public function index(){
        $this->load->view('passwordreset');
    }

    public function create(){
        $this->form_validation->set_rules('email','Email','required|trim|valid_email');
        if ($this->form_validation->run()){
            $email=$this->input->post('email');
            $result=$this->passwordreset_model->createCode($email);
            if($result === true){
                $url=base_url('passwordreset/verify');
                $this->load->library('email');
                $this->email->set_newline("\r\n");
                $this->email->from('kolade2127@gmail.com', 'Codecybug');
                $this->email->to($email);
                $this->email->subject('Email Verification Link');
                $message="<p>Click <a href='".$url."'>here</a> to update your password</p>";
                $message.="<p>Thank you</p>";
                $this->email->message($message);

                if($this->email->send()) {
                    $this->session->set_flashdata('message', "check your email for password reset link");
                    redirect('passwordreset');
                }
                else{
                    $this->session->set_flashdata('message',"Error in sending mail");
                    redirect('passwordreset');
                }
            }
            else{
                $this->session->set_flashdata('message',$result);
                redirect('passwordreset');
            }
        }
        else{
            $this->index();
        }
    }
    public function verify(){
        $id=$this->uri->segment(3);
        $code=$this->uri->segment(4);
        $result=$this->passwordreset_model->canReset($id,$code);
        if($result === true){
            $data=array(
                'id' => $id
            );

            $this->load->view('inputreset',$data);
        }
        else{
                $this->session->set_flashdata('message',$result);
                redirect('passwordreset');
        }
    }

    public function do(){
        $this->form_validation->set_rules('password','Password','required|trim');
        $this->form_validation->set_rules('confpass','Password','required|trim|matches[password]');
        if($this->form_validation->run()){
            $id=$this->input->post('id');
            $password=$this->input->post('password');
            if(!empty($id)){
                $this->passwordreset_model->resetPass($id,$password);
                $this->session->set_flashdata('message',"You have sucessfully updated your password");
                redirect('passwordreset');
            }
            else{
                $this->session->set_flashdata('message',"Error in validating your request");
                redirect('passwordreset');
            }
        }
    }




}













?>