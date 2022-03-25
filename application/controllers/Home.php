<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
	{
		parent::__construct();

        require_once __DIR__ . '/../../assets/ci_helpers/style_helper.php';
        require_once __DIR__ . '/../../assets/ci_libraries/DhonAPI.php';
		require_once __DIR__ . '/../../assets/ci_libraries/DhonAuth.php';
		$this->dhonapi = new DhonAPI;
		$this->dhonauth = new DhonAuth;

        $this->dhonapi->api_url['development'] 	= 'http://localhost/ci_hotel_api/';
		$this->dhonapi->api_url['production'] 	= 'https://dhonstudio.com/ci/hotel_api/';
		$this->dhonapi->username 				= 'admin';
		$this->dhonapi->password 				= 'admin';

        /*
        | -------------------------------------------------------------------
        |  Set up this API db
        | -------------------------------------------------------------------
        */
        $this->database         = ENVIRONMENT == 'testing' ? 'hotel_dev' : 'hotel';
    }

	public function index()
	{
        $data   = [
            'title'         => 'Hotel - Home',
            'body_class'    => 'main-layout',
            'css'           => [
                '<link rel="stylesheet" href="'.base_url('assets/vendor/luxe/').'css/superfish.css">
                <link rel="stylesheet" href="'.base_url('assets/vendor/luxe/').'css/bootstrap-datepicker.min.css">
                <link rel="stylesheet" href="'.base_url('assets/vendor/luxe/').'css/cs-select.css">
                <link rel="stylesheet" href="'.base_url('assets/vendor/luxe/').'css/cs-skin-border.css">
                <link rel="stylesheet" href="'.base_url('assets/vendor/luxe/').'css/themify-icons.css">
                <link rel="stylesheet" href="'.base_url('assets/vendor/luxe/').'css/flaticon.css">
                <link rel="stylesheet" href="'.base_url('assets/vendor/luxe/').'css/icomoon.css">
                <link rel="stylesheet" href="'.base_url('assets/vendor/luxe/').'css/flexslider.css">
                <link rel="stylesheet" href="'.base_url('assets/vendor/luxe/').'css/style.css">
                <script src="'.base_url('assets/vendor/luxe/').'js/modernizr-2.6.2.min.js"></script>',
                $this->css['fontawesome5'],
            ],
            'page'          => 'Home',

            'content'       => $this->dhonapi->get($this->database, 'web_content', ['id_content' => 1])[0],
            'rooms'         => $this->dhonapi->get($this->database, 'rooms'),
        ];

        $this->load->view('ci_templates/header', $data);
		$this->load->view('luxe/topbar');
		$this->load->view('luxe/home');
		$this->load->view('scripts/home');
        $this->load->view('ci_templates/end');
	}

    public function ketersediaan()
	{
        $data   = [
            'title'         => 'Hotel - Ketersediaan',
            'body_class'    => '',
            'css'           => [
                '<link rel="stylesheet" href="'.base_url('assets/vendor/luxe/').'css/superfish.css">
                <link rel="stylesheet" href="'.base_url('assets/vendor/luxe/').'css/bootstrap-datepicker.min.css">
                <link rel="stylesheet" href="'.base_url('assets/vendor/luxe/').'css/cs-select.css">
                <link rel="stylesheet" href="'.base_url('assets/vendor/luxe/').'css/cs-skin-border.css">
                <link rel="stylesheet" href="'.base_url('assets/vendor/luxe/').'css/themify-icons.css">
                <link rel="stylesheet" href="'.base_url('assets/vendor/luxe/').'css/flaticon.css">
                <link rel="stylesheet" href="'.base_url('assets/vendor/luxe/').'css/icomoon.css">
                <link rel="stylesheet" href="'.base_url('assets/vendor/luxe/').'css/flexslider.css">
                <link rel="stylesheet" href="'.base_url('assets/vendor/luxe/').'css/style.css">
                <script src="'.base_url('assets/vendor/luxe/').'js/modernizr-2.6.2.min.js"></script>'
            ],
            'page'          => 'Ketersediaan',

            'content'   => $this->dhonapi->get($this->database, 'web_content', ['id_content' => 1])[0],
        ];

        $this->load->view('ci_templates/header', $data);
		$this->load->view('luxe/availability');
        $this->load->view('ci_templates/end');
	}
}
