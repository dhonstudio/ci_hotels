<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Auth extends CI_Controller {
    
    public function __construct()
	{
		parent::__construct();

        require_once __DIR__ . '/../../assets/ci_helpers/urlencryptor_helper.php';
        require_once __DIR__ . '/../../assets/ci_helpers/style_helper.php';
        require_once __DIR__ . '/../../assets/ci_libraries/DhonEmail.php';
        $this->dhonemail = new DhonEmail;
        $this->load->library('form_validation');
        // $this->load->library('google');
        // $this->load->library('facebook');
        $this->load->helper('string');

        $this->load->library('encryption');

        $this->dhonapi = ENVIRONMENT == 'testing' ? $this->load->database('hotel_dev', TRUE) : $this->load->database('hotel', TRUE);

        $this->database         = ENVIRONMENT == 'testing' ? 'project_dev' : 'project';
        $this->table            = 'user_ci';

        if (ENVIRONMENT == 'development') {
            $this->cookie_prefix    = 'm';
            $this->auth_redirect    = 'http://localhost/ci_dashboard';
        } else if (ENVIRONMENT == 'testing') {
            $this->cookie_prefix    = 'm';
            $this->auth_redirect    = 'http://dev....';
        } else {
            $this->cookie_prefix    = '__Secure-';
            $this->auth_redirect    = 'https://...';
        }
        $this->secure_prefix    = 'DSC280322s';
        $this->secure_auth      = "DSA280322k";

        $this->load->helper('cookie');
        
        // if ($this->uri->segment(2) != 'login_google')
        //     if ($this->input->cookie("{$this->cookie_prefix}{$this->secure_auth}") && $this->input->cookie("{$this->cookie_prefix}{$this->secure_prefix}")) {
        //         redirect($this->auth_redirect);
        //     }

        $this->language['active'] = 'en';

        $this->toasts = [
            [
                'id'        => 'email_duplicate',
                'title'     => 'Failed',
                'message'   => 'Email address is already registered'
            ],
            [
                'id'        => 'registration_success',
                'delay'     => 10000,
                'title'     => 'Success',
                'message'   => 'Registration successfully, please verify your account by link sent to your email'
            ],
            [
                'id'        => 'registration_failed',
                'delay'     => 10000,
                'title'     => 'Failed',
                'message'   => 'Registration failed, please repeat your registration'
            ],
            [
                'id'        => 'verify_success',
                'title'     => 'Success',
                'message'   => 'Verification success, please login'
            ],
            [
                'id'        => 'verify_failed',
                'title'     => 'Failed',
                'message'   => 'Verification failed, please contact admin'
            ],
            [
                'id'        => 'forgot_success',
                'delay'     => 10000,
                'title'     => 'Success',
                'message'   => 'Success, please reset password by link sent to your email'
            ],
            [
                'id'        => 'forgot_failed',
                'title'     => 'Failed',
                'message'   => 'Failed, please contact admin'
            ],
            [
                'id'        => 'reset_success',
                'title'     => 'Success',
                'message'   => 'Password successfully changed, please login'
            ],
            [
                'id'        => 'login_failed',
                'title'     => 'Failed',
                'message'   => 'Login Failed'
            ],
        ];

        $this->toast_id = isset($_POST['status']) ? $_POST['status'] : '';

        $this->get_version = isset($_GET['version']) ? $_GET['version'] : (isset($_POST['version']) ? $_POST['version'] : '');
        $this->version = $this->get_version == 'auth2' ? '2' : '';
    }

	public function index()
	{
        if (!isset($_POST['status'])) {
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required|trim');
        }

        if($this->form_validation->run() == false) {
            if ($this->version == '') {
                $data = [
                    'title'         => 'SB Admin - Login',
                    'css'           => [
                        $this->css['sb-admin'],
                    ],
                    'js'            => [
                        $this->js['bootstrap-bundle5'],
                        $this->js['jquery36'],
                    ],
                    'body_class'    => 'bg-primary',
                ];
            }

            /*
            | -------------------------------------------------------------------
            |  Auth Version 2
            | -------------------------------------------------------------------
            */
            else if ($this->version == '2') {
                $data = [
                    'title'         => 'SB Admin 2 - Login',
                    'font'          => [
                        $this->font['google-Nunito'],
                    ],
                    'css'           => [
                        $this->css['fontawesome5'],
                        $this->css['bootstrap5'],
                        $this->css['sb-admin-2'],
                    ],
                    'js'            => [
                        $this->js['jquery36'],
                        $this->js['bootstrap-bundle5'],
                        $this->js['jquery-easing'],
                        $this->js['sb-admin-2'],
                    ],
                    'body_class'    => 'bg-gradient-primary',
                ];
            }

            $this->load->view('ci_templates/header', $data);
            $this->load->view('auth/auth'.$this->version);
            $this->load->view('auth/copyright');
            $this->load->view('ci_templates/toast', ['toasts' => $this->toasts]);
            $this->load->view('ci_scripts/toast_show', ['toast_id' => $this->toast_id]);
            $this->load->view('ci_scripts/google_login');
            $this->load->view('ci_templates/end');
        } else {
            $user = $this->dhonapi->get_where($this->table, ['email' => $this->input->post('email')])->result_array();
            if (!empty($user) && password_verify($this->input->post('password'), $user[0]['password_hash']) && $user[0]['status'] > 9) {
                $this->_login($user);

                redirect('auth/redirect_post?action=home/check_availability&post_name1=id_room&post_value1='.decrypt_url($_GET['id_room']).'&post_name2=start_date&post_value2='.$_GET['start_date'].'&post_name3=end_date&post_value3='.$_GET['end_date'].'&post_name4=total_room&post_value4='.$_GET['total_room']);
            } else {
                redirect('auth?id_room='.encrypt_url($_GET['id_room']).'&start_date='.$_GET['start_date'].'&end_date='.$_GET['end_date'].'&total_room='.$_GET['total_room']);
            }
        }
	}

    private function _login(array $user)
    {
        $auth_cookie = array(
            'name'   => $this->secure_auth,
            'value'  => $this->encryption->encrypt($user[0]['auth_key']),
            'expire' => 365 * 24 * 60 * 60,
            'prefix' => $this->cookie_prefix,
        );
        $this->encryption->initialize(
            array(
                'cipher' => 'aes-256',
                'mode' => 'ctr',
                'key' => $user[0]['auth_key']
            )
        );
        $user_cookie = array(
            'name'   => $this->secure_prefix,
            'value'  => $this->encryption->encrypt($user[0]['id']),
            'expire' => 365 * 24 * 60 * 60,
            'prefix' => $this->cookie_prefix,
        );
        set_cookie($auth_cookie);
        set_cookie($user_cookie);
    }

    public function register()
	{
        if (!isset($_POST['status'])) {
            $this->form_validation->set_rules('firstName', 'First Name', 'required|trim|alpha|min_length[2]|max_length[99]');
            $this->form_validation->set_rules('lastName', 'Last Name', 'required|trim|alpha|min_length[2]|max_length[100]');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|max_length[255]');
            $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|max_length[20]');
            $this->form_validation->set_rules('repeat_password', 'Repeat Password', 'required|trim|matches[password]');
        }

		if($this->form_validation->run() == false) {
            if ($this->version == '') {
                $data = [
                    'title'         => 'SB Admin - Register',
                    'css'           => [
                        $this->css['sb-admin'],
                    ],
                    'js'            => [
                        $this->js['bootstrap-bundle5'],
                        $this->js['jquery36'],
                    ],
                    'body_class'    => 'bg-success',                
                ];
            }

            /*
            | -------------------------------------------------------------------
            |  Auth Version 2
            | -------------------------------------------------------------------
            */
            else if ($this->version == '2') {
                $data = [
                    'title'         => 'SB Admin 2 - Register',
                    'font'          => [
                        $this->font['google-Nunito'],
                    ],
                    'css'           => [
                        $this->css['fontawesome5'],
                        $this->css['bootstrap5'],
                        $this->css['sb-admin-2'],
                    ],
                    'js'            => [
                        $this->js['jquery36'],
                        $this->js['bootstrap-bundle5'],
                        $this->js['jquery-easing'],
                        $this->js['sb-admin-2'],
                    ],
                    'body_class'    => 'bg-gradient-success',
                ];
            }

            $this->load->view('ci_templates/header', $data);
            $this->load->view('register'.$this->version);
            $this->load->view('copyright');
            $this->load->view('ci_templates/toast', ['toasts' => $this->toasts]);
            $this->load->view('ci_scripts/toast_show', ['toast_id' => $this->toast_id]);
            $this->load->view('ci_templates/end');
        } else {
            $users      = $this->dhonapi->get($this->table)->result_array();
            $emails     = array_column($users, 'email');
            if (in_array($this->input->post('email'), $emails)) {
                redirect('auth/redirect_post?action=auth/register&post_name1=status&post_value1=email_duplicate&post_name2=firstName&post_value2='.$this->input->post('firstName').'&post_name3=lastName&post_value3='.$this->input->post('lastName').'&post_name4=email&post_value4='.$this->input->post('email').'&post_name5=version&post_value5='.$_GET['version']);
            } else {
                $token  = base64_encode(random_bytes(32));

                // $this->_sendEmail($token, 'verify');

                $this->dhonapi->insert($this->table, [
                    'email'                 => $this->input->post('email'),
                    'fullName'              => $this->input->post('firstName').' '.$this->input->post('lastName'),
                    'auth_key'              => random_string('alnum', 32),
                    'password_hash'         => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'created_at'            => time(),
                    'verification_token'    => $token,
                    'status'                => 10,
                ]);

                redirect('auth/redirect_post?action=auth&post_name1=status&post_value1=registration_success&post_name2=version&post_value2='.$_GET['version']);
            }
        }
	}

    public function forgot_password()
	{
        if (!isset($_POST['status'])) {
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        }

		if($this->form_validation->run() == false) {
            if ($this->version == '') {
                $data = [
                    'title'         => 'SB Admin - Forgot Password',
                    'css'           => [
                        $this->css['sb-admin'],
                    ],
                    'js'            => [
                        $this->js['bootstrap-bundle5'],
                        $this->js['jquery36'],
                    ],
                    'body_class'    => 'bg-warning',                
                ];
            }

            /*
            | -------------------------------------------------------------------
            |  Auth Version 2
            | -------------------------------------------------------------------
            */
            else if ($this->version == '2') {
                $data = [
                    'title'         => 'SB Admin 2 - Forgot Password',
                    'font'          => [
                        $this->font['google-Nunito'],
                    ],
                    'css'           => [
                        $this->css['fontawesome5'],
                        $this->css['bootstrap5'],
                        $this->css['sb-admin-2'],
                    ],
                    'js'            => [
                        $this->js['jquery36'],
                        $this->js['bootstrap-bundle5'],
                        $this->js['jquery-easing'],
                        $this->js['sb-admin-2'],
                    ],
                    'body_class'    => 'bg-gradient-warning',
                ];
            }

            $this->load->view('ci_templates/header', $data);
            $this->load->view('forgot_password'.$this->version);
            $this->load->view('copyright');
            $this->load->view('ci_templates/toast', ['toasts' => $this->toasts]);            
            $this->load->view('ci_scripts/toast_show', ['toast_id' => $this->toast_id]);
            $this->load->view('ci_templates/end');
        } else {
            $user = $this->dhonapi->get_where($this->table, ['email' => $this->input->post('email')]);
            if (!empty($user) && $user[0]['status'] > 9) {
                $token  = base64_encode(random_bytes(32));

                // $this->_sendEmail($token, 'forgot');

                $this->dhonapi->insert($this->table, [
                    'id'                    => $user[0]['id'],
                    'password_reset_token'  => $token,
                    'status'                => 11,
                    'updated_at'            => time()
                ]);

                redirect('auth/redirect_post?action=auth&post_name1=status&post_value1=forgot_success&post_name2=version&post_value2='.$_GET['version']);
            } else {
                redirect('auth/redirect_post?action=auth/forgot_password&post_name1=status&post_value1=forgot_failed&post_name2=email&post_value2='.$this->input->post('email').'&post_name3=version&post_value3='.$_GET['version']);
            }
        }
	}

    private function _sendEmail(string $token, string $type)
    {
        /*
        | -------------------------------------------------------------------
        | Don't forget to create email_config_helper.php on folder helpers
        | -------------------------------------------------------------------
        | Prototype:
        |
        | <?php
        | 
        | $ci = get_instance();
        | 
        | $ci->email_config = [
        |     'protocol'	=> 'smtp',
        |     'smtp_host'	=> 'ssl://srv.hosting.com',
        |     'smtp_user'	=> 'user@domain.com',
        |     'smtp_pass'	=> 'password',
        |     'smtp_port'	=> 465,
        |     'mailtype'	=> 'html',
        |     'charset'	=> 'utf-8',
        |     'newline'	=> "\r\n",
        |     'wordwrap'	=> TRUE,
        | ];
        */
        
        $this->load->library('email');
        $this->load->helper('email_config');

        $this->email->initialize($this->email_config);
		$this->email->from($this->email_address, $this->email_sender);
		$this->email->to($this->input->post('email'));
		$this->email->cc($this->email_cc);

        if ($type == 'verify') {
            $this->email->subject("Account Verification");
            $this->dhonemail->message(
                "Account Verification", 
                $this->email_logo, 
                $this->input->post('firstName').' '.$this->input->post('lastName'), 
                "Please verify your account by follow this link.<br>
                Link has expired in 24 hour.",
                [
                    'href' => base_url('auth/verify?email='.$this->input->post('email').'&token='.urlencode($token).'&version='.$_GET['version']),
                    'text' => 'Verify'
                ],
                'Add '.$this->email_address.' to prevent our email mark as SPAM. If our email mark as SPAM, please mark as not SPAM.',
                $this->email_sender,
                $this->email_whatsapp
            );

            $fail_redirect = 'auth/redirect_post?action=auth&post_name1=status&post_value1=registration_failed';
        } else if ($type == 'forgot') {
            $fullName = $this->dhonapi->get($this->database, $this->table, ['email' => $this->input->post('email')])[0]['fullName'];
            $this->email->subject("Reset Password");
            $this->dhonemail->message(
                "Reset Password", 
                $this->email_logo, 
                $fullName, 
                "To reset your password, please follow this link.<br>
                Link has expired in 24 hour.",
                [
                    'href' => base_url('auth/reset_password?email='.$this->input->post('email').'&token='.urlencode($token).'&version='.$_GET['version']),
                    'text' => 'Reset Password'
                ],
                'Add '.$this->email_address.' to prevent our email mark as SPAM. If our email mark as SPAM, please mark as not SPAM.',
                $this->email_sender,
                $this->email_whatsapp
            );

            $fail_redirect = 'auth/redirect_post?action=auth/forgot_password&post_name1=status&post_value1=forgot_failed';
        }

        if($this->email->send()) {
			return true;
		} else {
			redirect($fail_redirect);
			die;
		}
    }

    public function verify()
    {
        $expired    = time() - (60*60*24);
        $match      = $this->dhonapi->get($this->database, $this->table, [
            'email'                 => $this->input->get('email'), 
            'verification_token'    => $this->input->get('token'),
            'status'                => 9
        ]);
        if ($match) {
            if ($match[0]['created_at'] > $expired) {
                $this->dhonapi->post($this->database, $this->table, ['status' => 10, 'id' => $match[0]['id']]);
                redirect('auth/redirect_post?action=auth&post_name1=status&post_value1=verify_success&post_name2=version&post_value2='.$_GET['version']);
            } else {
                $this->dhonapi->delete($this->database, $this->table, $match[0]['id']);
                redirect('auth/redirect_post?action=auth&post_name1=status&post_value1=verify_failed&post_name2=version&post_value2='.$_GET['version']);
            }
        } else {
            redirect('auth/redirect_post?action=auth&post_name1=status&post_value1=verify_failed&post_name2=version&post_value2='.$_GET['version']);
        }
    }

    public function reset_password()
    {
        $expired    = time() - (60*60*24);
        $match      = $this->dhonapi->get($this->database, $this->table, [
            'email'                 => $this->input->get('email'),
            'password_reset_token'  => $this->input->get('token'),
            'status'                => 11,
            'updated_at__more'      => $expired,
        ]);
        if ($match) {
            if (!isset($_POST['status'])) {
                $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|max_length[20]');
                $this->form_validation->set_rules('repeat_password', 'Repeat Password', 'required|trim|matches[password]');
            }

            if($this->form_validation->run() == false) {
                if ($this->version == '') {
                    $data = [
                        'title'         => 'SB Admin - Reset Password',
                        'css'           => [
                            $this->css['sb-admin'],
                        ],
                        'js'            => [
                            $this->js['bootstrap-bundle5'],
                            $this->js['jquery36'],
                        ],
                        'body_class'    => 'bg-danger',
                    ];
                }

                /*
                | -------------------------------------------------------------------
                |  Auth Version 2
                | -------------------------------------------------------------------
                */
                else if ($this->version == '2') {
                    $data = [
                        'title'         => 'SB Admin 2 - Reset Password',
                        'font'          => [
                            $this->font['google-Nunito'],
                        ],
                        'css'           => [
                            $this->css['fontawesome5'],
                            $this->css['bootstrap5'],
                            $this->css['sb-admin-2'],
                        ],
                        'js'            => [
                            $this->js['jquery36'],
                            $this->js['bootstrap-bundle5'],
                            $this->js['jquery-easing'],
                            $this->js['sb-admin-2'],
                        ],
                        'body_class'    => 'bg-gradient-danger',
                    ];
                }

                $data['email']  = $this->input->get('email');
                $data['token']  = urlencode($this->input->get('token'));
    
                $this->load->view('ci_templates/header', $data);
                $this->load->view('reset_password'.$this->version);
                $this->load->view('copyright');
                $this->load->view('ci_templates/toast', ['toasts' => $this->toasts]);
                $this->load->view('ci_scripts/toast_show', ['toast_id' => $this->toast_id]);
                $this->load->view('ci_templates/end');
            } else {
                $this->dhonapi->post($this->database, $this->table, ['password_hash' => password_hash($this->input->post('password'), PASSWORD_DEFAULT), 'status' => 10, 'id' => $match[0]['id']]);
                redirect('auth/redirect_post?action=auth&post_name1=status&post_value1=reset_success&post_name2=version&post_value2='.$_GET['version']);
            }
        } else {
            redirect('auth/redirect_post?action=auth&post_name1=status&post_value1=forgot_failed&post_name2=version&post_value2='.$_GET['version']);
        }
    }

    public function redirect_post()
    {
        $data = [
            'action'        => $_GET['action'],
        ];

        $posts = [
            [
                'post_name1'    => $_GET['post_name1'],
                'post_value1'   => $_GET['post_value1'],
            ],
        ];
        for ($i=2; $i <= 10; $i++) { 
            if (isset($_GET['post_name'.$i])) $posts[$i-1]['post_name'.$i] = $_GET['post_name'.$i];
            if (isset($_GET['post_value'.$i])) $posts[$i-1]['post_value'.$i] = $_GET['post_value'.$i];
        }
        $data['posts'] = $posts;

        $this->load->view('ci_templates/redirect_post', $data);
    }
}
