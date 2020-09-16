<?php
	class Professor extends CI_Controller{

		public function index(){
			$this->ifProfessor();
			$user = $this->session->userdata();
			$data['subjects']=$this->Staff_model->getProfessorSubjects();
			$this->load->view('template/header');
			$this->load->view('professor/index',$data);
			$this->load->view('template/footer');
		}

		public function subject($subject_id){
			$this->ifProfessor();
			$professor = $this->session->userdata();
			$data['students'] = $this->Staff_model->getProfessorSubject($professor['professor_id'],$subject_id);
			$this->load->view('template/header');
			$this->load->view('professor/subject',$data);
			$this->load->view('template/footer');
		}

		public function store(){
			$this->ifProfessor();
			$this->Staff_model->storeGrade();
		}

		public function psa($id){
			$this->ifProfessor();
			$professor_id = $this->session->userdata('professor_id');
			$professor_subject = $this->Staff_model->getProfessorSubjectById($id,$professor_id);
			if(empty($professor_subject)){
				$this->session->set_flashdata('failed','You dont have access to that subject');
				redirect('/');
			}
			if($this->input->post()){
				$title = $this->input->post('title');
				$body = $this->input->post('body');
				if($this->Staff_model->storePsa($id,$title,$body)){
					$this->session->set_flashdata('success','PSA sent');
					redirect('/professor');
				}
				else{
					$this->session->set_flashdata('failed','Couldn\'t send PSA');
				}
			}

			$data['professor_subject_id']=$id;
			$this->load->view('template/header');
			$this->load->view('professor/psa',$data);
			$this->load->view('template/footer');
		}

		public function ifProfessor(){
			if(!($this->session->userdata('role_id')&&$this->session->userdata('role_id')==2)){
				$this->session->set_flashdata('failed','Not logged in as professor');
				redirect('staff/login');
			}
		}






	}
