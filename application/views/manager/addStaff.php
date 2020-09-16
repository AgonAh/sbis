<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<?=validation_errors();?>
<?=form_open('manager/addStaff'); ?>
<div class="form-group">
	<label>Full name</label>
	<input type="text" class="form-control" name="name" placeholder="Enter name" autocomplete="off">
</div>
<div class="form-group">
	<label>Username</label>
	<input type="text" class="form-control" name="username" placeholder="Enter username" autocomplete="off">
</div>
<div class="form-group">
	<label>Password</label>
	<input type="password" class="form-control" name="password" placeholder="Enter password" autocomplete="off">
</div>

<div class="form-group">
	<label>Role</label>
<select name="role_id" class="form-control">
	<?php foreach($roles as $role):?>
		<option value="<?=$role['id'];?>"><?=$role['name'];?></option>
	<?php endforeach; ?>
</select>
</div>
<button type="submit" class="btn btn-primary">Submit</button>
</form>
<br><hr>

<input type="text" id="findStaff" autocomplete="off" class="form-control" placeholder="Find staff by name">
<button type="button" class="btn btn-primary" onclick="loadStaffTable()">Find</button>
<div id=staffTable></div>

<?php if(isset($addedStaff)):?>
	<h3 class="text-center">
		<?php if($addedStaff['role_id']==1)
			echo 'Manager';
		else if($addedStaff['role_id']==2)
			echo 'Professor';
		else
			echo 'Staff';
		?>
		added
	</h3>
	<table class="table col-md-8" style="border: 1px solid darkgrey; margin: auto; border-collapse: separate;">
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Username</th>
			<th>Password</th>
			<th>Created at</th>
		</tr>
		<tr>
			<td><?=$addedStaff['id'];?></td>
			<td><?=$addedStaff['name'];?></td>
			<td><?=$addedStaff['username'];?></td>
			<td><?=$addedStaff['password'];?></td>
			<td><?=$addedStaff['created_at'];?></td>
		</tr>
	</table>
<?php endif;?>

<script>
function loadStaffTable(){
	pattern = document.getElementById('findStaff').value;
	$("#staffTable").load('<?=base_url();?>manager/getStaffLike/'+pattern);
}
</script>
