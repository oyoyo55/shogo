<table>
<thead><tr>
	<th>id</th><th>domain</th>
</tr></thead>
<?php foreach($data->toArray() as $obj): ?>
<tr>
	<td><?=h($obj->id) ?></td>
	<td><a href="<?=$this->Url->build(['controller'=>'Urls', 
		'action'=>'view']); ?>?id=<?=$obj->id ?>">
		<?=h($obj->domain) ?></a></td>
</tr>
<?php endforeach; ?>
</table>
<a href="<?=$this->Url->build(['controller'=>'Urls', 
	'action'=>'add']); ?>"><button>Add URL</button></a>
