<?php
class API_RajaOngkir extends CI_Controller
{
    private $api_key = 'b9daece786d1194f73b9b229807fc912';
    private $link_url = 'https://api.rajaongkir.com/starter';

    public function __construct()
    {
        parent::__construct();
    }

    public function getProvince()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->link_url . "/province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: $this->api_key"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            // echo $response;
            $arr_res = json_decode($response, true);
            $province = $arr_res['rajaongkir']['results'];

            echo "<option value=''>-Province-</option>";
            foreach ($province as $key => $value) {
                echo "<option value='" . $value['province_id'] . "' province_id='" . $value['province_id'] . "'>" . $value['province'] . "</option>";
            }
        }
    }

    public function getCity()
    {
        $province_id = $_POST['province_id'];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->link_url . "/city?province=" . $province_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: $this->api_key"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            // echo $response;

            $arr_res = json_decode($response, true);
            $city = $arr_res['rajaongkir']['results'];

            echo "<option value=''>-City-</option>";
            foreach ($city as $key => $value) {
                echo "<option value='" . $value['city_id'] . "' city_id='" . $value['city_id'] . "'>" . $value['city_name'] . "</option>";
            }
        }
    }

    public function getExpedition()
    {
        echo "<option value=''>--Pilih Expedisi--</option>";
        echo "<option value='tiki'>TIKI</option>";
        echo "<option value='pos'>POS Indonesia</option>";
        echo "<option value='jne'>JNE</option>";
    }

    public function getCost()
    {
        // 152 Jakarta Pusat
        $curl = curl_init();
        $id_expedition = $_POST['id_expedition'];
        $id_city = $_POST['id_city'];
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->link_url . "/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=152&destination=" . $id_city . "&weight=1700&courier=" . $id_expedition . "",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: $this->api_key"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            // echo $response;
            $arr_res = json_decode($response, true);
            echo '<pre>';
            print_r($arr_res['rajaongkir']['results'][0]['costs']);
            echo '</pre>';

            $data = $arr_res['rajaongkir']['results'][0]['costs'];
            echo "<option value=''>--Paket--</option>";

            foreach ($data as $key => $value) {
                echo "<option value='" . $value['service'] . "' data_value='" . $value['cost'][0]['value'] . "'>" . $value['service'] .  " / Rp. " . number_format($value['cost'][0]['value'], 0, ',', '.') . " / " . $value['cost'][0]['etd'] . " Hari</option>";
            }
        }
    }
}
