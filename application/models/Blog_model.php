<?php

class Blog_model extends CI_Model
{
    public function get_by_slug($slug = null)
    {
        if (is_null($slug)) {
            return array();
        }
        return $this->db->where('slug', $slug)
            ->get('blog')
            ->row_array();
    }
}
