<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('video_model');

    }

    public function index() {

        if($this->session->flashdata()){

            $info['video'] = $this->session->flashdata('success');

        }

        $info['vid_list'] = $this->video_model->get_all_vid();      
        $this->load->view('home', $info);

    }

    //Logout and destroy sessiondata
    public function logout() {

        $this->session->sess_destroy();    
        redirect('home');

    }

    //Search video
    public function search() {

        $keyword = $this->input->post('keyword');
        $info['vid_list'] = $this->video_model->search_vid($keyword);
        $info['search'] = true;
        $info['key'] = $keyword;
        $this->load->view('home',$info);

    }    

}
?>
