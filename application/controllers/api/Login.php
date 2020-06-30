<?php

defined('BASEPATH') or exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

class Login extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
    }
    public function index_post()
    {
        $username = $this->post('username');
        $password = $this->post('password');
        $getData = $this->Login_model->usersGetByUsername($username);
        if ($getData) {
            if ($getData[0]['password'] === $password) {
                $message = [
                    'data' => [
                        'id' => $getData[0]['id'],
                        'username' => $getData[0]['username'],
                        'no_hp' => $getData[0]['no_hp'],
                    ],
                    'status' => 200,
                    'message' => 'Login successful',
                ];

                $this->set_response($message, REST_Controller::HTTP_OK);
            } else {
                $message = [
                    'status' => 400,
                    'message' => 'Password is wrong',
                ];

                $this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            $message = [
                'status' => 400,
                'message' => 'Account not registered',
            ];

            $this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
