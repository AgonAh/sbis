<? 
// Headings array that contains all the titles
// itemList array that contains the database objects
// Names array that contains the variable key names in the itemList array
?>
<table class="table col-md-8" style="border: 1px solid darkgrey; margin: auto; border-collapse: separate; ">
	<tr>
    <?php foreach($headings as $heading):?>
        <th><?=$heading;?></th>
    <?php endforeach;?>
	</tr>
    <?php foreach($itemList as $item):?>
<tr>
    <?php foreach($names as $name):?>
        <td><?= $item[$name] ?></td>
    <?php endforeach?>
</tr>
    <?php endforeach;?>

</table>
