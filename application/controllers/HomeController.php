<?php

class HomeController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = 'Pet Food';
        $this->load->view('v_home', $data);
    }
}
