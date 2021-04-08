<?php 

defined('BASEPATH') OR exit("NO direct script access is allowed");

class Login_model extends CI_Model {
    public $table='users';

    public function canLogin($email,$password){
        $this->db->where('email',$email);
        $check=$this->db->get($this->table,1);
        if($check->num_rows() > 0){
            $this->db->where('email',$email);
            $this->db->where('is_verified',1);
            $result=$this->db->get($this->table,1);
            $data=$result->result();
            if($result->num_rows() > 0){
                if(password_verify($password,$data[0]->password)){
                    $this->session->set_userdata('email',$email);
                    return true;
                }
                else{
                    return "Password is incorrect";
                }
            }
            else {
                return "Please verify your account";
            }
        }
        else {
            return "Try another email";
        }
    }

}


















?>