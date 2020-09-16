<?php
	class Student_model extends CI_Model{
		public function __construct(){
		$this->load->database();
		}

		public function getGrades($id){
			$this->db->where('student_id',$id);
			$this->db->where('grade IS NOT NULL');
			$this->db->where('grade > 5');
			$this->db->join('subject','subject_id = subject.id');
			return ($this->db->get('student_subject'))->result_array();
		}


		public function getUnregisteredSubjectList(){
			$student=$this->session->userdata();
			$branch_id =  $student['branch_id'];
			$student_id = $student['id'];
			$this->db->where('branch_id',$branch_id);
			$this->db->where('generation_id',$student['generation_id']);
			$query = $this->db->get_where('subject','subject.id not in (select subject_id from student_subject where student_id = '.$student_id.')');
			$subjects =  $query->result_array();
			$subjects = $this->addProfessorToSubjects($subjects);
			return $subjects;
		}


		public function getRegisteredSubjectList($student){
			$student_id = $student['id'];
			$this->db->join('student_subject','subject.id = subject_id');
			$this->db->where('student_id',$student_id);
			$this->db->where('active',1);
			$query = $this->db->get('subject');
			$subjects = $query->result_array();
			return $subjects;
		}

		public function getUnenrolledSubjectList($student){
			$student_id = $student['id'];
			$this->db->select('*,subject.id as id,student_subject.id as student_subject_id');
			$this->db->join('student_subject','subject.id = subject_id');
			$this->db->where('student_id',$student_id);
			$this->db->where('active',0);
			$query = $this->db->get('subject');
			$subjects = $query->result_array();
			$subjects = $this->addProfessorToSubjects($subjects);
			return $subjects;
		}




		public function enroll($student_id,$subject_id,$professor_subject_id){
			$hasRegistered = $this->getRegisteredSubject($student_id,$subject_id);
			if(!empty($hasRegistered)){
				$this->session->set_flashdata('failed','Subject is registered');
				return false;
			}
			else{
				$data = array(
					'student_id'=>$student_id,
					'subject_id'=>$subject_id,
					'professor_subject_id'=>$professor_subject_id
				);
				return $this->db->insert('student_subject',$data);
			}
		}

		public function reroll($student_subject_id){
			$ss = ($this->db->get_where('student_subject',array('id'=>$student_subject_id)))->row_array();
			$student=$this->session->userdata();
			if($ss['student_id']==$student['id']){
				$student_id=$student['id'];
				$professor_subject_id = $this->input->post('professor_subject_id');
				$this->db->where('id',$student_subject_id);
				$data = array(
				'professor_subject_id'=>$professor_subject_id,
				'active'=>1
			);
			return $this->db->update('student_subject',$data);
			}
			
				
		}

		public function unenroll($student_id, $id){
			$this->db->where('student_id',$student_id);
			$this->db->where('id',$id);
			return($this->db->update('student_subject',array('active'=>0)));
		}


		public function getBranches(){
			return ($this->db->get('branches'))->result_array();
		}


		public function getGenerations(){
			$this->db->order_by('id','desc');
			return ($this->db->get('generations'))->result_array();
		}


		public function latestGeneration(){
			$this->db->limit(1);
			$this->db->order_by('id','desc');
			$arr = ($this->db->get('generations'))->row_array();
			return $arr['id'];
		}

		private function addProfessorToSubjects($subjects){
			for($i = 0;$i<sizeof($subjects);$i++){
				$this->db->join('professor','professor_subject.professor_id = professor.id');
				$this->db->join('staff','staff.id = professor.staff_id');
				$this->db->select('professor_subject.id,professor_id,staff_id,name');
				$q = $this->db->get_where('professor_subject',array('subject_id'=>$subjects[$i]['id']));
				$subjects[$i]['professors']=$q->result_array();
			}
			return $subjects;
		}

		public function getPSA($id){
			$this->db->select('*,psa.id as psa_id');
			$this->db->join('professor_subject','professor_subject.id = professor_subject_id');
			$this->db->join('subject','subject.id = subject_id');
			$this->db->where('professor_subject_id in (select professor_subject_id from student_subject where student_id = '.$id.')');
			$query = $this->db->get('psa');
			return $query->result_array();
		}

		public function getPSAById($id){
			$this->db->select('staff.name,psa.created_at,psa.title,psa.body,subject.name as subject_name');
			$this->db->join('professor_subject','professor_subject.id = professor_subject_id');
			$this->db->join('subject','subject.id = subject_id');
			$this->db->join('professor','professor.id = professor_subject.professor_id');
			$this->db->join('staff','staff.id = professor.staff_id');
			return($this->db->get_where('psa',array('psa.id'=>$id)))->row_array();
		}


		private function getRegisteredSubject($student_id,$subject_id){
			$this->db->join('student_subject','subject.id = subject_id');
			$query = $this->db->get_where('subject',array('student_id'=>$student_id,'subject_id'=>$subject_id));
			return $query->result_array();
		}


		public function login(){
			$username=$this->input->post('username');
			$password=md5($this->input->post('password'));
			$query = $this->db->get_where('student',array('username'=>$username,'password'=>$password));
			$user = $query->row_array();
			if($user['password']==$password){
				return $user;
			}
			return null;
		}

	}
?>

