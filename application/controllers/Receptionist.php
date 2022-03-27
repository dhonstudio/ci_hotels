<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Receptionist extends CI_Controller {
    
    public function __construct()
	{
		parent::__construct();

        require_once __DIR__ . '/../../assets/ci_helpers/global_helper.php';
        require_once __DIR__ . '/../../assets/ci_helpers/style_helper.php';
		require_once __DIR__ . '/../../assets/ci_libraries/DhonAuth.php';
		$this->dhonauth = new DhonAuth;

        $this->dhonapi = ENVIRONMENT == 'testing' ? $this->load->database('hotel_dev', TRUE) : $this->load->database('hotel', TRUE);

		$user = $this->dhonapi->get_where('api_users', ['username' => $_SERVER['PHP_AUTH_USER']])->result_array();

        if ($_SERVER['PHP_AUTH_USER'] == 'admin') $this->dhonauth->unauthorized();
		$this->dhonauth->auth('', $user[0]);

        $this->language['active'] = 'en';

        $this->load->library('form_validation');
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

    public function search()
	{
        $this->form_validation->set_rules('reservation_code', 'Reservation Code', 'trim|min_length[6]|max_length[6]');
        $this->form_validation->set_rules('guest_name', 'Nama Tamu', 'trim|min_length[2]|max_length[100]');

        $data = [
            'title'	    => 'Cari Reservasi - Hotel',
            'css'       => [
                $this->css['sb-admin'],
                $this->css['fontawesome5'],
            ],
            'body_class'    => 'sb-nav-fixed',
            'js'            => [
                $this->js['bootstrap-bundle5'],
                $this->js['sb-admin'],
            ],

            'page'  => 'Cari Reservasi'
        ];

        $this->load->view("ci_templates/header", $data);
        $this->load->view("receptionist/topbar");
        $this->load->view("receptionist/sidebar");

        if($this->form_validation->run() == false) {            
            $this->load->view("receptionist/search");
            $this->load->view("ci_templates/end");
        } else {
            $reservation_code = $this->input->post('reservation_code');
            $guest_name = $this->input->post('guest_name');

            if ($reservation_code) {
                $reservation = $this->dhonapi->join('rooms', 'rooms.id_room = reservations.id_room')->join('guests', 'guests.id_guest = reservations.id_guest')->get_where('reservations', ['reservation_code' => $reservation_code])->row_array();
            } else {
                $reservation = $this->dhonapi->join('rooms', 'rooms.id_room = reservations.id_room')->join('guests', 'guests.id_guest = reservations.id_guest')->get_where('reservations', ['guest_name' => $guest_name])->row_array();
            }

            if ($reservation) {
                $data['reservation'] = $reservation;

                $this->load->view("receptionist/search_result", $data);
            } else {
                $this->load->view("receptionist/no_result");
            }
            $this->load->view("ci_templates/end");
        }
    }

    public function availability()
	{
        $this->form_validation->set_rules('reservation_code', 'Reservation Code', 'trim|min_length[6]|max_length[6]');

        $data = [
            'title'	    => 'Ketersediaan - Hotel',
            'css'       => [
                $this->css['sb-admin'],
                $this->css['fontawesome5'],
            ],
            'body_class'    => 'sb-nav-fixed',
            'js'            => [
                $this->js['bootstrap-bundle5'],
                $this->js['sb-admin'],
            ],

            'page'  => 'Ketersediaan'
        ];

        $this->load->view("ci_templates/header", $data);
        $this->load->view("receptionist/topbar");
        $this->load->view("receptionist/sidebar");

        if($this->form_validation->run() == false) {            
            $this->load->view("receptionist/availability");
            $this->load->view("ci_templates/end");
        } else {
            $checkin    = $this->input->post('checkin');
            $rooms      = $this->dhonapi->get('rooms')->result_array();

            $data['rooms']      = $rooms;
            $data['checkin']    = $checkin;

            function room_available($id_room, $checkin)
            {
                $ci = get_instance();

                $room_total     = $ci->dhonapi->get_where('rooms', ['id_room' => $id_room])->row_array()['room_total'];
                $room_booked    = $ci->dhonapi->get_where('room_reservations', [
                    'id_room' => $id_room, 
                    'reservation_date' => $checkin,
                    'is_active' => 1,
                ])->num_rows();
                
                return $room_total - $room_booked;
            }

            $this->load->view("receptionist/availability_result", $data);
            $this->load->view("ci_templates/end");
        }
    }

    public function logout()
    {
        $this->dhonauth->unauthorized();
    }
}