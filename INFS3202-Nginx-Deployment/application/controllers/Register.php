<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('encryption');
        $this->load->model('register_model');
        $this->load->helper('captcha');
    }

    // Function to check password strength (must consist number,uppercase,lowercase and symbol)
    public function password_check($str) {
        
        if (preg_match('#[0-9]#', $str) && preg_match('#[a-z]#', $str) && preg_match('#[A-Z]#', $str) && preg_match('#[\W]#', $str)) {
            return TRUE;

        }

        return FALSE;

    }

    public function index() {

        if(isset($_SESSION['id'])) {

            redirect('home');
        }

        // Captcha configuration
        $config = array(
            'img_path'      => 'Icaptcha/',
            'img_url'       => base_url().'Icaptcha/',
            'font_path'     => './path/to/fonts/texb.ttf',
            'img_width'     => '160',
            'img_height'    => 50,
            'word_length'   => 8,
            'font_size'     => 30,
            'pool'          =>  'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789',
            'colors'        => array(
                                        'background' => array(0, 0, 0),
                                        'border' => array(255, 255, 255),
                                        'text' => array(255, 255, 255),
                                        'grid' => array(255, 40, 40)
                                    )
        );

        $captcha = create_captcha($config);

        // Unset previous captcha and set new captcha word
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode', $captcha['word']);

        // Pass captcha image to view
        $data['captchaImg'] = $captcha['image'];

        // Load the view
        $this->load->view('register', $data);

    }


    public function validation() {

        // Check that username field is not empty and unique (trim - remove whitespace before and after)
        $this->form_validation->set_rules('user_name', 'Name', 'required|trim|is_unique[register.name]');
        // Check that email field is not empty, valid(xx@xx.com) and unique
        $this->form_validation->set_rules('user_email', 'Email', 'required|trim|valid_email|is_unique[register.email]');
        /*
            Check that password field is not empty and strong 
            If password is not strong, an error message is set for it 
        */
        $this->form_validation->set_rules('user_pass', 'Password', 'required|min_length[6]|callback_password_check', 
                                            array('password_check' => 'Must contain a number, uppercase, lowercase & symbol'));

        if($this->form_validation->run()) {

            $inputCaptcha = $this->input->post('captcha');
            $sessCaptcha = $this->session->userdata('captchaCode');
    
            if($inputCaptcha === $sessCaptcha) {
                
                $this->session->unset_userdata('captchaCode');
                $verification_key = md5(rand());
                $hashed_password = password_hash($this->input->post('user_pass'),PASSWORD_BCRYPT);
                $data = array (
                    'name'              => $this->input->post('user_name'),
                    'email'             => $this->input->post('user_email'),
                    'password'          => $hashed_password,
                    'verification_key'  => $verification_key
                );
                $id = $this->register_model->insert($data);

                if($id > 0) {

                    $subject = "Verify your account";
                    $message = "<p>Hello ".$this->input->post('user_name')."!</p>
                                <p>Thank you for registering with RevoTube. Please activate your account
                                <a href='".base_url()."register/verifies/".$verification_key."'>here!</a></p>";

                    $config = array(
                        'protocol'      =>  'smtp',
                        'smtp_host'     =>  'mailhub.eait.uq.edu.au',
                        'smtp_port'     =>  25,
                        'newline'       =>  "\r\n",
                        'mailtype'      =>  'html',
                        'charset'       =>  'iso-8859-1',
                        'wordwrap'      =>  TRUE
                    );
                
                    $this->load->library('email', $config);
                    $this->email->from('','Admin @ RevoTube Support');
                    $this->email->to($this->input->post('user_email'));
                    $this->email->subject($subject);
                    $this->email->message($message);


                    if($this->email->send()) {
                        
                        $this->session->set_flashdata('message', 'We\'ve sent you an email! <br>
                        Check your inbox for the verification email and link!');
                        redirect('login');

                    }
                    else {

                        $this->session->set_flashdata('error', 'I don\'t know why or how you triggered it <br>
                        Report this problem thx!');
                        redirect('login');

                    }
        
                }
            }
            else {

                $this->session->set_flashdata('error', 'Wrong Captcha!');
                redirect('register');
                
            }
        }
        else {

            $this->index();

        }
    }

    //Captcha refresh to generate another one
    public function refresh() {

        $config = array(
            'img_path'      => 'Icaptcha/',
            'img_url'       => base_url().'Icaptcha/',
            'font_path'     => './path/to/fonts/texb.ttf',
            'img_width'     => '160',
            'img_height'    => 50,
            'word_length'   => 8,
            'font_size'     => 30,
            'pool'          =>  'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789',
            'colors'        => array(
                                        'background' => array(0, 0, 0),
                                        'border' => array(255, 255, 255),
                                        'text' => array(255, 255, 255),
                                        'grid' => array(255, 40, 40)
                                    )
        );
        //Create another captcha
        $captcha = create_captcha($config);
            
        // Unset previous captcha and set new captcha word
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode', $captcha['word']);
                        
        // Pass captcha image to view
        $data['captchaImg'] = $captcha['image'];
        echo $captcha['image'];

    }
    
    //Verifies if email is verified
    public function verifies() {

        if($this->uri->segment(3)) {

            $verifies_key = $this->uri->segment(3);
            
            if($this->register_model->verifies($verifies_key)) {

                $data["message"] = "Your email has
                                    been verified, you may now log in 
                                    from <a href='".base_url()."login'>here</a>.";

            }
            else {

                $data["message"] = "Your email has already
                                    been verified.
                                    <br>
                                    You may log into your account 
                                    <a href='".base_url()."login'>here</a>.";
                
            }

            $this->load->view('email_verification', $data);

        }
        else {

            $data["message"] = "<h1 align='center'> The link seems
            to be invalid.
            <br>
            Please contact us or retry the link 
            <a href='".base_url()."home'>home</a>
            </h1>";

        }

    }
    
}