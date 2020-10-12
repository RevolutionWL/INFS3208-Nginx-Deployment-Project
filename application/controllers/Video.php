<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Video extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('video_model');
        $this->load->model('comment_model');
        $this->load->helper('download');
        $this->load->helper('file');
        
    }

    //Play video
    public function play() {

        $id = $this->uri->segment(3);
        $this->db->where('vid_id',$id);
        $vid = $this->db->get('video')->row_array();

        $this->session->set_userdata($vid);

        if (file_exists("./uploads/".$_SESSION['video'])) {

            $comment['all_comment'] = $this->comment_model->get_all_comments($_SESSION['vid_id']); 
            $this->load->view('video', $comment);

        }
        else {

            $this->load->view('novideo');

        }

    }  
    
    //Download Video
    public function download() {

        $content = file_get_contents('./uploads/'.$_SESSION['video']);
        force_download($_SESSION['title'].$_SESSION['type'], $content);

    }

    //Post Comment
    public function post() {

        if(isset($_SESSION['id'])) {
            $username = $_SESSION['name'];
        }
        else {
            $username = $this->input->ip_address();
        }


        $data = array(
            'vid_id'    =>  $_SESSION['vid_id'],
            'user'      =>  $username,
            'content'   =>  $this->input->post('comment'));

        $this->comment_model->comment($data);
        redirect('video/play/'.$_SESSION['vid_id']);
    }
}
