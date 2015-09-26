<?php
class Users extends CI_Controller {

    //Links for the main pages when a user has not logged in
    private static $linksLoggedOff = array( 'homeLink' => "index.php/users",
                                    'registerLink' => "index.php/users/register",
                                    'loginLink' => "index.php/users/login"
        );

    //Landing page for user
    private static $landingPage = '/tasks';

    //Constructor
    public function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
    }

    //Main page for logged in users
    //todo: combine index and home functions? home does not re-route to tasks if use logged in
    public function index()
    {
        //if the session is set, then route to landing page
        //o.w. display "home page"
        if(isset($_SESSION['user_id'])) {
            redirect(Users::$landingPage);
        } else {
            $head['title'] = "Home";
            $this->load->view('shared/header', $head);
            $this->load->view('users/home', Users::$linksLoggedOff);
            $this->load->view('shared/footer');
        }
    }

    //registration page
    public function register()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        //email must exist and be unique within the db
        //password is required, password again must match password
        $this->form_validation->set_rules('inputEmail', 'email', 'required|is_unique[fo_users.username]');
        $this->form_validation->set_rules('inputPassword', 'password', 'required');
        $this->form_validation->set_rules('inputPasswordAgain', 'password', 'required|matches[inputPassword]');

        if ($this->form_validation->run() === FALSE)
        {
            $head['title'] = "Registration";
            $this->load->view('shared/header', $head);
            $this->load->view('users/register', Users::$linksLoggedOff);
            $this->load->view('shared/footer');
        }
        else
        {
            //add user information to database
            $this->users_model->set_user();
            //checking affected rows to validate success of registration
            if($this->db->affected_rows())
            {
                //set session for user
                //todo: not setting session id?, redirect to login?, display success msg?
                //todo: or just get id after setting?
                //$_SESSION['email'] = $this->input->post('inputEmail');
                //redirect user to main page
                redirect('/users/login');
            }
            else
            {
                //Registration failure (a validation step is not handled properly)
                //todo: create a view to notify user something went wrong and they need to
                //contact the site for someone to look into it, offer links back to reg, page
                redirect('/users');
            }
        }
    }

    public function login()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        //Both entries are required, user defined callback to verify username and password
        $this->form_validation->set_rules('inputEmail', 'email', 'required');
        $this->form_validation->set_rules('inputPassword', 'password', 'required|callback_user_pwd_verify');

        if ($this->form_validation->run() === FALSE)
        {
            $head['title'] = "Login";
            $this->load->view('shared/header', $head);
            $this->load->view('users/login', Users::$linksLoggedOff);
            $this->load->view('shared/footer');
        }
        else
        {
            //Login success redirect to main page
            redirect(Users::$landingPage);
        }
    }

    public function logout()
    {
        //destroy the session and redirect to main page
        session_destroy();
        redirect('/users');
    }

    public function user_pwd_verify()
    {
        $user = NULL;
        $inputPassword = $this->input->post('inputPassword');

        if($user = $this->users_model->get_user())
        {
            if(password_verify($inputPassword, $user['password']))
            {
                //Set session variables
                //todo: convert to token system for API implementation (avoid storing user data)
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['email'] = $user['email'];
                return TRUE;
            }
            else
            {
                $this->form_validation->set_message('user_pwd_verify', 'The user or password was incorrect');
                return FALSE;
            }
        }
        else
        {
            $this->form_validation->set_message('user_pwd_verify', 'The user or password was incorrect');
            return FALSE;
        }
    }
}
