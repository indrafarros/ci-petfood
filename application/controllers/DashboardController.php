<?php

class DashboardController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        $this->template->load('templates/admin/v_index', 'admin/v_content');
    }
}
