<?php
namespace App\Controller;

use App\Controller\AppController;


use Cake\Auth\DefaultPasswordHasher; // added.
use Cake\Event\Event; // added.

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

	public function initialize()
	{
		parent::initialize();
		// 各種コンポーネントのロード
		$this->loadComponent('RequestHandler');
		$this->loadComponent('Flash');
		$this->loadComponent('Auth', [
			'authorize' => ['Controller'],
			'authenticate' => [
				'Form' => [
					'fields' => [
						'username' => 'username',
						'password' => 'password'
					]
				]
			],
			'loginRedirect' => [
				'controller' => 'Users',
				'action' => 'login'
			],
			'logoutRedirect' => [
				'controller' => 'Users',
				'action' => 'logout',
			],
			'authError' => 'ログインしてください。',
		]);
	}

	// ログイン処理
	function login(){
		// POST時の処理
		if($this->request->isPost()) {
			$user = $this->Auth->identify();
			// Authのidentifyをユーザーに設定
			if(!empty($user)){
				$this->Auth->setUser($user);
				return $this->redirect($this->Auth->redirectUrl());
			}
			$this->Flash->error('ユーザー名かパスワードが間違っています。');
		}
	}
	
	// ログアウト処理
	public function logout() {
		// セッションを破棄
		$this->request->session()->destroy();
		return $this->redirect($this->Auth->logout());
	}

	// 認証を使わないページの設定
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
		$this->Auth->allow(['login']);
	}
	
	// 認証時のロールのチェック
	public function isAuthorized($user = null){
		// 管理者はtrue
		if($user['role'] === 'admin'){
		   return true;
		}
		// 一般ユーザーはfalse
		if($user['role'] === 'user'){
		   return false;
		}
		// 他はすべてfalse
		return false;
	}

		/**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		$users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Bidinfo', 'Biditems', 'Bidmessages', 'Bidrequests']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
			$user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
			$user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
