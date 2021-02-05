<?php

class DashboardController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_login();
    }

    public function index()
    {
        // is_login();
        $this->template->load('templates/admin/v_index', 'dashboard/admin/v_home');
    }

    public function menu_management()
    {
        $data = [
            'user_session' => $this->session->userdata(),
            'menu_title' => user_menu(),
            'title' => 'Menu Management'
        ];

        $this->template->load('templates/admin/v_index', 'dashboard/admin/v_menu');
    }

    public function addMenu()
    {
        $data = [
            'menu' => $_POST['menu_name'],
            'is_active' => 1,
            'created_at' => time()
        ];

        $this->menu->addMenu($data);

        $data = array(
            'csrfName' => $this->security->get_csrf_token_name(),
            'csrfHash' => $this->security->get_csrf_hash()
        );
        echo json_encode($data);
    }

    public function deleteMenu()
    {
        $id_menu = $_POST['id_menu'];
        $this->menu->deleteMenu($id_menu);

        $data = array(
            'csrfName' => $this->security->get_csrf_token_name(),
            'csrfHash' => $this->security->get_csrf_hash()
        );

        echo json_encode($data);
    }

    public function getEditMenu()
    {
        $id_menu = $_POST['id_menu'];
        $data = array(
            'menu' => $this->menu->getDataById($id_menu),
            'csrfName' => $this->security->get_csrf_token_name(),
            'csrfHash' => $this->security->get_csrf_hash()
        );
        echo json_encode($data);
    }

    public function submitEditMenu()
    {
        $data = [
            'id' => $_POST['id_edit_name'],
            'menu' => $_POST['menu_edit_name']
        ];

        $this->menu->submitEdit($data);

        $data = array(

            'csrfName' => $this->security->get_csrf_token_name(),
            'csrfHash' => $this->security->get_csrf_hash()
        );

        echo json_encode($data);
    }

    public function serverside_get_menu()
    {
        if ($this->input->is_ajax_request() == true) {
            $list = $this->menu->get_datatables();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $field) {
                $no++;
                $row = array();
                $id_c = $field->id;
                $row[] = $no;
                $row[] = $field->menu;
                $row[] = '<button class="btn btn-outline-danger btn-sm" id="btnDeleteMenu" value="' . $id_c . '"><i class="fas fa-trash"></i></button>
                            <button class="btn btn-outline-info btn-sm" id="btnEditMenu" data-id="' . $id_c . '" value="' . $field->menu . '"><i class="fas fa-edit"></i></button>';
                $data[] = $row;
            }
            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->menu->count_all(),
                "recordsFiltered" => $this->menu->count_filtered(),
                "data" => $data,
            );

            echo json_encode($output);
        } else {
            exit('Maaf data tidak bisa ditampilkan');
        }
    }
}
