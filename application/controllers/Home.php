<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
	{
		parent::__construct();

        require_once __DIR__ . '/../../assets/ci_helpers/global_helper.php';
        require_once __DIR__ . '/../../assets/ci_helpers/urlencryptor_helper.php';
        require_once __DIR__ . '/../../assets/ci_helpers/style_helper.php';
        require_once __DIR__ . '/../../assets/ci_libraries/DhonAPI.php';
		require_once __DIR__ . '/../../assets/ci_libraries/DhonAuth.php';
		$this->dhonapi = ENVIRONMENT == 'testing' ? $this->load->database('hotel_dev', TRUE) : $this->load->database('hotel', TRUE);
		$this->dhonauth = new DhonAuth;
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

            'rooms'         => $this->dhonapi->get('rooms')->result_array(),
            'facilitations' => $this->dhonapi->get('facilitations')->result_array(),
        ];

        $this->load->view('ci_templates/header', $data);
		$this->load->view('luxe/topbar');
		$this->load->view('luxe/home');
		$this->load->view('luxe/footer');
		$this->load->view('scripts/home');
        $this->load->view('ci_templates/end');
	}

    public function check_availability($status = '')
	{
        $id_room            = $this->input->post('id_room');
        if ($status == '') {
            $start_date         = date('Ymd', strtotime($this->input->post('start_date')));
            $end_date           = date('Ymd', strtotime($this->input->post('end_date')));
        } else if ($status == 'booking') {
            $start_date         = $this->input->post('start_date');
            $end_date         = $this->input->post('end_date');
        }
        $total_room         = $this->input->post('total_room');

        $room_total         = $this->dhonapi->get_where('rooms', ['id_room' => $id_room])->row_array()['room_total'];

        $room_reservation   = 0;
        for ($i=$start_date; $i < $end_date; $i++) {
            $room_booked_pre = $this->dhonapi->get_where('room_reservations', [
                'id_room' => $id_room, 
                'reservation_date' => $i,
                'is_active' => 1,
            ])->num_rows();
            $room_available = $room_total - $room_booked_pre - $total_room;
            $room_booked = $room_booked_pre >= $room_total ? 1 : ($room_available < 0 ? 1 : 0);

            $room_reservation += $room_booked;
        }
        
        if ($room_reservation == 0) {
            if ($status == '') {
                $this->load->helper('string');
                $reservation_code = random_string('alnum', 6);

                $this->dhonapi->insert('reservations', [
                    'reservation_code' => $reservation_code,
                    'id_room' => $id_room,
                    'checkin' => date('Ymd', strtotime($this->input->post('start_date'))),
                    'checkout' => date('Ymd', strtotime($this->input->post('end_date'))),
                    'total_room' => $total_room,
                    'created_at' => time(),
                ]);
                for ($n=1; $n <= $total_room; $n++) {
                    for ($i=$start_date; $i < $end_date; $i++) {
                        $this->dhonapi->insert('room_reservations', [
                            'reservation_code' => $reservation_code,
                            'id_room' => $id_room,
                            'reservation_date' => $i,
                            'created_at' => time()
                        ]);
                    }
                }

                redirect('home/ketersediaan/tersedia/'.encrypt_url($reservation_code));
            } else if ($status == 'booking') {
                $guest_name = $this->input->post('guest_name');
                $guest_email = $this->input->post('guest_email');
                $reservation_code = $this->input->post('reservation_code');

                $guest_av = $this->dhonapi->get_where('guests', ['guest_name' => $guest_name, 'guest_email' => $guest_email])->row_array();

                if (!$guest_av) { 
                    $this->dhonapi->insert('guests', [
                        'guest_name' => $guest_name,
                        'guest_email' => $guest_email,
                        'created_at' => time(),
                    ]);

                    $id_guest = $this->dhonapi->insert_id();
                } else {
                    $id_guest = $guest_av['id_guest'];
                }

                $this->dhonapi->update('reservations', [
                    'is_active' => 1,
                    'id_guest' => $id_guest,
                ], ['reservation_code' => $reservation_code]);

                $this->dhonapi->update('room_reservations', [
                    'is_active' => 1,
                    'id_guest' => $id_guest,
                ], ['reservation_code' => $reservation_code]);      
                
                redirect('home/ketersediaan/success/'.encrypt_url($reservation_code));
            }
        } else {
            redirect('home/ketersediaan/tidaktersedia');
        }
    }

    public function ketersediaan($status, $reservation_code = '')
	{
        $reservation_code = decrypt_url($reservation_code);
        $reservation = $this->dhonapi->join('rooms', 'rooms.id_room = reservations.id_room')->get_where('reservations', ['reservation_code' => $reservation_code])->row_array();

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
            'js'            => [
                $this->js['jquery36']
            ],
            'page'          => 'Ketersediaan',

            'reservation'   => $reservation,
        ];

        $this->load->view('ci_templates/header', $data);
        $this->load->view('luxe/topbar');
		$this->load->view('luxe/'.$status);
        $this->load->view('luxe/footer');
        $this->load->view('scripts/home');  
        $this->load->view('ci_templates/end');
	}

    public function success()
	{
        $data   = [
            'title'         => 'Reservasi Berhasil - Hotel',
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
            'js'            => [
                $this->js['jquery36']
            ],
            'page'          => 'Reservasi Berhasil',

        ];

        $this->load->view('ci_templates/header', $data);
        $this->load->view('luxe/topbar');
		$this->load->view('luxe/success');
        $this->load->view('luxe/footer');
        $this->load->view('scripts/home');  
        $this->load->view('ci_templates/end');
	}

    public function reservation_pdf($reservation_code)
    {
        $reservation_code = decrypt_url($reservation_code);
        $reservation = $this->dhonapi->join('rooms', 'rooms.id_room = reservations.id_room')->join('guests', 'guests.id_guest = reservations.id_guest')->get_where('reservations', ['reservation_code' => $reservation_code])->row_array();

        $data = [
            'reservation' => $reservation,
        ];

        $this->load->view('luxe/reservation_pdf', $data);
    }
}
