<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('register_model');


    }

    public function index() {


        if(isset($_SESSION['id'])) {
            
            $this->load->view('profile');
            
        }
        else {

            redirect('home');

        }

    }

    //Save profile
    public function save() {

        $this->form_validation->set_rules('firstname', 'firstname', 'required');
        $this->form_validation->set_rules('contact', 'contact', 'numeric');

        if ($this->form_validation->run()) {
            $data = array (
                'firstname' => $this->input->post('firstname'),
                'lastname'  => $this->input->post('lastname'),
                'contact'   => $this->input->post('contact'),
                'profile'   => 'yes'
            );

            $this->register_model->update($data);
            $this->session->set_flashdata('success', 'Sucessfully updated profile!');
            redirect('profile');
        }
        else {

            $this->index();

        }

    }
}
?>