<h2><?=$title;?></h2>
<?php //print_r($grades); ?>
<div style="margin-bottom: 40px;"></div>

<table class="table col-md-8" style="border: 1px solid darkgrey; margin: auto; border-collapse: separate; ">
	<tr>
	<th>Subject</th>
	<th>Grade</th>
	</tr>
	<?php foreach($grades as $grade): ?>
		<tr>
			<td><?=$grade['name']?></td>
			<td><?=$grade['grade']?></td>
		</tr>
	<?php endforeach;?>
</table>
