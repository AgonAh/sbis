<h1>View messages</h1>
<br>
<hr>
<div id="psa-list">
<?php foreach($psaList as $psa):?>
	<a  href="<?=base_url();?>student/viewPSA/<?=$psa['psa_id'];?>">
		<div class="psa-item">
			<strong>
				<?= $psa['title'] ?> 	|	<?= $psa['name'] ?>
			</strong>
			<small>        |        Sent: <?=$psa['created_at'];?></small>
		<hr>
		</div>
	</a>
<?php endforeach;?>
</div>
<style>
	#psa-list a:hover{
		text-decoration: none;
	}
	#psa-list:hover{
		border-radius: 25px;
		background-color: darkslategray;
	}
	.psa-item{
		margin-left:20px;
	}
</style>
