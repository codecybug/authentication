<?php defined('BASEPATH') OR exit("No direct script access is allowed");


class Passwordreset_model extends CI_Model {
    public $resettable='passwordreset';
    public $usertable='users';

    public function canReset($id,$code){
        $this->db->where('user_id',$id);
        $this->db->where('code',$code);
        $this->db->where('exp >',time());
        $result=$this->db->get($this->resettable,1);
        if($result->num_rows() > 0){
            return true;
        }
        else{
            return "Invalid or expired code";
        }
    }

    public function createCode($email){
        $this->db->where('email',$email);
        $result=$this->db->get($this->usertable,1);
        $rst=$result->result();
        if($result->num_rows() > 0){
            $code=hash_hmac('sha256',$email.time(),"Mycoolsecret");
            $code=substr($code,0,20);
            $data=array(
                'user_id' => $rst[0]->id,
                'code'  => $code,
                'exp' => time() + 10200
            );
            $this->db->insert($this->resettable,$data);
            return true;
        }
        else{
            return "Account does not exist";
        }
    }

    public function resetPass($id,$password){
        $password=password_hash($password,PASSWORD_DEFAULT);
        $data=array(
            'password' => $password,
        );
        $this->db->where('id',$id);
        $this->db->update($this->usertable,$data);
    }

}







?>