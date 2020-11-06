<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class UrlsTable extends Table {
	
	public function initialize(array $config) {
		parent::initialize($config);

		$this->setTable('urls');
		$this->setDisplayField('url');
		$this->setPrimaryKey('id');
	}
}
