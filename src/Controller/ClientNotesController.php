<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ClientNotes Controller
 *
 * @property \App\Model\Table\ClientNotesTable $ClientNotes
 *
 * @method \App\Model\Entity\ClientNote[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClientNotesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Clients']
        ];
        $clientNotes = $this->paginate($this->ClientNotes);

        $this->set(compact('clientNotes'));
    }

    /**
     * View method
     *
     * @param string|null $id Client Note id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $clientNote = $this->ClientNotes->get($id, [
            'contain' => ['Clients']
        ]);

        $this->set('clientNote', $clientNote);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $clientNote = $this->ClientNotes->newEntity();
        if ($this->request->is('post')) {
            $clientNote = $this->ClientNotes->patchEntity($clientNote, $this->request->getData());
            if ($this->ClientNotes->save($clientNote)) {
                $this->Flash->success(__('The client note has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The client note could not be saved. Please, try again.'));
        }
        $clients = $this->ClientNotes->Clients->find('list', ['limit' => 200]);
        $this->set(compact('clientNote', 'clients'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Client Note id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $clientNote = $this->ClientNotes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $clientNote = $this->ClientNotes->patchEntity($clientNote, $this->request->getData());
            if ($this->ClientNotes->save($clientNote)) {
                $this->Flash->success(__('The client note has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The client note could not be saved. Please, try again.'));
        }
        $clients = $this->ClientNotes->Clients->find('list', ['limit' => 200]);
        $this->set(compact('clientNote', 'clients'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Client Note id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $clientNote = $this->ClientNotes->get($id);
        if ($this->ClientNotes->delete($clientNote)) {
            $this->Flash->success(__('The client note has been deleted.'));
        } else {
            $this->Flash->error(__('The client note could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' =>'Clients', 'action' => 'view', $clientNote->client_id]);
    }


    public function getFlag($id = null)
    {
        $clientNote = $this->ClientNotes->get($id, [
            'contain' => ['Clients']
        ]);

        return $clientNote->client_note_flag;
    }


//    public function isAuthorized($user)
//    {
//
//        return false;
//    }
}
