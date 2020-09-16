<?=form_open('student/signup'); ?>
	<div class="form-group">
		<label>Full name</label>
		<input type="text" class="form-control" name="name" placeholder="Enter name">
	</div>
	<div class="form-group">
		<label>Username</label>
		<input type="text" class="form-control" name="username" placeholder="Enter username">
	</div>
	<div class="form-group">
		<label>Password</label>
		<input type="password" class="form-control" name="password" placeholder="Enter password">
	</div>
	<label>Branch</label>
	<select name="branch_id" class="form-control">
		<?php foreach($branches as $branch):?>
			<option value="<?=$branch['id'];?>"><?=$branch['name'];?></option>
		<?php endforeach; ?>
	</select>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>
<!--TODO::Remove this file after moving to management-->
