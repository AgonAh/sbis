<?php
class Professor_model extends CI_Model{
	public function __construct(){
		$this->load->database();
	}

	public function signup(){
		$password = md5($this->input->post('password'));
		$data = array(
			'name'=> $this->input->post('name'),
			'username'=>$this->input->post('username'),
			'password'=>$password
		);
		if($this->db->insert('professor',$data)){
			$this->session->set_flashdata(array('success'=>'User '.$data['username'].' was added successfully!'));
		}
		else{
			$this->session->set_flashdata(array('failed'=>'User could not be added'));
		}
	}

	public function login(){
		$username=$this->input->post('username');
		$password=md5($this->input->post('password'));
		$query = $this->db->get_where('professor',array('username'=>$username,'password'=>$password));
		$user = $query->row_array();
		if($user['password']==$password){
			return $user;
		}
		return null;
	}
}
