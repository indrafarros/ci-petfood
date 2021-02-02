<?php

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getEmail($email)
    {
        return $this->db->get_where('users', ['email' => $email])->row_array();
    }

    public function registration($data)
    {
        return $this->db->insert('users', $data);
    }

    public function updateProfile()
    {
    }
}
