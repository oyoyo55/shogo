<!DOCTYPE html>
<html>
<head>
	<?=$this->Html->charset() ?>
	<title><?=$this->fetch('title') ?></title>
	<?=$this->Html->css('hello') ?>
	<?=$this->Html->script('hello') ?>
</head>
<body>
	<header class="head row">
		<?=$this->element('header', ['subtitle'=>'cakephp sample page']) ?>
	</header>
	<div class="content row">
		<?=$this->fetch('content') ?>
	</div>
	<footer class="foot row">
		<?=$this->element('footer', ['copyright'=>'YAMADA-TARO']) ?>
	</footer>
</body>
</html>
