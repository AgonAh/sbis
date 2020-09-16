<?php
	class Staff extends CI_Controller{

		public function getmd5($s){
			echo md5($s);
	}

		public function getProfessors($pattern=''){
			$user = $this->session->userdata();
			if(!isset($user['role_id'])){
				$this->session->set_flashdata('failed','Not logged in as staff!');
				redirect('staff/login');
				return 0;
			}

			$professors= $this->Staff_model->getProfessors($pattern);
			$data['items']=$professors;

			$this->load->view('staff/getOptions',$data);
		}

		public function getSubjects($pattern=''){
			$user = $this->session->userdata();
			if(!isset($user['role_id'])){
				$this->session->set_flashdata('failed','Not logged in as staff!');
				redirect('staff/login');
				return 0;
			}

			$subjects= $this->Staff_model->getSubjects($pattern);
			$data['items']=$subjects;

			$this->load->view('staff/getOptions',$data);
		}

		public function login(){
			if($this->input->post()){
				$user = $this->Staff_model->login();
				if($user!=null){
					$this->session->set_userdata($user);
					$this->session->set_userdata(array('type'=>staff));
					$this->session->unset_userdata('password');
					$this->session->set_flashdata('success','Logged in!');
					if($user['role_id']==1){
//						$this->session->set_userdata(array('type'=>'manager'));
						redirect('manager/index');
					}
					else if($user['role_id']==2){
//						$this->session->set_userdata(array('type'=>'professor'));
						redirect('professor/index');
					}
				}
				else{
					$this->session->set_flashdata('failed','Couldn`t log in');
					redirect('staff/login');
				}
			}
			$data['title']='Log in';
			$this->load->view('template/header');
			$this->load->view('staff/login', $data);
			$this->load->view('template/footer');
		}

		public function logout(){
			session_destroy();
			$this->session->set_flashdata('success','User logged out');
			redirect('staff/login');
		}

	}
