<?php 
class Video_model extends CI_Model{
    
    //fetch all video from db
    function get_all_vid(){

        $all_vid = $this->db->get('video');
        return $all_vid->result();

    }

    //save video data to db
    function store_video($data){

        $this->db->insert('video', $data);
        
    }

    //Search Video
    function search_vid($keyword) {

        $this->db->like('title',$keyword);
        $vid_res  =   $this->db->get('video');
        return $vid_res->result();

    }
    
}