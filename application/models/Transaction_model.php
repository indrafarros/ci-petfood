<?php

class Transaction_model extends CI_Model
{

    public function getMyCart($email, $product_id = null)
    {

        if ($product_id == null) {
            $this->db->where('email', $email);
            $this->db->where('status', 'IN CART');
        } else if ($product_id) {
            $this->db->where('email', $email);
            $this->db->where('product_id', $product_id);
            $this->db->where('status', 'IN CART');
        }
        return  $this->db->get('orders');
        // $query =  $this->db->get('orders');
        // return $query->num_rows();
    }

    public function checkCart($email, $product_id)
    {
        // $this->db->where
    }

    public function getUserOrder($email, $id)
    {
        $this->db->where('email', $email);
        $this->db->where('product_id', $id);
        $this->db->where('status', 'IN CART');
        return $this->db->get('orders')->row_array();
    }

    public function updateOrder($current)
    {
        $qty = $current['qty'];

        $this->db->set('qty', $qty);
        $this->db->set('sub_total', $current['sub_total']);
        $this->db->set('modified', $current['modified']);
        $this->db->where('product_id', $current['product_id']);
        $this->db->where('email', $current['email']);
        return $this->db->update('orders');
    }

    public function new_order($data)
    {
        return $this->db->insert('orders', $data);
    }

    public function new_item($data)
    {
        return $this->db->insert('order_item', $data);
    }
}
