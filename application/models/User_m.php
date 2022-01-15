<?php
Class User_m extends CI_Model
{
 	function cek_user($username)
 	{
 		$this->db->select('username');
 		$this->db->from('users');
 		$this->db->where('username', $username);
 		$this->db->limit(1);
 		$query = $this->db->get();
 		
 		if($query->num_rows() == 1) {
 			return true;
 		} else {
 			return false;
 		}
 	}
	
	function login($username, $password)
 	{
		$this->db->select('id, username, password');
   		$this->db->from('users');
   		$this->db->where('username', $username);
   		$this->db->where('password', MD5($password));
   		$this->db->limit(1);
   		$query = $this->db->get();

   		if($query->num_rows() == 1) {
     		return $query->result();
		} else {
		     return false;
		}
 	}
}
?>
