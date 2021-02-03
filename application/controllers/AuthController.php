<?php

class AuthController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Auth_model', 'auth');

        $this->_url = 'http://localhost/ignited-petfood/authcontroller';
        $this->api_key = '';
        $this->api_user = '';
        $this->api_pass = '';
    }

    private function _configRules()
    {
        $config = [
            [
                'field' => 'first_name',
                'label' => 'first_name',
                'rules' => 'required|alpha_dash|trim',
                'errors' => [
                    'required' => 'This field cannot be null',
                    'alpha_dash' => 'You can only use a-z 0-9 _ . – characters for input'

                ],
            ],
            [
                'field' => 'last_name',
                'label' => 'last_name',
                'rules' => 'required|alpha_dash|trim',
                'errors' => [
                    'required' => 'This field cannot be null',
                    'alpha_dash' => 'You can only use a-z 0-9 _ . – characters for input',
                ],
            ],
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'This field cannot be null.',
                    'is_unique' => 'This email has already registered!'
                ],
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|min_length[6]|matches[password_confirmation]',
                'errors' => [
                    'matches' => 'Password dont match!',
                    'required' => 'You must provide a Password.',
                    'min_length' => 'Minimum Password length is 6 characters',
                ],
            ],
            [
                'field' => 'password_confirmation',
                'label' => 'password_confirmation',
                'rules' => 'required|min_length[6]|matches[password]',
                'errors' => [
                    'matches' => 'Password dont match!',
                    'required' => 'You must provide a Password.',
                    'min_length' => 'Minimum Password length is 6 characters',
                ],
            ],
            [
                'field' => 'phone',
                'label' => 'phone',
                'rules' => 'numeric',
                'errors' => [
                    'numeric' => 'This field only accept numbers',
                ],
            ],
            [
                'field' => 'accept_terms',
                'label' => 'Terms',
                'rules' => 'trim|required|greater_than[0]',
                'errors' => [
                    'required' => 'You should accept terms'
                ]
            ]
        ];


        $rules =  $this->form_validation->set_rules($config);
        return $rules;
    }

    private function _sendEmail($token, $type)
    {
        $emailConfig = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'indradullanov1@gmail.com',
            'smtp_pass' => 'emansudirman123',
            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        ];
        $this->email->initialize($emailConfig);


        $this->email->from('indradullanov1@gmail.com', 'User Activation');
        $this->email->to($_POST['email']);

        if ($type == 'verify') {

            $this->email->subject('Account Verification');
            $this->email->message('Click this link to verify you account : <a href="' . base_url() . 'auth/verify?email=' . $_POST['email'] . '&token=' . urlencode($token) . '">Activate</a>');
        } else if ($type == 'forgot_password') {
            $this->email->subject('Account Verification');
            $this->email->message('Click this link to reset you password account : <a href="' . base_url() . 'auth/reset_password?email=' . $_POST['email'] . '&token=' . urlencode($token) . '">Activate</a>');
        } else if ($type == 'new_token') {

            // $this->email->subject('Account Verification');
            // $this->email->message('Click this link to verify you account : <a href="' . base_url() . 'auth/verify?email=' . $_POST['email'] . '&token=' . urlencode($token) . '">Activate</a>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Something wrong! </div>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function index()
    {
        redirect('auth/login');
    }

    public function loginAPI()
    {
    }

    public function login()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Login';
            $this->load->view('auth/login', $data);
        } else {
            $this->_hasLogin();
        }
    }

    private function _hasLogin()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->auth->getUser($email);

        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $session = [
                        'is_login' => 'true',
                        'first_name' => $user['first_name'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($session);
                    if ($user['roles'] == 1) {
                        redirect('admin/dashboard');
                    } else {
                        redirect('admin/dashboard');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Email or password wrong! </div>');
                    redirect('auth/login');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Email has not been activated! </div>');
                redirect('auth/login');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Email or password wrong! </div>');
            redirect('auth/login');
        }
    }

    public function registration()
    {
        $this->_configRules();

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/register');
        } else {
            $data = array(
                'first_name' => html_escape($_POST['first_name']),
                'last_name' => html_escape($_POST['last_name']),
                'email' => $_POST['email'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'picture_path' => 'default.png',
                'phone_number' => '',
                'address' => '',
                'role_id' => 2,
                'is_active' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );

            $insert = $this->auth->registration($data);

            if ($insert) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Registration successful, please check your email for verication! </div>');
                redirect('auth', 'refresh');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Something wrong, please try again! </div>');
                redirect('qwe');
            }
        }
    }
    public function registrationa()
    {
        $this->_configRules();

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/register');
        } else {
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
                'is_unique' => 'This email has already registered!'
            ]);
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('auth/register');
            } else {
                $data = array(
                    'first_name' => html_escape($_POST['first_name']),
                    'last_name' => html_escape($_POST['last_name']),
                    'email' => $_POST['email'],
                    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                    'picture_path' => 'default.png',
                    'phone_number' => '',
                    'address' => '',
                    'role_id' => 2,
                    'is_active' => 0,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                );
                $this->form_validation->set_data($data);

                $token = base64_encode(random_bytes(32));

                $data_token = array(
                    'email' => $_POST['email'],
                    'token' => $token,
                    'create_at' => time(),
                    'deleted_at' => ''
                );

                $insert = $this->auth->registration($data);
                // $this->auth->create_account_verification($data_token, 'register');

                if ($insert) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Registration successful, please check your email for verication! </div>');
                    // $this->_sendEmail($token, 'verify');
                    // redirect('auth');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Something wrong, please try again! </div>');
                }
            }
        }
    }
}
