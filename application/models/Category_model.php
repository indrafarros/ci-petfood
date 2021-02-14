<?php

class Category_model extends CI_Model
{
    public $table = 'product_category'; //nama tabel dari database
    public $column_order = array('id', 'category_name', 'tags', 'created_at'); //Sesuaikan dengan field
    public $column_search = array('category_name', 'tags'); //field yang diizin untuk pencarian 
    public $order = array('category_name' => 'asc'); // default order 
    function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query()
    {

        $this->db->from($this->table);

        $i = 0;

        foreach ($this->column_search as $item) // looping awal
        {
            if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {

                if ($i === 0) // looping awal
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function addCategory($data)
    {
        return $this->db->insert('product_category', $data);
    }

    public function deleteCategory($id_category)
    {
        return $this->db->delete('product_category', ['id' => $id_category]);
    }

    public function getCategory($id_category)
    {
        return $this->db->get_where('product_category', ['id' => $id_category])->row_array();
    }

    public function submitEdit($data)
    {
        // return $this->db->set('category_name', $data['category_name']);
        $this->db->where('id', $data['id']);
        return $this->db->update('product_category', $data);
    }
}
