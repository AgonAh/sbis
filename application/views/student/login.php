<h2 id="h2">Student login</h2>
<hr>
<form action="<?=base_url();?>student/login" method="POST" id="form1">
<div class="form-group">
	<label>Username</label>
	<input type="text" class="form-control" name="username" placeholder="Enter username">
</div>
<div class="form-group">
	<label>Password</label>
	<input type="password" class="form-control" name="password" placeholder="Enter password">
</div>
<button type="submit" class="btn btn-primary">Submit</button>
	<button class="btn btn-primary float-right" id="changeBtn" onclick="toStaff()" type="button">Staff</button>
</form>


<script>
	form = document.getElementById('form1');
	button = document.getElementById('changeBtn');
	h2 = document.getElementById('h2');
	function toStaff(){
	    form.setAttribute('action','<?=base_url();?>staff/login');
	    button.innerHTML="Student";
	    h2.innerHTML="Staff login";
	    button.setAttribute('onclick','toStudent()');
	}

    function toStudent(){
        form.setAttribute('action','<?=base_url();?>student/login');
        button.innerHTML="Staff";
        h2.innerHTML="Student login";
        button.setAttribute('onclick','toStaff()');
    }
</script>
