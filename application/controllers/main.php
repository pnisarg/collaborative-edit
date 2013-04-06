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
		echo $_SESSION['data'];

	}
	function getData(){
		
		echo json_encode(array('data'=> $_SESSION['data']));
	}
}

