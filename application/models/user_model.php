<?php

class User_model extends CI_Model  {
	function get($username){
		$query = $this->db->get_where('user',array('login'=>$username));
		if ($query && $query->num_rows() > 0)
			return $query->row(0,'User');
		else
			return null;

	}
	function insert($user){
		$this->db->insert('user',$user);
	}
}
?>