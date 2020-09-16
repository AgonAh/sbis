<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<?=form_open('manager/bindProfessorSubject'); ?>

<div class="form-group" id="professor-group" onfocusin="expand('professor_select')" onfocusout="collapse('professor_select')">
	<label>Professor</label><br>
	<input type="text" class="form-control col-md-11" id="ProfessorName" autocomplete="off" placeholder="Enter name" style="display:inline">
<!--	<button type="button" onclick="reloadProfessor()" class="btn btn-primary pull-right">Search</button>-->
	<select name="professor_id" id="professor_select" class="form-control col-md-10" style="display:inline;"></select>
	<button type="button" onclick="view('professor')" class="btn btn-primary col-md-1 align-top">View</button>
</div>
<hr>
<div class="form-group"  onfocusin="expand('subject_select')" onfocusout="collapse('subject_select')">
	<label>Subject</label><br>
	<input type="text" class="form-control col-md-11" name="name" id="SubjectName" autocomplete="off" placeholder="Search subject" style="display:inline">
<!--	<button type="button" onclick="reloadSubject()" class="btn btn-primary pull-right">Search</button>-->
	<select name="generation-id" id="generation-id" class="form-control col-md-11" >
		<?php foreach($generations as $generation):?>
			<option value="<?=$generation['id'];?>"><?=$generation['name'];?></option>
		<?php endforeach;?>
		<option value="0">Any</option>
	</select>
	<select name="subject_id" id="subject_select" class="form-control col-md-10 pull-right" style="display:inline;"></select>
	<button type="button" onclick="view('subject')" class="btn btn-primary col-md-1 align-top">View</button>
</div>

<button type="submit" class="btn btn-primary" id="submit">Submit</button>
</form>
<?=$bindAdded;?>
<div id="viewTable"></div>



<script>
	professors = <?= json_encode($professors);?>;
    subjects = <?= json_encode($subjects);?>;
	loadOptions(professors,'professor_select');
	loadOptions(subjects,'subject_select');


	function search(input,arr){
        let reg = new RegExp(input.toLowerCase());
		let passedList = []; //Declaration of return list
		arr.forEach(function(item){
		    if(reg.test(item['name'].toLowerCase())){
                passedList.push(item);
			}
		});
        return passedList;
	}


	function reloadProfessor(){
	    let inp = document.getElementById('ProfessorName').value;
	    let arr = search(inp,professors);
		loadOptions(arr,'professor_select');
	}

	function reloadSubject(){
	    let inp = document.getElementById('SubjectName').value;
	    let arr = search(inp,subjects);
		loadOptions(arr,'subject_select');
	}


	function loadOptions(list, selectId){
        h = '';
        list.forEach(function(item){
            h+=`<option value="`+item['id']+`">`+item['name']+`</option>`;
		});
        select = document.getElementById(selectId);
        select.innerHTML=h;
	}

    function getSubjects(){
        pattern = document.getElementById('SubjectName').value;
        $("#subject_select").load('<?=base_url();?>staff/getsubjects/'+pattern);
    }

    function expand(id){
        document.getElementById(id).size=3;
	}
	function collapse(id){
        document.getElementById(id).size=0;
	}


	//Add autosearch on keypress
    document.getElementById('ProfessorName').addEventListener("keyup",function(event){
        event.preventDefault();
        reloadProfessor();
    });
    document.getElementById('SubjectName').addEventListener("keyup",function(event){
        event.preventDefault();
        reloadSubject();
    });


	function view(type){
		id = document.getElementById(type+'_select').value;
		$("#viewTable").load('<?=base_url();?>manager/'+type+'Table/'+id);
	}

	//Prevent form submitting from enter
    // $(document).ready(function() {
    //     $(window).keydown(function(event){
    //         if(event.keyCode == 13) {
    //             event.preventDefault();
    //             return false;
    //         }
    //     });
    // });
</script>


