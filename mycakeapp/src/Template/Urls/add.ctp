<?=$this->Form->create($entity, 
	['type'=>'post', 
	'url'=>['controller'=>'Urls', 
		'action'=>'create']]) ?>
<div>name</div>
<div><?=$this->Form->text('Urls.url') ?></div>
<div><?=$this->Form->submit('送信') ?></div>
