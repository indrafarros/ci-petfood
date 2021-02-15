<?php

class Transaction_model extends CI_Model
{

    // In cart
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

    public function getAllOrder($email)
    {
        $sql = "select orders.*, products.id, products.picture_path, products.product_name from orders left join products on orders.product_id = products.id WHERE email='$email' ORDER BY status DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    // Order success
    public function checkCart($email)
    {
        $sql = "select orders.*, products.id, products.picture_path, products.product_name from orders left join products on orders.product_id = products.id WHERE email='$email' AND status!='SUCCESS' and status !='PENDING'";
        $query = $this->db->query($sql);
        return $query;

        // $this->db->select('orders', 'products.id', 'products.picture_path');
        // $this->db->join('products', 'products.id = orders.product_id', 'left');
        // $this->db->where('status !=', 'SUCCESS');
        // $this->db->where('email', $email);
        // return $this->db->get();
        // $this->db->where
    }

    public function getUserOrder($email, $id)
    {
        $this->db->where('email', $email);
        $this->db->where('product_id', $id);
        $this->db->where('status', 'IN CART');
        return $this->db->get('orders')->row_array();
    }

    public function getPendingOrder($email, $id)
    {
        $this->db->where('email', $email);
        $this->db->where('id', $id);
        $this->db->where('status', 'PENDING');
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
