<?=validation_errors();?>
<?=form_open('manager/addMisc'); ?>
<div class="form-group">
	<label>Add branch</label>
	<input type="text" class="form-control" name="name" placeholder="Enter branch name">
</div>
<input type="hidden" value="branch" name="type">
<button type="submit" class="btn btn-primary">Submit</button>
</form>
<br>
<hr>

<?=form_open('manager/addMisc'); ?>
<div class="form-group">
	<label>Add generation</label>
	<input type="text" class="form-control" name="name" placeholder="Enter generation name">
</div>
<input type="hidden" value="generation" name="type">
<button type="submit" class="btn btn-primary">Submit</button>
</form>
<br>
<hr>
	<div class="col-md-8" style="margin:auto" >
		<div style="float:left" class="col-md-4" >
		<h3 class="text-center">Branches</h3>
		<table class="table" style="border: 1px solid darkgrey; margin: auto; border-collapse: separate; min-width:100%">
			<tr>
				<th>Branch name</th>
			</tr>
			<?php foreach($branches as $branch):?>
				<tr>
					<td><?=$branch['name'];?></td>
				</tr>
			<?php endforeach;?>
		</table>
		</div>


		<div style="float:right" class="col-md-4">
		<h3 class="text-center">Generations</h3>
		<table class="table" style="border: 1px solid darkgrey; margin: auto; border-collapse: separate; min-width:100%;">
			<tr>
				<th>Generation name</th>
			</tr>
			<?php foreach($generations as $generation):?>
				<tr>
					<td><?=$generation['name'];?></td>
				</tr>
			<?php endforeach;?>
		</table>
		</div>

	</div>
