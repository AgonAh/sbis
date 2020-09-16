<?php
 	class Staff_model extends CI_Model{
 		public function __construct()
		{
			$this->load->database();
		}

		public function addSubject(){
 			$this->ifManager();
 			$post = $this->input->post();
 			$data=array(
 				'name'=>$post['name'],
				'ects'=>$post['ects'],
				'branch_id'=>$post['branch_id'],
				'generation_id'=>$post['generation_id']
			);
 			return $this->db->insert('subject',$data);
		}

		public function addStaff(){

			$this->ifManager();
			$data = array(
				'name'=>$this->input->post('name'),
				'username' => $this->input->post('username'),
				'password'=>md5($this->input->post('password')),
				'role_id'=>$this->input->post('role_id')
			);
			$role_id = $this->input->post('role_id');
			$inserted = $this->db->insert('staff',$data);
			$staff_id = $this->db->insert_id();
			$data = array(
				'staff_id'=>$staff_id
			);
			if($inserted){
				if($role_id==1){
					//manager
					$inserted = $this->db->insert('manager',$data);
				}
				else if($role_id==2){
					//professor
					$inserted = $this->db->insert('professor',$data);
				}
				if(!$inserted) {
					$this->db->where('id',$staff_id);
					$this->db->delete('staff');
				}
			}

			if($inserted){
				return ($this->db->get_where('staff',array('id'=>$staff_id)))->row_array();
			}

		}

		public function login(){
			$username=$this->input->post('username');
			$password=md5($this->input->post('password'));
			$this->db->select('*, staff.id as id, professor.id as professor_id, manager.id as manager_id');
			$this->db->join('professor','staff.id = professor.staff_id','left');
			$this->db->join('manager','staff.id = manager.staff_id','left');
			$query = $this->db->get_where('staff',array('username'=>$username,'password'=>$password));
			$user = $query->row_array();
			if($user['password']==$password){
				return $user;
			}
			return null;
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

		public function getRoles(){
 			return($this->db->get('roles'))->result_array();
		}

		public function addStudent(){
				$password = md5($this->input->post('password'));
				$data = array(
					'name'=> $this->input->post('name'),
					'username'=>$this->input->post('username'),
					'password'=>$password,
					'generation_id'=>$this->Student_model->latestGeneration(),
					'branch_id'=>$this->input->post('branch_id')
				);
				if($this->db->insert('student',$data)){
					$insert_id = $this->db->insert_id();
					return ($this->db->get_where('student',array('id'=>$insert_id)))->row_array();
				}
				else{
					return flase;
				}

			}

			public function getProfessorSubjectList($id){
				$this->ifManager();

				$this->db->select('professor_id, staff.name as staff_name, subject.name as subject_name, staff.username');
				$this->db->join('staff','staff.id = professor.staff_id');
				$this->db->join('professor_subject','professor.id = professor_subject.professor_id');
				$this->db->join('subject','subject.id = professor_subject.subject_id');
				$get = $this->db->get_where('professor',array('professor.id'=>$id));
				return $get->result_array();
			}

			public function getProfessorSubjectById($id,$professor_id){
 				return ($this->db->get_where('professor_subject',array('id'=>$id,'professor_id'=>$professor_id)))->row_array();
			}

			public function storePsa($id,$title,$body){
 			$data = array(
 				'professor_subject_id'=>$id,
				'title'=>$title,
				'body'=>$body
			);
 				return $this->db->insert('psa',$data);
			}


			public function getSubjectProfessorList($id){
				//Delete these 2 arrays
				$this->db->select('subject.name as subject_name,staff.name as staff_name, staff.username, professor.id as professor_id');
				$this->db->join('professor_subject','subject.id = professor_subject.subject_id');
				$this->db->join('professor','professor.id = professor_subject.professor_id');
				$this->db->join('staff','staff.id = professor.staff_id');
				$get = $this->db->get_where('subject',array('subject.id'=>$id));
				return $get->result_array();
			}



		public function bindProfessorSubject($professor_id,$subject_id){
 			$this->ifManager();

			$data = array(
				'professor_id'=>$professor_id,
				'subject_id'=>$subject_id
			);
			$exists = ($this->db->get_where('professor_subject',$data))->row_array();
			if(!empty($exists)){
				return false;
			}

			return $this->db->insert('professor_subject',$data);
		}


		public function getProfessors($pattern){
 			$this->db->select('staff_id,name,role_id,professor.id as id');
			$this->db->like('name',$pattern);
			$this->db->where('role_id',2);
			$this->db->join('professor','staff.id = professor.staff_id');
			return ($this->db->get('staff'))->result_array();
		}
		public function getSubjects($pattern){
 			$this->db->select('*');
			$this->db->like('name',$pattern);
			return ($this->db->get('subject'))->result_array();
		}

		public function getSubjectsDetailed(){
			$this->db->select('subject.name as subject_name, branches.name as branch_name, generations.name as generation_name, ects');
			$this->db->join('branches','branch_id=branches.id');
			$this->db->join('generations','generation_id=generations.id');
			return ($this->db->get('subject'))->result_array();
		}

		public function getProfessorSubject($professor_id,$subject_id){
 			$ps = $this->db->get_where('professor_subject',array(
 				'professor_id'=>$professor_id,
				'subject_id'=>$subject_id
			));
 			$ps = $ps->row_array();
			$students = $this->db->get_where('student_subject',array('professor_subject_id'=>$ps['id']));
			$students=$students->result_array();
			return $students;
		}

		public function storeGrade(){
 			$post = $this->input->post();
 			$data = array(
 				'grade'=>$post['grade']
			);
			$this->db->where('id',$post['table_id']);
			$this->db->update('student_subject',$data);
		}




		public function getProfessorSubjects(){
 			$this->ifProfessor();
 			$professor_id = $this->session->userdata('professor_id');
			$this->db->join('subject','subject.id = subject_id');
			return($this->db->get_where('professor_subject',array('professor_id'=>$professor_id)))->result_array();
		}

		public function getStaffByUsername($username){
			return ($this->db->get_where('staff',array('username'=>$username)))->row_array();
		}

		public function getStaffLike($pattern){
			$this->db->select('id,name,username,role_id');
			$this->db->like('name',$pattern);
			return ($this->db->get('staff'))->result_array();
		}

		public function initialise(){
 			$exists = $this->getStaffByUsername('admin');
 			if(!empty($exists)){
 				return false;
			}
			$this->db->insert('roles',array('id'=>1,'name'=>'manager'));
			$this->db->insert('roles',array('id'=>2,'name'=>'professor'));
			$password = md5(rand());
 			$data = array(
 				'name'=>'admin',
 				'username'=>'admin',
				'password'=>md5($password),
				'role_id'=>1
			);
 			$this->db->insert('staff',$data);
 			$staff_id = $this->db->insert_id();
 			$this->db->insert('manager',array('staff_id'=>$staff_id));

 			$data['password'] = $password;
			return $data;
		}

		public function addMisc($table,$data){
 			$exists = ($this->db->get_where($table,$data))->row_array();
 			if(empty($exists)){
				return($this->db->insert($table,$data));
			}
 			return false;
		}




		public function ifProfessor(){
			if(!($this->session->userdata('role_id')&&$this->session->userdata('role_id')==2)){
				$this->session->set_flashdata('failed','Not logged in as professor');
				redirect('staff/login');
				return 0;
			}
		}

		public function ifManager(){
			if(!($this->session->userdata('role_id')&&$this->session->userdata('role_id')==1)){
				$this->session->set_flashdata('failed','Not logged in as manager');
				redirect('staff/login');
				return 0;
			}
		}

	}
