<?php defined('BASEPATH') OR exit("No dirrect scripts access is allowed");


class Register_model extends CI_Model {

    public $table='users';

    public function insertNew($data){
        $result=$this->db->insert($this->table,$data);
        return $this->db->insert_id();
    }


    public function activate($id,$code){
        $this->db->where('id',$id);
        $this->db->where('activation_code',$code);
        $this->db->where('code_exp >', time());
        $this->db->where('is_verified',0);
        $result=$this->db->get($this->table);
        if($result->num_rows() > 0){
            $act=array(
                'is_verified' => 1
            );
            $this->db->where('id',$id);
            $this->db->update($this->table,$act);
            return true;
        }
        else{
            return false;
        }
    }



}





















?>