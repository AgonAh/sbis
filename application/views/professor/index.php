<?php foreach($subjects as $subject): ?>
	<a href="<?=base_url();?>professor/subject/<?=$subject['id'];?>"><h2>Manage | <?=$subject['name'];?></h2></a><br>
	<?php endforeach;?>
