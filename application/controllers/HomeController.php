<?php

class HomeController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Products_model', 'product');
        $this->load->model('Transaction_model', 'transaction');
    }

    public function index()
    {

        $data = array(
            'title' => 'Pet Food',
            'mycart' => $this->transaction->getMyCart($this->session->userdata('email'))->num_rows()
        );
        $this->load->view('v_home', $data);
    }

    public function product()
    {

        $data = array(
            'title' => 'Products',
            'product' => $this->product->fetchProduct(),
            'mycart' => $this->transaction->getMyCart($this->session->userdata('email'))->num_rows()
        );

        $this->load->view('v_home_product', $data);
    }

    public function products($slug)
    {
        $data = array(
            'session' => $this->session->userdata(),
            'product' => $this->product->get_by_slug($slug),
            'mycart' => $this->transaction->getMyCart($this->session->userdata('email'))->num_rows()
        );
        $this->load->view('v_product', $data);
    }

    public function payment()
    {
        $product_id = $_POST['product_id'];
        $data = array(
            'product' => $this->product->getProduct($product_id),
            'session' => $this->session->userdata(),
            'qty' => $_POST['quantity'],
            'mycart' => $this->transaction->getMyCart($this->session->userdata('email'))->num_rows()
        );

        $this->load->view('v_orders', $data);
    }

    public function new_payment()
    {
        $data = array(
            'product_id' => $_POST['product_id'],
            'email' => $_POST['email'],
            'qty' => $_POST['quantity'],
            'note' => $_POST['note'],
            'address' => $_POST['address'],
            'created_at' => date('Y-m-d H:i:s'),
            'mycart' => $this->transaction->getMyCart($this->session->userdata('email'))->num_rows()
        );

        $success = $this->transaction->new_order($data);
        if ($success) {
            redirect('auth');
        } else {
            redirect('home');
        }
    }

    public function checkCart()
    {
        $product_id = $_POST['product_id'];
        $email = $_POST['email'];

        $checkCart = $this->transaction->getMyCart($email, $product_id)->row_array();

        $data = array(
            'csrfName' => $this->security->get_csrf_token_name(),
            'csrfHash' => $this->security->get_csrf_hash(),
            'data' => $checkCart
        );

        echo json_encode($data);
    }

    public function buyNow()
    {
        // $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        if ($this->session->userdata('email')) {

            if ($this->input->is_ajax_request()) {
                $email = $this->session->userdata('email');
                $id = $_POST['product_id'];
                if ($post = $this->product->getProduct($id)) {
                    if ($user_cart = $this->transaction->getUserOrder($email, $id)) {

                        $current = array(
                            'product_id' => $post['id'],
                            'email' => $email,
                            'qty' => $user_cart['qty'] + $_POST['quantity'],
                            'sub_total' => $user_cart['sub_total'] + $_POST['price'],
                            'address' => $_POST['address'],
                            'status' => 'PENDING',
                            'payment' => $_POST['payment_method'],
                            'created_at' => date('Y-m-d H:i:s'),
                            'modified' => date('Y-m-d H:i:s')
                        );

                        $this->transaction->updateOrder($current);

                        $order_item = array(
                            'orders_id' => $user_cart['id'],
                            'product_id' => $post['id'],
                            'quantity' =>  $_POST['quantity'],
                            'created_at' => date('Y-m-d H:i:s')
                        );
                        $this->transaction->new_item($order_item);

                        // $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                        // Order item success! </div>');
                        // redirect('home/orderSuccess');
                        $data = array(
                            'csrfName' => $this->security->get_csrf_token_name(),
                            'csrfHash' => $this->security->get_csrf_hash(),
                            'responce' => 'success',
                            'message' => 'Transaction successfuly'
                        );
                    } else {

                        $new_data = array(
                            'product_id' => $post['id'],
                            'email' => $email,
                            'qty' => $_POST['quantity'],
                            'sub_total' => $_POST['price'],
                            'address' => $_POST['address'],
                            'status' => 'PENDING',
                            'payment_method' => $_POST['payment_method'],
                            'created_at' => date('Y-m-d H:i:s')
                        );
                        $this->transaction->new_order($new_data);

                        $order_item = array(
                            'orders_id' => $this->db->insert_id(),
                            'product_id' => $id,
                            'quantity' => $_POST['quantity'],
                            'created_at' => date('Y-m-d H:i:s')
                        );

                        $this->transaction->new_item($order_item);

                        // $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                        // Order item success! </div>');
                        // redirect('home/orderSuccess');
                        $data = array(
                            'csrfName' => $this->security->get_csrf_token_name(),
                            'csrfHash' => $this->security->get_csrf_hash(),
                            'responce' => 'success',
                            'message' => 'Add to cart successfuly',
                            'test' => $user_cart = $this->transaction->getUserOrder($email, $id)
                        );
                    }
                    // $post = array(
                    //     'product_id' => $post['id'],
                    //     'email' => $email,
                    //     'qty' => 1,
                    //     'sub_total' => $_POST['sub_total'],
                    //     'address' => $_POST['address'],
                    //     'status' => '',
                    //     'payment' => $_POST['payment_method'],
                    //     'created_at' => date('Y-m-d H:i:s')
                    // );

                    // $data = $this->transaction->check_cart($email, $post['id']);

                    // $order_item = array(
                    //     'orders_id' => $this->db->insert_id(),
                    //     'product_id' => $post['id'],
                    //     'qty' => 1
                    // );
                    // $data = array('responce' => 'success', 'message' => 'Add to cart succesfuly', 'post' => $post);
                } else {
                    $data = array('responce' => 'error', 'message' => 'Product not found');
                }
            } else {
                // $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                // You must login to continue this order </div>');
                // redirect('auth/login');
            }
        } else {
            $data = array('responce' => 'error', 'message' => 'You must login to continue this order.');
        }
        echo json_encode($data);
    }

    public function addToCart()
    {

        if ($this->session->userdata('email')) {

            if ($this->input->is_ajax_request()) {
                $email = $this->session->userdata('email');
                $id = $_POST['product_id'];
                if ($post = $this->product->getProduct($id)) {
                    if ($user_cart = $this->transaction->getUserOrder($email, $id)) {

                        $current = array(
                            'product_id' => $post['id'],
                            'email' => $email,
                            'qty' => $user_cart['qty'] + $_POST['quantity'],
                            'sub_total' => $user_cart['sub_total'] + $_POST['subtotal'],
                            'address' => $user_cart['address'],
                            'status' => 'IN CART',
                            'payment' => $user_cart['payment_method'],
                            'created_at' => date('Y-m-d H:i:s'),
                            'modified' => date('Y-m-d H:i:s')
                        );

                        $this->transaction->updateOrder($current);

                        $order_item = array(
                            'orders_id' => $user_cart['id'],
                            'product_id' => $post['id'],
                            'quantity' =>  $_POST['quantity'],
                            'created_at' => date('Y-m-d H:i:s')
                        );

                        $this->transaction->new_item($order_item);

                        $data = array(
                            'csrfName' => $this->security->get_csrf_token_name(),
                            'csrfHash' => $this->security->get_csrf_hash(),
                            'responce' => 'success',
                            'status' => 'update',
                            'message' => 'Add to cart successfuly',
                            // 'data' =>  $this->transaction->getMyCart($email, $id)->row_array()
                        );
                    } else {

                        $new_data = array(
                            'product_id' => $post['id'],
                            'email' => $email,
                            'qty' => $_POST['quantity'],
                            'sub_total' => $_POST['subtotal'],
                            'address' => '',
                            'status' => 'IN CART',
                            'payment_method' => 'NULL',
                            'created_at' => date('Y-m-d H:i:s')
                        );
                        $this->transaction->new_order($new_data);

                        $order_item = array(
                            'orders_id' => $this->db->insert_id(),
                            'product_id' => $id,
                            'quantity' => $_POST['quantity'],
                            'created_at' => date('Y-m-d H:i:s')
                        );

                        $this->transaction->new_item($order_item);

                        $data = array(
                            'csrfName' => $this->security->get_csrf_token_name(),
                            'csrfHash' => $this->security->get_csrf_hash(),
                            'responce' => 'success',
                            'status' => 'new',
                            'message' => 'Add to cart successfuly',
                            // 'data' =>  $this->transaction->getMyart($email, $id)->row_array()
                        );
                    }
                } else {
                    $data = array('responce' => 'error', 'message' => 'Product not found');
                }
            }
        } else {
            $data = array('responce' => 'error', 'message' => 'You must login to continue this order.');
        }
        echo json_encode($data);
    }

    public function myCart()
    {
        $data = array(
            'session' => $this->session->userdata(),
            'mycart' => $this->transaction->getMyCart($this->session->userdata('email'))->num_rows(),
            'product' => $this->transaction->getMyCart($this->session->userdata('email'))->result_array()
        );

        $this->load->view('v_mycart', $data);
    }

    public function orderSuccess()
    {
        $email = $this->session->userdata('email');
        if ($email) {
            $data = array(
                'title' => 'Checkout success',
                'session' => $this->session->userdata(),
                'mycart' => $this->transaction->getMyCart($this->session->userdata('email'))->num_rows(),
                'product' => $this->transaction->getMyCart($this->session->userdata('email'))->result_array()
            );

            $this->load->view('v_order_success', $data);
        } else {
            redirect('home');
        }
    }

    public function blog()
    {
        $data = array(
            'session' => $this->session->userdata()
        );

        $this->load->view('v_blog', $data);
    }
}
