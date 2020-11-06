<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Bidmessages Controller
 *
 * @property \App\Model\Table\BidmessagesTable $Bidmessages
 *
 * @method \App\Model\Entity\Bidmessage[] paginate($object = null, array $settings = [])
 */
class BidmessagesController extends AuctionBaseController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Bidinfos', 'Users', 'Sendtos']
        ];
        $bidmessages = $this->paginate($this->Bidmessages);

        $this->set(compact('bidmessages'));
        $this->set('_serialize', ['bidmessages']);
    }

    /**
     * View method
     *
     * @param string|null $id Bidmessage id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bidmessage = $this->Bidmessages->get($id, [
            'contain' => ['Bidinfos', 'Users', 'Sendtos']
        ]);

        $this->set('bidmessage', $bidmessage);
        $this->set('_serialize', ['bidmessage']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $bidmessage = $this->Bidmessages->newEntity();
        if ($this->request->is('post')) {
            $bidmessage = $this->Bidmessages->patchEntity($bidmessage, $this->request->getData());
            if ($this->Bidmessages->save($bidmessage)) {
                $this->Flash->success(__('The bidmessage has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bidmessage could not be saved. Please, try again.'));
        }
        $bidinfos = $this->Bidmessages->Bidinfos->find('list', ['limit' => 200]);
        $users = $this->Bidmessages->Users->find('list', ['limit' => 200]);
        $sendtos = $this->Bidmessages->Sendtos->find('list', ['limit' => 200]);
        $this->set(compact('bidmessage', 'bidinfos', 'users', 'sendtos'));
        $this->set('_serialize', ['bidmessage']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Bidmessage id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bidmessage = $this->Bidmessages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bidmessage = $this->Bidmessages->patchEntity($bidmessage, $this->request->getData());
            if ($this->Bidmessages->save($bidmessage)) {
                $this->Flash->success(__('The bidmessage has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bidmessage could not be saved. Please, try again.'));
        }
        $bidinfos = $this->Bidmessages->Bidinfos->find('list', ['limit' => 200]);
        $users = $this->Bidmessages->Users->find('list', ['limit' => 200]);
        $sendtos = $this->Bidmessages->Sendtos->find('list', ['limit' => 200]);
        $this->set(compact('bidmessage', 'bidinfos', 'users', 'sendtos'));
        $this->set('_serialize', ['bidmessage']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Bidmessage id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bidmessage = $this->Bidmessages->get($id);
        if ($this->Bidmessages->delete($bidmessage)) {
            $this->Flash->success(__('The bidmessage has been deleted.'));
        } else {
            $this->Flash->error(__('The bidmessage could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
