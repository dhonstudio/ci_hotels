<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Receptionist extends CI_Controller {
    
    public function __construct()
	{
		parent::__construct();

        require_once __DIR__ . '/../../assets/ci_helpers/style_helper.php';
        require_once __DIR__ . '/../../assets/ci_libraries/DhonAPI.php';
		require_once __DIR__ . '/../../assets/ci_libraries/DhonAuth.php';
		$this->dhonapi = new DhonAPI;
		$this->dhonauth = new DhonAuth;

        $this->dhonapi->api_url['development'] 	= 'http://localhost/ci_hotel_api/';
		$this->dhonapi->api_url['production'] 	= 'https://.../';
		$this->dhonapi->username 				= 'admin';
		$this->dhonapi->password 				= 'admin';

		$user = $this->dhonapi->get('hotel', 'api_users', ['username' => $_SERVER['PHP_AUTH_USER']]);

		$this->dhonauth->auth('', $user[0]);

        $this->language['active'] = 'en';
	}

	public function index()
	{
        $data = [
            'title'	    => 'Receptionist - Hotel',
            'css'       => [
				$this->css['sb-admin'],
                $this->css['fontawesome5'],
			],
			'body_class'    => 'sb-nav-fixed',
            'js'            => [
                $this->js['bootstrap-bundle5'],
                $this->js['sb-admin'],
            ],

            'page'  => 'Dashboard'
        ];

        $this->load->view("ci_templates/header", $data);
		$this->load->view("receptionist/topbar");
		$this->load->view("receptionist/sidebar");
        $this->load->view("receptionist/home");
        $this->load->view("ci_templates/end");
    }

    public function logout()
    {
        $this->dhonauth->unauthorized();
    }
}