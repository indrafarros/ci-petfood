<?php
class API_AuthController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_url = 'http://localhost/ignited-petfood';
        $this->api_key = '';
        $this->api_user = '';
        $this->api_pass = '';
    }

    public function login()
    {
        $data = array(
            'email' => 'asd@asd.com',
            'password' => 'tes'
        );

        $str_data = json_encode($data);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->_url . "/api/usercontroller/login/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $str_data,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
        ));



        $dt = [
            'csrfName' => $this->security->get_csrf_token_name(),
            'csrfHash' => $this->security->get_csrf_hash()
        ];
        $response = curl_exec($curl);

        curl_close($curl);

        $response = array(
            'curl_exec' => $curl,
        );
        echo json_encode($response, $dt);
    }

    public function registration()
    {

        $curl = curl_init();
    }
}
