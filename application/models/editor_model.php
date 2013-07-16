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
	function addCollaborator($sessionId, $user){
		$sql1 = "INSERT INTO `collaedit`.`session` (`sessionId`, `loginId`, `time_stamp`,`status`) VALUES ('$sessionId','$user',null
			,'online');";
		$this->db->query($sql1);
	}
	function getCollaborators($sessionId){
		$sql = " SELECT loginId,status FROM `session` WHERE sessionId = ? ;";
		$query = $this->db->query($sql,array($sessionId));
		$temp = " ";
		foreach ($query->result() as $row)
			{
				if($row->status != "offline"){
					 $temp =$temp.$row->loginId.", ";
				}
			   
			}
		return $temp;
	}
	function logout($sessionId,$user){
		$sql1 = "UPDATE `session` SET `status`= 'offline' WHERE sessionId = '$sessionId' and loginId = '$user'; ";
		$query= $this->db->query($sql1);
		return $query;
	}
	function initChat($sessionId){
		$sql = "INSERT INTO `chat`(`sessionId`, `chat_text`) VALUES ('$sessionId','')";
		$query = $this->db->query($sql);

	}
	function postMsg($sessionId, $msg){
		$sql = "UPDATE `chat` SET `chat_text`= '$msg' WHERE sessionId= ?; ";
		$query = $this->db->query($sql,array($sessionId));
	}
	function getMsg($sessionId){
		$sql = "SELECT `chat_text` FROM `chat` WHERE sessionId = ?";
		$query = $this->db->query($sql,array($sessionId));
		if($query){
			$data = $query->row();
			return $data->chat_text;
		}
	}

		
}

?>