<?php

class Model extends CI_Model
{
    function __construct()
	{
		$this->load->database();
    }
    
    public function insert_User($data)
    {
        $this->db->insert('user',$data);
    }

    public function Login($data)
    {
        $condition = "email =" . "'" . $data['email'] . "' AND " . "password =" . "'" . $data['password'] . "'";
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where($condition);

        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function insert_mitra($data_mitra)
    {
        $this->db->insert('mitra',$data_mitra);
    }

    public function bandingkan($email)
    {
        $condition = "email =" . "'" . $email . "'";
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where($condition);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
   
       } else {
            return false;
        }
    }

    public function LoginMitra($data)
    {
        $condition = "email =" . "'" . $data['email'] . "' AND " . "password =" . "'" . $data['password'] . "'";
        $this->db->select('*');
        $this->db->from('mitra');
        $this->db->where($condition);

        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    
    public function bandingkanMitra($email)
    {
        $condition = "email ="."'".$email."'";
        $this->db->select('*');
        $this->db->from('mitra');
        $this->db->where($condition);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
   
       } else {
            return false;
        }
    }

    public function insertFile($file)
    {
        $this->db->insert('dokumen',$file);
    }


}