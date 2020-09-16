<table class="table col-md-8" style="border: 1px solid darkgrey; margin: auto; border-collapse: separate; ">
	<tr>
		<th>Subject</th>
		<th>Professor</th>
		<th>Enrolled</th>
	</tr>
	<?php foreach($unregisteredSubjects as $subject): ?>
		<?= form_open('student/enroll/'.$subject['id']) ?>
		<tr>
			<td><?=$subject['name'];?></td>

			<td>
				Professor:
				<select name="professor_subject_id" style="border-radius: 15px; min-width:60%">
					<?php foreach($subject['professors'] as $professor):?>
						<option value="<?=$professor['id']?>"><?=$professor['name'];?></option>
					<?php endforeach;?>
				</select>
			</td>
			<td><button class="btn btn-primary">Enroll</button></td>
			<!--		<td><a href="--><?////= base_url(); ?><!--student/addsubject/--><?////=$subject['id'];?><!--" class="btn btn-primary">Enroll</a></td>-->
		</tr>
		</form>
	<?php endforeach; ?>
	<?php foreach($unenrolledSubjects as $subject): ?>
		<?= form_open('student/reroll/'.$subject['student_subject_id']) ?>
		<tr>
			<td><?=$subject['name'];?></td>

			<td>
				Professor:
				<select name="professor_subject_id" style="border-radius: 15px; min-width:60%">
					<?php foreach($subject['professors'] as $professor):?>
						<option value="<?=$professor['id']?>"><?=$professor['name'];?></option>
					<?php endforeach;?>
				</select>
			</td>
			<td><button class="btn btn-primary">Re-enroll</button></td>
		</tr>
		</form>
	<?php endforeach; ?>

<?php foreach($registeredSubjects as $subject): ?>
<tr>
	<td><?=$subject['name'];?></td>
	<td></td>
	<td> <a href="<?=base_url();?>student/unenroll/<?=$subject['id'];?>" class="btn btn-danger">Unenroll</a> </td>
</tr>
<?php endforeach;?>
</table>
