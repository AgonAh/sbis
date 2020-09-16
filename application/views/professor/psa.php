<h2 id="h2">Send PSA</h2>
<hr>
<form action="<?=base_url();?>professor/psa/<?=$professor_subject_id;?>" method="POST" id="form1">
	<div class="form-group">
		<label>Title</label>
		<input type="text" class="form-control" name="title" placeholder="Enter title">
	</div>
	<div class="form-group">
		<label>Body</label>
		<textarea class="form-control" name="body" placeholder="Enter body"></textarea>
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>
