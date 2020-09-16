<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<?php if(isset($students[0]['professor_subject_id'])):?>
	<a href="<?=base_url();?>/professor/psa/<?=$students[0]['professor_subject_id'];?>" class="btn btn-primary float-right">Make PSA</a>
<?php endif;?>
<table class="table col-md-8" style="border: 1px solid darkgrey; margin: auto; border-collapse: separate; ">
	<tr>
		<th>Student</th>
		<th>Grade</th>
		<th>Action</th>
	</tr>

	<?php foreach($students as $student):?>
		<tr>
			<form action="<?=base_url();?>professor/store" id="form<?=$student['id']?>" method="POST">
			<td><?=$student['student_id'];?></td>
			<td><input type="text" name="grade" value="<?=$student['grade'];?>" class="col-md-2" style="border-radius: 5px" height="7"></td>
				<input type="hidden" name="table_id" value="<?=$student['id'];?>">
			<td> <button type="button" id="button<?=$student['id']?>" class=" btn-primary" onclick="ajaxSubmit(<?=$student['id'];?>)">Save</button> </td>
			</form>
		</tr>
	<?php endforeach;?>
</table>


<script>
	function ajaxSubmit($id){
	    form = document.getElementById($id);
	    console.log(form);
	    $.post('<?=base_url();?>professor/store',$('#form'+$id).serialize());
	    button = document.getElementById('button'+$id);
	    button.setAttribute('class','btn-success');
	}
</script>
