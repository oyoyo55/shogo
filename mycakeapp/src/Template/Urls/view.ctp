<h3>※ID = <?=$entity['id'] ?> のデータ</h3>
<div><b>domain:</b></div>
<ul><li><?=h($entity['domain']) ?></li></ul>
<div><b>title:</b></div>
<ul><li><?=h($entity['title']) ?></li></ul>
<div><b>url:</b></div>
<ul><li><?=h($entity['url']) ?></li></ul>
<div><b>html code:</b></div>
<textarea><?= h($entity['context']) ?></textarea>
<hr>
<div><b>link:</b></div>
<ul>
<?php foreach(json_decode($entity['links']) as $obj): ?>
	<?php if (empty($obj)) break; ?>
	<li><a href="<?=h(($obj[0] == 'h' ?  '' : 'http://' . $entity['domain'])
		. ($obj[0] == '/' ? '' : $obj[0] == 'h' ? '' : '/') . $obj) ?>" 
		target="_target"><?= $obj ?></a></li>
<?php endforeach; ?>
</ul>
<hr>
<div><b>image:</b></div>
<ul>
<?php foreach(json_decode($entity['images']) as $obj): ?>
	<?php if (empty($obj)) break; ?>
	<li><a href="<?=h(($obj[0] == 'h' ?  '' : 'http://' . $entity['domain'])
		. ($obj[0] == '/' ? '' : $obj[0] == 'h' ? '' : '/') . $obj) ?>" 
		target="_target"><?= $obj ?></a></li>
<?php endforeach; ?>
</ul>
