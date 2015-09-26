<?php
class Users_model extends CI_Model {


    public function __construct()
    {
        $this->load->database();
    }

    public function get_user()
    {
        $username = $this->input->post('inputEmail');
        $query = $this->db->get_where('fo_users', 
          array('username' => $username));
        return $query->row_array();
    }

    public function set_user()
    {
        //use the PHP password_hash function to has and salt a password
        $hashedPwd = password_hash($this->input->post('inputPassword'), PASSWORD_DEFAULT);
        //create array of data to put in the db
        $data = array(
            'username' => $this->input->post('inputEmail'),
            'password' => $hashedPwd,
            'name' => $this->input->post('inputName')
        );
        //insert the data into the db
        return $this->db->insert('fo_users', $data);
    }

}
?>
