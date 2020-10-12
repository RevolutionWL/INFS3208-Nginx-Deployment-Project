<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Upload extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('video_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if (isset($_SESSION['id'])) {

            if ($this->session->flashdata()) {

                $this->load->view('upload', $this->session->flashdata());
            }
            else {
                
                $this->load->view('upload', array('error' => ' '));
            }
        } else {

            redirect('home');
        }
    }


    public function do_upload()
    {

        $this->form_validation->set_rules('vid_title', 'Title', 'required|trim');
        $this->form_validation->set_rules('vid_desc', 'Description', 'required|trim');

        if ($this->form_validation->run()) {

            //file upload code 
            //set file upload settings 
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'flv|mp4|3gp|mov|avi|wmv';
            $config['max_size']             = '';
            $config['max_width']            = '';
            $config['max_height']           = '';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('video')) {

                $error = array(
                    'error' =>  $this->upload->display_errors(),
                    'title' =>  $this->input->post('vid_title'),
                    'desc'  =>  $this->input->post('vid_desc')
                );
                $this->session->set_flashdata($error);
                redirect('upload');
            } else {

                $upload_video = $this->upload->data();

                $data = array(
                    'title'         =>  $this->input->post('vid_title'),
                    'description'   =>  $this->input->post('vid_desc'),
                    'author'        =>  $_SESSION['name'],
                    'video'         =>  $upload_video['file_name'],
                    'type'          =>  $upload_video['file_ext']
                );

                //store vid data to the db
                $this->video_model->store_video($data);
                
                $success['success'] = $this->input->post('vid_title');
                $this->session->set_flashdata($success);
                redirect('home');
            }
        } else {

            $this->index();
        }
    }
}
