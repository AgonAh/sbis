<?=validation_errors();?>
<?=form_open('manager/addsubject'); ?>
<div class="form-group">
	<label>Subject name</label>
	<input type="text" class="form-control" name="name" placeholder="Subject name" autocomplete="off">
</div>
<div class="form-group">
	<label>ECTS</label>
	<input type="number" class="form-control" name="ects" placeholder="Enter ECTS">
</div>
<div class="form-group">
<label>Branch</label>
<select name="branch_id" class="form-control">
	<?php foreach($branches as $branch):?>
		<option value="<?=$branch['id'];?>"><?=$branch['name'];?></option>
	<?php endforeach; ?>
</select>
</div>
<div class="form-group">
<label>Generation</label>
<select name="generation_id" class="form-control">
	<?php foreach($generations as $generation):?>
		<option value="<?=$generation['id'];?>"><?=$generation['name'];?></option>
	<?php endforeach; ?>
</select>
</div>
<button type="submit" class="btn btn-primary">Submit</button>
</form>

<table class="table col-md-8" style="border: 1px solid darkgrey; margin: auto; border-collapse: separate; ">
	<tr>
    <th>Name</th>
    <th>Branch</th>
    <th>Generation</th>
    <th>ECTS</th>
	</tr>
	<?php foreach($subjects as $subject):?>
		<tr>
			<td><?= $subject['subject_name'] ?></td>
			<td><?= $subject['branch_name'] ?></td>
			<td><?= $subject['generation_name'] ?></td>
			<td><?= $subject['ects'] ?></td>
		</tr>
	<?php endforeach?>
</table>
