<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Admin extends CI_Controller {
    
    public function __construct()
	{
		parent::__construct();

        require_once __DIR__ . '/../../assets/ci_helpers/urlencryptor_helper.php';
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
        $this->database = ENVIRONMENT == 'testing' ? 'hotel_dev' : 'hotel';

		$user = $this->dhonapi->get($this->database, 'api_users', ['username' => $_SERVER['PHP_AUTH_USER']]);

		$this->dhonauth->auth('', $user[0]);

        $this->language['active'] = 'en';
        
        $this->load->library('form_validation');
	}

	public function index()
	{
        $data = [
            'title'	    => 'Admin - Hotel',
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
		$this->load->view("admin/topbar");
		$this->load->view("admin/sidebar");
        $this->load->view("admin/home");
        $this->load->view("ci_templates/end");
    }

    public function rooms()
	{
        $this->form_validation->set_rules('room_name', 'Room Name', 'trim|min_length[2]|max_length[50]');

        if($this->form_validation->run() == false) {
            $data = [
                'title'	    => 'Room Manager - Hotel',
                'css'       => [
                    $this->css['sb-admin'],
                    $this->css['fontawesome5'],
                ],
                'body_class'    => 'sb-nav-fixed',
                'js'            => [
                    $this->js['jquery36'],
                    $this->js['bootstrap-bundle5'],
                    $this->js['sb-admin'],
                ],

                'page'      => 'Tipe Kamar',

                'rooms'     => $this->dhonapi->get($this->database, 'rooms'),
            ];

            $this->load->view("ci_templates/header", $data);
            $this->load->view("admin/topbar");
            $this->load->view("admin/sidebar");
            $this->load->view("admin/rooms");
            $this->load->view("scripts/admin");
            $this->load->view("ci_templates/end");
        } else {
            $data_insert = [
                'room_name'         => $this->input->post('room_name'),
                'room_description'   => $this->input->post('room_description'),
                'room_total'   => $this->input->post('room_total'),
                'room_price'   => $this->input->post('room_price'),
                'ac'   => $this->input->post('ac'),
                'wifi'   => $this->input->post('wifi'),
                'nosmoking'   => $this->input->post('nosmoking'),
                'breakfast'   => $this->input->post('breakfast'),
                'bed'   => $this->input->post('bed'),
            ];

            if ($this->input->post('id_room')) {
                $data_insert['id_room']  = $this->input->post('id_room');
            }
            
            if ($_FILES['image']['name']) {
                $config['allowed_types']	= 'jpg|jpeg|png|svg';
                $config['max_size']			= '10024';
                $config['upload_path']		= './assets/img/rooms/';
                $config['max_filename']		= '100';
                $config['file_name'] 		= str_replace(array('.jpg', '.jpeg', '.png', '.svg'), array('', '', '', ''), $_FILES['image']['name']);
                $config['overwrite'] 		= TRUE;

                $this->load->library('upload', $config);

                if (!is_dir($config['upload_path'])) {
                    mkdir($config['upload_path'], 0777, true);
                }

                if($this->upload->do_upload('image')){
                    $this->upload->data('file_name');
                    $data_insert['room_photo'] = $this->upload->data('file_name');                    
                } else {
                    echo $this->upload->display_errors();
                }                
            }

            if ($_FILES['image_sliding']['name']) {
                $config2['allowed_types']	= 'jpg|jpeg|png|svg';
                $config2['max_size']		= '10024';
                $config2['upload_path']		= './assets/img/rooms/';
                $config2['max_filename']	= '100';
                $config2['file_name'] 		= str_replace(array('.jpg', '.jpeg', '.png', '.svg'), array('', '', '', ''), $_FILES['image_sliding']['name']);
                $config2['overwrite'] 		= TRUE;

                $this->load->library('upload', $config2);

                if (!is_dir($config2['upload_path'])) {
                    mkdir($config2['upload_path'], 0777, true);
                }

                if($this->upload->do_upload('image_sliding')){
                    $this->upload->data('file_name');
                    $data_insert['room_photo_sliding'] = $this->upload->data('file_name');                    
                } else {
                    echo $this->upload->display_errors();
                }                
            }

            $this->dhonapi->post($this->database, 'rooms', $data_insert);
            redirect('admin/rooms');
        }
    }

    public function facilitations()
	{
        $this->form_validation->set_rules('room_name', 'Room Name', 'trim|min_length[2]|max_length[50]');

        if($this->form_validation->run() == false) {
            $data = [
                'title'	    => 'Facilitation Manager - Hotel',
                'css'       => [
                    $this->css['sb-admin'],
                    $this->css['fontawesome5'],
                ],
                'body_class'    => 'sb-nav-fixed',
                'js'            => [
                    $this->js['jquery36'],
                    $this->js['bootstrap-bundle5'],
                    $this->js['sb-admin'],
                ],

                'page'      => 'Fasilitas',

                'rooms'     => $this->dhonapi->get($this->database, 'facilitations'),
            ];

            $this->load->view("ci_templates/header", $data);
            $this->load->view("admin/topbar");
            $this->load->view("admin/sidebar");
            $this->load->view("admin/facilitations");
            $this->load->view("scripts/admin");
            $this->load->view("ci_templates/end");
        } else {
            $data_insert = [
                'fas_type'         => $this->input->post('fas_type'),
                'fas_class'   => $this->input->post('fas_class'),
                'fas_name'   => $this->input->post('fas_name'),
                'fas_description'   => $this->input->post('fas_description'),
                'fas_hour'   => $this->input->post('fas_hour1').' to '.$this->input->post('fas_hour2'),
            ];

            if ($this->input->post('id_facilitation')) {
                $data_insert['id_facilitation']  = $this->input->post('id_facilitation');
            }
            
            if ($_FILES['image']['name']) {
                $config['allowed_types']	= 'jpg|jpeg|png|svg';
                $config['max_size']			= '10024';
                $config['upload_path']		= './assets/img/facilitations/';
                $config['max_filename']		= '100';
                $config['file_name'] 		= str_replace(array('.jpg', '.jpeg', '.png', '.svg'), array('', '', '', ''), $_FILES['image']['name']);
                $config['overwrite'] 		= TRUE;

                $this->load->library('upload', $config);

                if (!is_dir($config['upload_path'])) {
                    mkdir($config['upload_path'], 0777, true);
                }

                if($this->upload->do_upload('image')){
                    $this->upload->data('file_name');
                    $data_insert['fas_photo'] = $this->upload->data('file_name');                    
                } else {
                    echo $this->upload->display_errors();
                }                
            }

            $this->dhonapi->post($this->database, 'facilitations', $data_insert);
            redirect('admin/facilitations');
        }
    }

    public function content()
	{
        $this->form_validation->set_rules('hotel_name', 'Hotel Name', 'trim|min_length[2]|max_length[200]');

        $content = $this->dhonapi->get($this->database, 'web_content', ['id_content' => 1])[0];

        if($this->form_validation->run() == false) {
            $data = [
                'title'	    => 'Content Manager - Hotel',
                'css'       => [
                    $this->css['sb-admin'],
                    $this->css['fontawesome5'],
                ],
                'body_class'    => 'sb-nav-fixed',
                'js'            => [
                    $this->js['bootstrap-bundle5'],
                    $this->js['sb-admin'],
                ],

                'page'      => 'Dashboard',

                'content'   => $content,
            ];

            $this->load->view("ci_templates/header", $data);
            $this->load->view("admin/topbar");
            $this->load->view("admin/sidebar");
            $this->load->view("admin/content");
            $this->load->view("ci_templates/end");
        } else {
            $hotel_name = $this->input->post('hotel_name') ? $this->input->post('hotel_name') : $content['hotel_name'];
            $welcome_text = $this->input->post('welcome_text') ? $this->input->post('welcome_text') : $content['welcome_text'];
            $welcome_text2 = $this->input->post('welcome_text2') ? $this->input->post('welcome_text2') : $content['welcome_text2'];
            $welcome_description = $this->input->post('welcome_description') ? $this->input->post('welcome_description') : $content['welcome_description'];

            $this->dhonapi->post($this->database, 'web_content', [
                'hotel_name' => $hotel_name,
                'welcome_text' => $welcome_text,
                'welcome_text2' => $welcome_text2,
                'welcome_description' => $welcome_description,
                'id_content' => 1,
            ]);

            redirect('admin/content');
        }
    }

    public function delete($content_type, $id_encrypt)
    {
        $id = decrypt_url($id_encrypt);

        $this->dhonapi->delete($this->database, $content_type, $id);
        redirect('admin/'.$content_type);
    }

    public function logout()
    {
        $this->dhonauth->unauthorized();
    }
}