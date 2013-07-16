<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
	
	
	function __construct(){
		parent::__construct();
		session_start();
		
	}
	 public function _remap($method, $params = array()) {
	    	// enforce access control to protected functions	
    		
    		if (!isset($_SESSION['user']))
   			redirect('index.php/welcome/index', 'refresh'); //Then we redirect to the index page again
 	    	
	    	return call_user_func_array(array($this, $method), $params);
    }

	function updateData(){
		$temp = $this->input->post('json');
		$jsonobj = json_decode($temp);
		$_SESSION['data'] = $jsonobj->dataX;
		$this->load->model('editor_model');
		$this->editor_model->updateData($jsonobj->dataX, $_SESSION['id']);

	}
	function getData(){
		
		$this->load->model('editor_model');
		$row = $this->editor_model->getData($_SESSION['id']);
		$data = $row;
		echo json_encode(array('data'=> $data));
	}
	function getCollaborators(){
		$this->load->model('editor_model');
		$data = $this->editor_model->getCollaborators($_SESSION['id']);
		echo json_encode(array('data'=> $data));

	}
	function getMsg(){
		$this->load->model('editor_model');
		$result = $this->editor_model->getMsg($_SESSION['id']);
		echo json_encode(array('data'=> $result));
		
	}
	function postMsg(){
		$this->load->model('editor_model');
		$msg = $this->input->post('json');
		$jsonobj = json_decode($msg);
		$msg = $jsonobj->message;
		$this->editor_model->postMsg($_SESSION['id'], $msg);
		
	}

}

