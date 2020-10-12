<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgot extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('register_model');

    }

    public function index() {

        if(isset($_SESSION['id'])) {

            redirect('home');

        }
        else {

            $this->load->view('forgot');

        }
    }

    //Send reset password link
    public function sendlink() {

        $this->form_validation->set_rules('user_email', 'Email', 'required|trim|valid_email');

        if ($this->form_validation->run()) {

            $data = $this->input->post('user_email');

            //Check if user email exist in database
            if ($this->register_model->checkemail($data)) {

                $this->session->set_userdata('email', $data);

                if($this->session->tempdata('code')) {

                    $temp = $this->session->tempdata();
                    $message = "<p>Hello!</p>
                    <p>You have requested to reset your password.</p>
                    <p>Click <a href='".base_url()."forgot/validate/".$temp['code']."'>here</a> to reset it now.</p> 
                    <p>Ignore this email if you didn't request it.</p>
                    <p>Note that this link will expire in 5 minutes.</p>";

                }
                else {

                    $temp = md5(rand());
                    $this->session->set_tempdata('code', $temp, 300);
                    $message = "<p>Hello!</p>
                    <p>You have requested to reset your password.</p>
                    <p>Click <a href='".base_url()."forgot/validate/".$temp."'>here</a> to reset it now.</p>
                    <p>Ignore this email if you didn't request it.</p>
                    <p>Note that this link will expire in 5 minutes.</p>";

                }
                
                $subject = "Reset Password";
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
                    
                    $this->session->set_flashdata('message', 'We\'ve sent you a reset link <br>
                    Check your inbox for the link!');
                    redirect('login');

                }
                else {

                    $this->session->set_flashdata('error', 'I don\'t know why or how you triggered it <br>
                    But yea report this problem thx!');
                    redirect('login');

                }
            }
            else {

                $this->session->set_flashdata('error', 'The email doesn\'t exist');
                redirect('login');

            }
        }
        else {

            $this->index();

        }

    }

    //Validate the reset password link 
    public function validate() {

        if($this->uri->segment(3) == $this->session->tempdata('code')) {
            
            $this->load->view('reset');

        }
        else {

            $this->session->set_flashdata('error', 'The link has expired, please request again!');
            redirect('login');

        }

    }

    //Check password strength 
    public function password_check($str) {
        
        if (preg_match('#[0-9]#', $str) && preg_match('#[a-z]#', $str) && preg_match('#[A-Z]#', $str) && preg_match('#[\W]#', $str)) {
            return TRUE;

        }

        return FALSE;

    }

    //Reset password
    public function reset() {

        $this->form_validation->set_rules('password', 'Password', 'required|callback_password_check', 
                                            array('password_check' => 'Must contain a number, uppercase, lowercase & symbol.'));
        $this->form_validation->set_rules('rpassword', 'RePassword', 'required',
                                            array('required'    => 'This field is required.'));   
        
        if ($this->form_validation->run()) {

            $password   = $this->input->post('password');
            $rpassword  = $this->input->post('rpassword');
            
            if ($password === $rpassword){

                $hashed_password = password_hash($password,PASSWORD_BCRYPT);
                $data = array(
                    'password'  =>  $hashed_password
                );
                $this->register_model->reset($data);
                $this->session->set_flashdata('message', 'Password successfully changed');
                redirect('login');

            }
            else {

                $this->session->set_flashdata('error', 'The passwords does not match');
                $this->load->view('reset');

            }
        }
        else {

            $this->load->view('reset');

        }

    }

}
?>
