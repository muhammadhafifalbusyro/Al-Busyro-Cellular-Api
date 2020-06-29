<?php

defined('BASEPATH') or exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Register extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Register_model');
    }
    public function index_post()
    {
        $data = [
            'id' => null,
            'username' => $this->post('username'),
            'no_hp' => $this->post('no_hp'),
            'password' => $this->post('password'),

        ];
        $value = $this->Register_model->register($data);
        if ($value > 0) {
            $getDataObject = $this->Register_model->usersGetByUsername($data['username']);
            $message = [
                'data' => [
                    'id' => $getDataObject[0]['id'],
                    'username' => $this->post('username'),
                    'no_hp' => $this->post('no_hp'),
                    'password' => $this->post('password'),
                ],
                'status' => 200,
                'message' => 'register success',
            ];

            $this->set_response($message, REST_Controller::HTTP_CREATED);
        } else {
            $message = [
                'status' => 400,
                'message' => 'username already taken',
            ];
            $this->set_response($message, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

}
