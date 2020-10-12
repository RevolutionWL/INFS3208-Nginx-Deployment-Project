<?php 
class Comment_model extends CI_Model{
    
    //save comment in database
    function comment($data){

        $this->db->insert('comment', $data);

    }

    //retrieve comment for video
    function get_all_comments($id){

        $this->db->where('vid_id', $id);
        $all_com = $this->db->get('comment');
        return $all_com->result();
        
    }
    
}