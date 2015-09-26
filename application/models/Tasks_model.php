<?php
class Tasks_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function add_task()
    {
        $inputDesc = $this->input->post('inputDescription');
        $data = array('description' => $inputDesc, 'user_id' => $_SESSION['id']);
        return $this->db->insert('tasks', $data);
    }

    public function get_tasks()
    {
        //SQL set with ? for bindings
        $sql = 'SELECT description, status FROM tasks WHERE user_id = ?';
        //run the query, with id as the parameter
        $query = $this->db->query($sql, $_SESSION['id']);
        //return the result
        return $query->result();
    }
}
?>
