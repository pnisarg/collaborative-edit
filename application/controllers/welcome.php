<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct(){
		parent::__construct();
		session_start();
	}

	
	public function index()
	{
		$this->load->view('view_welcome');
	}
	function choice(){
		$this->load->view('view_choice');
	}
	function Join(){
		if(!isset($_SESSION['id'])){
			$join = $this->input->post('sessionString');
			$_SESSION['id'] = $join;
			$data['id'] = $join;
			$this->load->model('editor_model');
			$this->editor_model->addCollaborator($join,$_SESSION['user']->first);
			$this->load->view('view_main',$data);
		}
		else{
			$data['id'] = $_SESSION['id'];
			$this->load->view('view_main',$data);

		}
		

	}


	function createNew(){
		//this function creates random string of length 5 which will be used as url.
		if(!isset($_SESSION['id'])){
			 $validCharacters = "abcdefghijklmnopqrstuxyvwzABCDEFGHIJKLMNOPQRSTUXYVWZ0";
			 $validCharNumber = strlen($validCharacters)-1;
			 $randString = "";
			 for($i = 0; $i < 5 ; $i++){
			 	$index = mt_rand(0,$validCharNumber);
			 	$randString .= $validCharacters[$index];
			 	
			 }
			 $_SESSION['id'] = $randString;
			 $data['id'] = $randString;
			 $this->load->model('editor_model');
			 $this->editor_model->initialise($randString);
			 $this->editor_model->addCollaborator($randString,$_SESSION['user']->first);
			 $this->editor_model->initChat($randString);
			 $this->load->view('view_main',$data);
		}else{
			$data['id'] = $_SESSION['id'];
			$this->load->view('view_main',$data);
		}
		
		
	}
	function login(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required');

		if($this->form_validation->run() == FALSE){
			$this->load->view(view_welcome);
		}
		else{
			$login = $this->input->post('username');
    		$clearPassword = $this->input->post('password');
    		$this->load->model('user_model');
    		$user = $this->user_model->get($login);
    			if (isset($user) && $user->comparePassword($clearPassword)) {
    				$_SESSION['user'] = $user;
    				//$this->load->view('view_main');
    				$this->choice();
    			}
	 			else {   			
					$data['errorMsg']='Incorrect username or password!';
					$data['signUpError'] = false;
	 				$this->load->view('view_welcome',$data);
	 			}

		}

	}


	function logout(){
		$this->load->model('editor_model');
		if(isset($_SESSION['id'])){
			$query = $this->editor_model->logout( $_SESSION['id'],$_SESSION['user']->first);
		}
		
		session_destroy();
    	redirect('index.php/welcome/index', 'refresh'); //Then we redirect to the index page again
	}

	function createNewUser(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[user.login]');
    	$this->form_validation->set_rules('password', 'Password', 'required');
    	$this->form_validation->set_rules('first', 'First', "required");
    	$this->form_validation->set_rules('last', 'last', "required");
    	$this->form_validation->set_rules('email', 'Email', "required|is_unique[user.email]");

    	if($this->form_validation->run() == FALSE){
    		$data['signUpError'] = true;
    		$this->load->view('view_welcome',$data);
    	}
    	else{
    		$user = new User();
    		$user->login = $this->input->post('username');
    		$user->first = $this->input->post('first');
    		$user->last = $this->input->post('last');
    		$clearPassword = $this->input->post('password');
    		$user->encryptPassword($clearPassword);
    		$user->email = $this->input->post('email');
    		$this->load->model('user_model');
    		$this->user_model->insert($user);
    		$_SESSION['user'] = $user;
    		//$this->load->view('view_main');
    		$this->choice();
		}
	    	
	}

	function sendEmail(){
	$data['id'] = $_SESSION['id'];
		$email = $this->input->post('email');

		$string = $this->input->post('string');
		
		$this->load->library('email');
	
		
		
		$this->email->from('patelnisargk@gmail.com', 'Session Email');
		$this->email->to($email);
		
		$this->email->subject('Collaborative Editor Joining Request');
		$this->email->message("You are requested to join Collaborative editor. Your joining String is $string");
		
		$result = $this->email->send();
		
		$this->load->view('view_main',$data);
	}

}
