<?php
class Tasks extends CI_Controller {

    //string for use with base_url function to set links on page
    //todo: setup array so that linkName, addToBaseUrl are performed with foreach loop
    private static $linksLoggedIn = array( 'logoutLink' => "index.php/users/logout" );

    //Constructor
    public function __construct()
    {
        parent::__construct();
        $this->load->model('tasks_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
    }

    //Main page for logged in users
    public function index()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        //The php that checks the login, and will re-route to home() if not logged in
        $this->load->view('shared/checkLogin');
        //data to pass to views
        $head['title'] = 'Tasks Page';
        $data['tasks'] = $this->tasks_model->get_tasks();
        $data['links'] = Tasks::$linksLoggedIn;

        //To validate the form
        $this->form_validation->set_rules('inputDescription', 'description', 'required');

        //for first time run or failed addition
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('shared/header', $head);
            $this->load->view('tasks/index', $data);
            $this->load->view('shared/footer');
        }
        else
        {
            //all form fields pass validation, route to add task
            redirect('/tasks/addTask');
        }
    }

    public function addTask() {
        $this->load->view('shared/checkLogin');

        if($this->tasks_model->add_task()){
            echo "task successfully added";
            redirect('/tasks');
        } else {
            //todo: display message, form validation?
            //todo: will this work in form validation function?
            //if not just display message and give link back
            echo "add task failed";
        }
    }
}
