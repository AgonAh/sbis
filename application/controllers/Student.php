<?php
	class Student extends CI_Controller{


		public function index(){
			if(!$this->session->userdata('id')){
				return redirect('/student/login');
			}
			$data['title']="Home";
			$this->load->view('template/header');
			$this->load->view('student/index',$data);
			$this->load->view('template/footer');
		}

		public function profile(){
			$this->load->view('template/header');
			$this->load->view('student/profile');
			$this->load->view('template/footer');
		}

		public function grades(){
			if(!$this->session->userdata('id')){
				return redirect('/student/login');
			}
			$student=$this->session->userdata();
			$data['grades'] = $this->Student_model->getGrades($student['id']);
			$data['title'] = 'View grades';

			$this->load->view('template/header');
			$this->load->view('student/grades',$data);
			$this->load->view('template/footer');
		}

		public function enroll($subject_id=null){
			if(!$this->session->userdata('generation_id')){
				redirect('/student/login');
				return 0;
			}
			$student=$this->session->userdata();
			if($subject_id!=null) {
				$student_id=$student['id'];
				$professor_subject_id = $this->input->post('professor_subject_id');
				$this->Student_model->enroll($student_id,$subject_id,$professor_subject_id);
			}
			$data['registeredSubjects'] = $this->Student_model->getRegisteredSubjectList($student);
			$data['unenrolledSubjects'] = $this->Student_model->getUnenrolledSubjectList($student);
			$data['unregisteredSubjects'] = $this->Student_model->getUnregisteredSubjectList();
			$this->load->view('template/header');
			$this->load->view('student/enroll', $data);
			$this->load->view('template/footer');
		}

		public function reroll($student_subject_id){
			if($this->Student_model->reroll($student_subject_id)){
				$this->session->set_flashdata('success','Successfully enrolled');
			}
			else{
				$this->session->set_flashdata('failed','Couldnt enroll');				
			}
			redirect('student/enroll');
		}

		public function unenroll($id){
			if(!$this->session->userdata('id')){
				redirect('/student/login');
				return;
			}

			$student=$this->session->userdata();
			if($this->Student_model->unenroll($student['id'],$id)){
				$this->session->set_flashdata('success','Successfully unenrolled');
			}
			else{
				$this->session->set_flashdata('failed','Couldnt unenroll');
			}
			redirect('student/enroll');
		}

		public function psa(){
			if(!$this->session->userdata('id')){
				redirect('/student/login');
				return;
			}
			$id = $this->session->userdata('id');
			$data['psaList']=$this->Student_model->getPSA($id);

			$this->load->view('template/header');
			$this->load->view('student/psa', $data);
			$this->load->view('template/footer');
		}

		public function viewPSA($id){
			$data['psa'] = $this->Student_model->getPSAById($id);
			$this->load->view('template/header');
			$this->load->view('student/viewPSA', $data);
			$this->load->view('template/footer');
		}


		public function ver(){
			echo phpinfo();
		}

		public function login() {
			if($this->input->post()){
				$user = $this->Student_model->login();
				if($user!=null){
					$this->session->set_userdata($user);
					$this->session->unset_userdata('password');
					$this->session->set_userdata(array('type'=>'student'));
					$this->session->set_flashdata('success','Logged in!');
					return redirect('student/index');
				}
				else{
					$this->session->set_flashdata('failed','Couldnt log in');
					return redirect('student/login');
				}

			}
			$data['title']='Log in';
			$this->load->view('template/header');
			$this->load->view('student/login', $data);
			$this->load->view('template/footer');
		}

		public function logout(){
			session_destroy();
			$this->session->set_flashdata('success','User logged out');
			return redirect('student/index');
		}


	}
?>
