<?php

class Products_model extends CI_Model
{
    public $table = 'products'; //nama tabel dari database
    public $column_order = array('id', 'picture_path', 'brand', 'product_name', 'description', 'category_id', 'price', 'created_at'); //Sesuaikan dengan field
    public $column_search = array('brand', 'product_name', 'tags'); //field yang diizin untuk pencarian 
    public $order = array('brand' => 'asc'); // default order 
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

    public function addProduct($data)
    {
        return $this->db->insert('products', $data);
    }

    public function deleteProduct($id)
    {
        return $this->db->delete('products', ['id' => $id]);
    }

    public function getProduct($id)
    {
        return $this->db->get_where('products', ['id' => $id])->row_array();
    }

    public function submitProduct($data)
    {
        $id = $data['id'];
        return $this->db->where('id', $id)
            ->update('products', $data);
        // $this->db->where('id', $id);
        // return $this->db->update('products');
    }

    public function fetchProduct()
    {
        $this->db->order_by('created_at', 'asc');
        $this->db->limit(8);
        return $this->db->get('products')->result_array();
        // return $this->db->get('products')->limit(10)->result();
    }

    public function get_by_slug($slug = null)
    {
        if (is_null($slug)) {
            return array();
        }
        return $this->db->where('slug', $slug)
            ->get('products')
            ->row_array();
    }
}
