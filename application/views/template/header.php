<?php $user = $this->session->userdata(); //print_r($user);?>
<!DOCTYPE html>
<html>
<head>
	<title>SBIS</title>
	<link rel="stylesheet" href="<?= base_url();?>assets/css/bootstrap-slate.min.css">
	<link rel="stylesheet" href="<?= base_url();?>assets/css/style.css">
</head>
<body>
<nav class="navbar navbar-default" style="margin-bottom:20px; padding-left:0;">
	<ul class="nav navbar-left">
		<li class="nav-item">
			<a class="nav-link" href="<?= base_url()?>">Home</a>
		</li>

		<?php if(isset($user['type'])):?>
		 	<?php if($user['type']=='student'): ?>
				<li class="nav-item dropdown">
					<a class="nav-link" href="<?= base_url()?>student"><?= $user['name'] ?> ^</a>

					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item" href="<?= base_url()?>student/grades">Grades</a>
						<a class="dropdown-item" href="<?= base_url()?>student/enroll">Enroll classes</a>
						<a class="dropdown-item" href="<?= base_url()?>student/psa">View messages</a>
					</div>
				</li>
			<?php elseif($user['type']=='staff'):?>
				<?php if($user['role_id']==1):?>
					<!--manager-->
					<li class="nav-item dropdown">
						<a class="nav-link" href="<?= base_url()?>manager"><?= $user['name'] ?> ^</a>

						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							<a class="dropdown-item" href="<?= base_url()?>manager/addsubject">Add subject</a>
							<a class="dropdown-item" href="<?= base_url()?>manager/addstaff">Add staff</a>
							<a class="dropdown-item" href="<?= base_url()?>manager/bindProfessorSubject">Add professor to subject</a>
							<a class="dropdown-item" href="<?= base_url()?>manager/addstudent">Add student</a>
							<a class="dropdown-item" href="<?= base_url()?>manager/addMisc">Miscellaneous</a>
						</div>
					</li>
				<?php elseif($user['role_id']==2):?>
					<!--professor-->
					<li class="nav-item dropdown">
						<a class="nav-link" href="<?= base_url()?>professor"><?= $user['name'] ?> ^</a>

						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							<a class="dropdown-item" href="<?= base_url()?>professor">Manage subjects</a>
						</div>
					</li>
				<?php endif;?>
			<?php endif;?>
		<?php endif;?>



	</ul>

	<ul class="nav navbar-right">
		<?php if($this->session->userdata('id')): ?>
			<li class="nav-item"><a href="<?= base_url()?>student/logout">Log out</a></li>
		<?php else: ?>
			<li class="nav-item"><a href="<?= base_url()?>student/login">Login</a></li>
		<?php endif;?>
	</ul>


</nav>


<div class="container">
<?php if($this->session->flashdata('success')):?>
	<p class="alert alert-success"><?=$this->session->flashdata('success');?></p>
<?php endif;?>
<?php if($this->session->flashdata('failed')): ?>
	<p class="alert alert-danger"><?= $this->session->flashdata('failed');?></p>
<?php endif; ?>
