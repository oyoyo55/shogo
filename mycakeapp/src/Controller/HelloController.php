<?php
namespace App\Controller;

use App\Controller\AppController;

class HelloController extends AppController
{
	public function initialize() {
		$this->viewBuilder()->setLayout('hello');
	}

	public function index()
	{
		$this->set('header', ['subtitle'=>'from Controller with Love♡']);
		$this->set('footer', ['copyright'=>'名無しの権兵衛']);
	}

}
