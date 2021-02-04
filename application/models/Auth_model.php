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

    public function activationToken($data)
    {
        return $this->db->insert('user_activation_token', $data);
    }

    public function checkVerify($email, $token, $type)
    {
        if ($type == 'check_email') {
            $this->db->select('*')->from('user_activation_token');
            $this->db->where('email', $email);
            $this->db->order_by('created_at', 'DESC');
            $this->db->limit(1);
            $sql = $this->db->get()->row_array();
            return $sql;
            // return $this->db->get_where('user_activation_token', ['email' => $email])->order_by('created_at', 'ASC')->limit(1)->row_array();
        } else if ($type == 'check_token') {
            return $this->db->get_where('user_activation_token', ['token' => $token])->row_array();
        } else if ($type == 'expired') {
            $this->db->set('deleted_at', date('Y-m-d H:i:s'));
            $this->db->where('email', $email);
            return $this->db->update('user_activation_token');
        } else {
            return 'Something wrong';
        }
    }

    public function softDeleteToken($email)
    {
        $this->db->set('deleted_at', date('Y-m-d H:i:s'));
        $this->db->where('email', $email);
        return $this->db->update('user_activation_token');
    }

    public function verifySuccess($email)
    {
        $this->db->set('is_active', 1);
        $this->db->where('email', $email);
        $this->db->update('users');

        $this->db->set('verify_at', date('Y-m-d H:i:s'));
        $this->db->where('email', $email);
        return $this->db->update('user_activation_token');
    }
}
