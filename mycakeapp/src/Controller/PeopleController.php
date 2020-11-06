<?php
namespace App\Controller;

use App\Controller\AppController;

class PeopleController extends AppController {

	public function index() {
		if ($this->request->isPost()){
			$find = $this->request->data['People']['find'];
			$data = $this->People->find('me', ['me'=>$find])
				->contain(['Messages']);
		} else {
			$data = $this->People->find('byAge')
				->contain(['Messages']);
		}
		$this->set('data', $data);
	}
		
}
