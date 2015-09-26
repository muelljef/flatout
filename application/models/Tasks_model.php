<?php
class Tasks_model extends CI_Model {

    private static $tasks = 'fo_tasks';

    public function __construct()
    {
        $this->load->database();
    }

    public function add_task()
    {
        $inputDesc = $this->input->post('inputDescription');
        $data = array('description' => $inputDesc, 'user_id' => $_SESSION['user_id']);
        return $this->db->insert('fo_tasks', $data);
    }

    public function get_tasks()
    {
        //SQL set with ? for bindings
        $sql = 'SELECT description, status FROM fo_tasks WHERE user_id = ?';
        //run the query, with id as the parameter
        $query = $this->db->query($sql, $_SESSION['user_id']);
        //return the result
        return $query->result();
    }
}
?>
