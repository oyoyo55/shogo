<?php
namespace App\Controller;

use App\Controller\AppController;

class UrlsController extends AppController {
	
	public function index() {
		$data = $this->Urls->find('all');
		$this->set('data', $data);
	}

	public function add() {
		$entity = $this->Urls->newEntity();
		$this->set('entity', $entity);
	}

	public function create() {
		if ($this->request->is('post')){
			$form =  $this->request->data['Urls'];

			$url = $form['url'];
			$url_obj = parse_url($url);
			$domain = $url_obj['host'];
			$opts = [
				'http'=>[
					'header' => "User-Agent:Php-Agent/1.0rn"
				]
			];
			$context = stream_context_create($opts);
			$html = file_get_contents($url,false,$context);
			preg_match_all('|<title>(.*?)</title>|mis',$html,$title_matches);
			preg_match_all('|<a href=\"(.*?)\".*?>(.*?)</a>|mis',$html,$href_matches);			
			preg_match_all('|<img src=\"(.*?)\"|mis',$html,$src_matches);			
			
			$title = $title_matches[1][0];
			$href = json_encode($href_matches[1]);
			$src = json_encode($src_matches[1]);
			
			$entity = $this->Urls->newEntity();
			$entity->url = $url;
			$entity->title = $title;
			$entity->domain = $domain;
			$entity->context = $html;
			$entity->links = $href;
			$entity->images = $src;
			$this->Urls->save($entity);
		}
		return $this->redirect(['action'=>'index']);
	}

	public function view() {
		$id = $this->request->query['id'];
		$entity = $this->Urls->get($id);
		$this->set('entity', $entity);
	}
}