<?php

class Auth_model extends CI_Model
{

    public function getUser($email)
    {
        return $this->db->get_where('users', ['email' => $email])->row_array();
    }

    public function registration($data)
    {
        return $this->db->insert('users', $data);
    }
}
