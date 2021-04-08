<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Register extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('register_model');
    }
    public function index(){
        $this->load->view('register');
    }


    public function singup(){
        $this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[users.email]',array('is_unique'=> "Use another email"));
        $this->form_validation->set_rules('password','Password','required|trim');
        $this->form_validation->set_rules('confpass','Confirm password','required|trim|matches[password]',array('matches' => "Password does not match"));

        if($this->form_validation->run()){
            $email=htmlspecialchars($this->input->post('email'));
            $password=htmlspecialchars($this->input->post('password'));
            $activation_code=hash_hmac('sha256',session_id().$email.time(),'freakykycool');
            $activation_code=substr($activation_code,0,16);
            $code_exp= time() + 7200;
            $data=array(
                'email' => $email,
                'password' => password_hash($password,PASSWORD_DEFAULT),
                'activation_code' => $activation_code,
                'code_exp' => $code_exp
            );
            $id=$this->register_model->insertNew($data);
            if($id > 0){
                $url=base_url('register/verify/'.$id.'/'.$activation_code);
                $this->sendLink($id,$email,$url);
            }

        }
        else{
            $this->index();
        }

    }

    public function sendLink($id,$email,$url){
                $this->load->library('email');
                $this->email->set_newline("\r\n");
                $this->email->from('kolade2127@gmail.com', 'Codecybug');
                $this->email->to($email);
                $this->email->subject('Email Verification Link');
                $message="<p>Click <a href='".$url."'>here</a> to verify your email</p>";
                $message.="<p>Thank you</p>";
                $this->email->message($message);

                if($this->email->send()) {
                    $this->session->set_flashdata('success', "You have sucessfully registered,check your email for verification");
                    redirect('register');
                }
                else{
                    $this->session->set_flashdata('error',"Error in sending mail");
                    redirect('register');
                }
    }

    public function verify(){
        $id=$this->uri->segment(3);
        $code=$this->uri->segment(4);
        if($this->register_model->activate($id,$code)){
            $this->session->set_flashdata('message',"You have sucessfully verified your account");
            redirect('welcome');
        }
        else{
            $this->session->set_flashdata('message',"Invalid link or Expired one");
            redirect('welcome');
        }
       
    }


}




















?>