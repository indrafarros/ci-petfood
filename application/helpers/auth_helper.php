<?php



function is_login()
{
    $CI = get_instance();

    $roles = $CI->session->userdata('role_id');

    if (!$CI->session->userdata('is_login')) {
        redirect('auth/login');
    } else {
        $menu = 'admin';

        $queryMenu = $CI->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu_id = $queryMenu['id'];

        $userAccess = $CI->db->get_where('user_group_menu', [
            'roles_id' => $roles,
            'menu_id' => $menu_id
        ]);
    }

    if ($userAccess->num_rows() < 1) {
        var_dump($menu);
        die();
        redirect('auth/blocked');
    }
}

function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    $ci->db->where('roles_id', $role_id);
    $ci->db->where('menu_id', $menu_id);
    $result = $ci->db->get('user_group_menu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}

function is_not_login()
{

    $CI = get_instance();
    $roles = $CI->session->userdata('role_id');

    if ($roles) {
        if ($roles == 1) {
            redirect('dashboard');
        } else if ($roles == 2) {
            redirect('dashboard');
        }
    }
}

function user_menu()
{
    $ci = get_instance();
    $roles = $ci->session->userdata('role_id');

    $ci->load->model('Menu_model', 'menu');

    return $ci->menu->get_menu($roles);
}

function user_sub_menu($id_menu)
{

    $ci = get_instance();

    // $ci->load->model('Menu_model', 'menu');

    return $ci->menu->get_sub_menu($id_menu);
}
