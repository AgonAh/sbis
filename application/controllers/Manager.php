<?php
	class Manager extends CI_Controller{

		public function index(){
			$this->load->view('template/header');
			$this->load->view('manager/index');
			$this->load->view('template/footer');
		}

		public function bindProfessorSubject(){
			$data['bindAdded'] = '';
			$this->ifManager();
			if($this->input->post()){
				$professor_id = $this->input->post('professor_id');
				$subject_id = $this->input->post('subject_id');
				if($this->Staff_model->bindProfessorSubject($professor_id,$subject_id)){
					$this->session->set_flashdata('success','Subject '.$subject_id.' was bound to professor '.$professor_id);
				}
				else{
					$this->session->set_flashdata('failed','Professor was not bound to subject');
				}
			}
			$data['professors'] = $this->Staff_model->getProfessors('');
			$data['subjects'] = $this->Staff_model->getSubjects('');
			$data['generations'] = $this->Student_model->getGenerations();
			$this->load->view('template/header');
			$this->load->view('manager/bindProfessorSubject',$data);
			$this->load->view('template/footer');
		}

		public function getStaffLike($pattern=""){
			$data['headings'] = array('Id','Name','Username','Type');
			$data['names']=array('id','name','username','type');
			$data['itemList'] = $this->Staff_model->getStaffLike($pattern);
			for($i = 0;$i<sizeof($data['itemList']);$i++){
				$data['itemList'][$i]['type'] = $data['itemList'][$i]['role_id'] == 1 ? 'Manager' : 'Professor';
			}

			$this->load->view('manager/table',$data);
		}

		public function addStudent(){
			$this->ifManager();
			if($this->input->post()){

				$this->form_validation->set_rules('name','Name','required');
				$this->form_validation->set_rules('password','Password','required');
				$this->form_validation->set_rules('username','Username','required');

				if($this->form_validation->run()){
					$student = $this->Staff_model->addStudent();
					if($student){
						$this->session->set_flashdata(array('success'=>'User '.$this->input->post('username').' was added successfully!'));
						$data['addedStudent']=$student;
						$data['addedStudent']['password']=$this->input->post('password');
					}
					else{
						$this->session->set_flashdata(array('failed'=>'User could not be added'));
					}
				}

			}
			$data['post'] = $this->input->post();
			$data['title']='Sign up';
			$data['branches']=$this->Student_model->getBranches();
			$this->load->view('template/header');
			$this->load->view('manager/addStudent', $data);
			$this->load->view('template/footer');
		}

		public function addSubject(){
			$this->ifManager();
			if($this->input->post()){
				$this->form_validation->set_rules('name','Name','required');
				$this->form_validation->set_rules('ects','Ects','required');

				if($this->form_validation->run()){
					if($this->Staff_model->addSubject()){
						$this->session->set_flashdata('success','Subject added');
					}
					else{
						$this->session->set_flashdata('failed','Subject couldn`t be added added');
					}
				}
			}

			$data['generations']=$this->Student_model->getGenerations();
			$data['branches']=$this->Student_model->getBranches();
			$data['subjects']=$this->Staff_model->getSubjectsDetailed();
			$this->load->view('template/header');
			$this->load->view('manager/addSubject', $data);
			$this->load->view('template/footer');
		}


		public function addStaff(){
			$this->ifManager();
			if($this->input->post()){
				$this->form_validation->set_rules('name','Name','required');
				$this->form_validation->set_rules('username','Username','required');
				$this->form_validation->set_rules('password','Password','required');
				if($this->form_validation->run()){
					$data['addedStaff'] = $this->Staff_model->addStaff();
						if($data['addedStaff']){
							$this->session->set_flashdata('success','User added');
							$data['addedStaff']['password']=$this->input->post('password');
						}
						else{
							$this->session->set_flashdata('failed','User couldn\'t be added');
						}
				}
			}
			$data['roles']=$this->Staff_model->getRoles();
			$this->load->view('template/header');
			$this->load->view('manager/addStaff',$data);
			$this->load->view('template/footer');
		}

		public function addMisc(){  //Post has name and type
			$this->ifManager();
			if($this->input->post()){
				$post = $this->input->post();
				$this->form_validation->set_rules('name','Name','required');
				if($this->form_validation->run()){
					$data = array(
						'name'=>$post['name']
					);

					if($post['type']=='branch'){			//Branch
						if(isset($post['name']))
							if($this->Staff_model->addMisc('branches',$data)){
								$this->session->set_flashdata('success','Branch added');
							}
							else{
								$this->session->set_flashdata('failed','Branch couldn`t be added');
							}
					}
					else if($post['type']=='generation'){	//Generation

						$pattern = "/\b[0-9]{4}\/[0-9]{4}\b/";
						if(isset($post['name'])) {
							if (preg_match($pattern, $post['name'])) {
								if ($this->Staff_model->addMisc('generations', $data)) {
									$this->session->set_flashdata('success', 'Generation added');
								}
								else {
									$this->session->set_flashdata('failed','Generation couldn\'t be added');
								}
							}
							else{
								$this->session->set_flashdata('failed','Generation pattern is year/year');
							}
						}

					}
				}

			} //End of post

			$data['branches']=$this->Student_model->getBranches();
			$data['generations']=$this->Student_model->getGenerations();
			$this->load->view('template/header');
			$this->load->view('manager/addMisc',$data);
			$this->load->view('template/footer');
		}

		public function professorTable($id){
			$data['headings'] = array('Id','Name','Username','Subject');
			$data['names'] = array('professor_id','staff_name','username','subject_name');
			$data['itemList'] = $this->Staff_model->getProfessorSubjectList($id);
			$this->load->view('manager/table',$data);
		}

		public function subjectTable($id){
			$data['headings'] = array('Subject','Professor name','Username','Professor id');
			$data['names'] = array('subject_name','staff_name','username','professor_id');
			$data['itemList'] = $this->Staff_model->getSubjectProfessorList($id);
			$this->load->view('manager/table',$data);
		}

		

		public function reg(){
//			if(preg_match("/[0-9]{4}/[0-9]{4}/",'2019/2020')){}
			$pattern = "/\b[0-9]{4}\/[0-9]{4}\b/";
			$text = "2017/2018";
			if(preg_match($pattern, $text)){
				echo "Match found!";
			} else{
				echo "Match not found.";
			}
		}

		public function initialise(){
			$staff = $this->Staff_model->getStaffByUsername('admin');
			if(empty($staff)){
				$data = $this->Staff_model->initialise();
			}
			else{
				$this->session->set_flashdata('failed','Database has already been initialised');
				redirect('/');
			}
			echo 'Username: '.$data['username'].'<br>';
			echo 'Password: '.$data['password'];
		}


		public function ifManager(){
			if(!($this->session->userdata('role_id')&&$this->session->userdata('role_id')==1)){
				$this->session->set_flashdata('failed','Not logged in as manager');
				redirect('staff/login');
				return 0;
			}
		}

	}
