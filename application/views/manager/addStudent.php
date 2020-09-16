<?=validation_errors();?>
<?=form_open('manager/addstudent'); ?>
<div class="form-group">
<!--	<label>Full name</label>-->
	<input type="text" class="form-control" name="name" placeholder="Enter name">
</div>
<div class="form-group">
<!--	<label>Username</label>-->
	<input type="text" class="form-control" name="username" placeholder="Enter username">
</div>
<div class="form-group">
<!--	<label>Password</label>-->
	<input type="password" class="form-control" name="password" placeholder="Enter password">
</div>
<!--<label>Branch</label>-->
<select name="branch_id" class="form-control">
	<?php foreach($branches as $branch):?>
		<option value="<?=$branch['id'];?>"><?=$branch['name'];?></option>
	<?php endforeach; ?>
</select>
<button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php if(isset($addedStudent)):?>
<h3 class="text-center">Student added</h3>
	<table class="table col-md-8" style="border: 1px solid darkgrey; margin: auto; border-collapse: separate; ">
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Username</th>
			<th>Password</th>
			<th>Created at</th>
		</tr>
			<tr>
				<td><?=$addedStudent['id'];?></td>
				<td><?=$addedStudent['name'];?></td>
				<td><?=$addedStudent['username'];?></td>
				<td><?=$addedStudent['password'];?></td>
				<td><?=$addedStudent['created_at'];?></td>
			</tr>
	</table>
<?php endif;?>
