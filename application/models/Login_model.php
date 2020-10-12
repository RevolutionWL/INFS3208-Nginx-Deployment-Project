<?php 
class Login_model extends CI_Model {

    function validate_user($email, $password) {

        $this->db->where('email', $email);
        $query = $this->db->get('register');

        if($query->num_rows() > 0) {

            foreach($query->result() as $row) {

                if($row->verified == 'yes') {
                    
                    if(password_verify($password, $row->password)) {

                        $this->db->where('email', $email);
                        $data = $this->db->get('register')->row_array();
                        $this->session->set_userdata($data);

                    }
                    else {

                        return 'Wrong password!';

                    }

                }
                else {

                    return "Woopsy Daisy! the email is not verified yet <br> 
                            WILL YA VERIFY THAT GODDAMN EMAIL YA HALF-WIT";

                }

            }

        }
        else {

            return 'Email Address Doesn\'t Exist';

        }
    }
}
?>