<?php defined('BASEPATH') OR die("No direct script access allowed");




class Dashboard extends CI_Controller {


    public function __construct(){
        parent::__construct();
        if(empty($this->session->userdata('email'))){
            redirect('login');
        }
    }

    public function index(){
        $this->load->view('dashboard');
    }
}













?>