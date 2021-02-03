<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class UserController extends RestController
{
    public function __construct()
    {
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
        $this->load->model('API/User_model', 'user');
    }

    public function login_post()
    {
        $email = $this->post('email');
        $password = $this->post('password');


        if (!empty($email) && !empty($password)) {
            $user_check = $this->user->getEmail($email);
            if ($user_check) {
                if (password_verify($password, $user_check['password'])) {
                    $session = [
                        'is_login' => 'true',
                        'first_name' => $user_check['first_name'],
                        'email' => $user_check['email'],
                        'roles' => $user_check['roles']
                    ];
                    $this->session->set_userdata($session);

                    $this->response([
                        'status' => true,
                        'data' =>   $this->session->set_userdata($session)
                    ], 200);
                } else {
                    $this->response([
                        'code' => 404,
                        'status' => false,
                        'message' => 'Email or password wrong'
                    ], 404);
                }
            } else {
                $this->response([
                    'code' => 404,
                    'status' => false,
                    'message' => 'Email or password wrong'
                ], 404);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'Email and password are required',
                'data' => $this->post('email')
            ], 404);
        }
    }

    public function registration_post()
    {
        $first_name = strip_tags($_POST['first_name']);
        $last_name = strip_tags($_POST['last_name']);
        $email = strip_tags($_POST['email']);
        $password = $_POST['password'];

        $token = base64_encode(random_bytes(32));

        if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($password)) {

            $user_check = $this->user->getEmail($email);

            if ($user_check > 0) {
                $this->response([
                    'status' => false,
                    'message' => 'Email already registered, please try another email'
                ], 404);
            } else {
                $data = [
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email' => $email,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'picture_path' => 'default.png',
                    'phone_number' => '',
                    'address' => '',
                    'role_id' => 2,
                    'is_active' => 0,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                $add_data = $this->user->registration($data);

                if ($add_data) {
                    $this->response([
                        'status' => true,
                        'message' => 'Success registered, please check your email for verification account'
                    ], 200);
                } else {
                    $this->response([
                        'status' => false,
                        'message' => 'Failed, please try again'
                    ], 404);
                }
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'You must provide all data'
            ], 400);
        }
    }

    public function updateProfile_post()
    {
    }
}
