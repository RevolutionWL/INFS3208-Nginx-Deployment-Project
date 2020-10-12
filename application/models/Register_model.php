<?php 
class Register_model extends CI_Model {

    //Register function inserting data - Register.php
    function insert($data) {

        $this->db->insert('register', $data);
        return $this->db->insert_id();
    }

    //Check if email is verified function - Register.php
    function verifies($key){

        $this->db->where('verification_key', $key);
        $this->db->where('verified', 'no');
        $query = $this->db->get('register');

        if($query->num_rows() > 0) {

            $data = array(
                'verified'  =>   'yes'
            );
            $this->db->where('verification_key', $key);
            $this->db->update('register', $data);
            return true;

        }
        else {

            return false;

        }

    }

    //Update profile data - Profile.php
    function update($data) {

        $this->db->where('id', $_SESSION['id']);
        $this->db->update('register', $data);

        //Refresh userdata after update
        $this->db->where('id', $_SESSION['id']);
        $data = $this->db->get('register')->row_array();
        $this->session->set_userdata($data);


    }

    //Check if Email exist in database - Forgot.php
    function checkemail($data) {

        $this->db->where('email', $data);
        $query = $this->db->get('register');

        if($query->num_rows() > 0) {

            return true;
        }
        else {
            return false;
        }
    }

    //Update/Reset user password - Forgot.php
    function reset($data) {

        $this->db->where('email', $_SESSION['email']);
        $this->db->update('register', $data);

    }

}