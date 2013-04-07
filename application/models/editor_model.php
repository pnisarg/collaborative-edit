<?php

class Editor_model extends CI_Model{
	function initialise($sessionId){
		$sql = "INSERT INTO `collaedit`.`editorTable` (`id`, `session_id`, `text`) VALUES (NULL, '$sessionId' , 'Welcome To Collaborative Editor');";
		$query = $this->db->query($sql);
	}
	
	function updateData($data , $sessionId){
		$sql = "UPDATE editorTable SET text='$data' WHERE session_id = ? ;  ";
		$query = $this->db->query($sql,array($sessionId));
	}

	function getData($sessionId){
		$sql = "select text from editorTable where session_id = ?";
		$query = $this->db->query($sql,array($sessionId));
		if($query){
			$data = $query->row();
			return $data->text;
		}
		return null;
	}
}

?>