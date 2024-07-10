<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TempModel extends CI_Model{

    public function add_data($postData){
        $postData['status'] = 1;
        $postData['added_on'] = date('Y-m-d H:i:s');
    
        // Use the same query structure
        $sql = "INSERT INTO data(name, email, contact, password, language, gender, status, added_on,image)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?,?)";
        $data=array(
            $postData['name'],
            $postData['email'],
            $postData['contact'],
            $postData['password'],
            $postData['language'],
            $postData['gender'],
            $postData['status'],
            $postData['added_on'],
            $postData['image']
        );
        // print_r($data);
        // die();
        $query = $this->db->query($sql, $data); 
        // Check if insertion was successful
        if ($query) {
            return true;
        } else { 
            return false;
        }
    }
    
    public function update_data($postData){
        
        $sql = "UPDATE data SET name=?, email=?, contact=?, password=?, language=?, gender=?,image=? WHERE id=?";
        $q = $this->db->query($sql, array(
            $postData['name'],
            $postData['email'],
            $postData['contact'],
            $postData['password'],
            $postData['language'],
            $postData['gender'],
            $postData['id'],
            $postData['image']
        ));
        if($q) {
            return true;
        } else {
            return false;
        }
    }
    
    
    public function all_data($id=''){
       if($id!=''){
        $sql = "SELECT * FROM data WHERE id =$id";
        $query = $this->db->query($sql ,array($id));
        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return false;
        }
       }else {
        $sql = "SELECT * FROM data";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }
    
    }
    public function delete_data($id){
        $sql = "DELETE FROM data WHERE id = ?";
        $q = $this->db->query($sql, array($id));
        if($q){
            return true;
        } else {
            return false;
        }
    }
    public function login($email,$password){
        $this->db->where('email',$email);
        $this->db->where('password',$password);
        $query = $this->db->get('data');
        if($query-> num_rows()== 1){
            return $query->row();
        }
        else {
            return false ;
        }
    }
    
    
}