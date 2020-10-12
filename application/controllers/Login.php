<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('encryption');
        $this->load->model('login_model');


    }

    public function index() {
        
        if(isset($_SESSION['id'])) {

            redirect('home');
        }
        else {

            $this->load->view('login');

        }

    }

    public function validation() {

        $this->form_validation->set_rules('user_email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('user_pass', 'Password', 'required');

        $recaptResp = trim($this->input->post('g-recaptcha-response'));
        
        //Google reCaptcha v2 key
        $secret = '6LfCkP0UAAAAADzVmInEaKuQjMQndOE8NDfnJfoI';   

        //API request to google to verity reCaptcha
        $url="https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$recaptResp;
 
        //Set up cURL widget to retrieve response from API
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $output = curl_exec($ch); 
        curl_close($ch);      
        
        /*API Response is a JSON object
        Therefore decode it to PHP variable*/
        $status = json_decode($output, true);

        if($status['success']) {

            if($this->form_validation->run()) {

                $email  =   $this->input->post('user_email');
                $pass   =   $this->input->post('user_pass');

                $result = $this->login_model->validate_user($email,$pass);

                if($result == '') {

                    //Set cookie
                    if ($this->input->post("setremember"))
                    {
                        //Create cookies for 10 years
                        $this->input->set_cookie('email', $email, (time() + (10 * 365 * 24 * 60 * 60))); 
                        $this->input->set_cookie('password', $pass, (time() + (10 * 365 * 24 * 60 * 60))); 
                        
                    }
                    else
                    {

                        delete_cookie('email'); /* Delete email cookie */
                        delete_cookie('password'); /* Delete password cookie */
                        
                    }
                    
                    //Check if user have set up a profile
                    if($_SESSION['profile'] == 'no') {
        
                        redirect('profile');
        
                    }
                    else {

                        redirect('home');

                    }

                }
                else {
                    
                    $this->session->set_flashdata('error', $result);
                    redirect('login');

                }

            }
            else {

                $this->index();

            }

        }
        else{

            $this->session->set_flashdata('error', 'Recaptcha Unsuccessful');
            redirect('login');

        }

    }

}