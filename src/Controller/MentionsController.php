<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Mentions Controller
 *
 * @property \App\Model\Table\MentionsTable $Mentions
 *
 * @method \App\Model\Entity\Mention[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MentionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Talents', 'Projects', 'Tasks', 'Users']
        ];
        $mentions = $this->paginate($this->Mentions);

        $this->set(compact('mentions'));
    }

    /**
     * View method
     *
     * @param string|null $id Mention id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mention = $this->Mentions->get($id, [
            'contain' => ['Talents', 'Projects', 'Tasks', 'Users']
        ]);

        $this->set('mention', $mention);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mention = $this->Mentions->newEntity();
        if ($this->request->is('post')) {
            $mention = $this->Mentions->patchEntity($mention, $this->request->getData());
            if ($this->Mentions->save($mention)) {
                $this->Flash->success(__('The mention has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The mention could not be saved. Please, try again.'));
        }
        $talents = $this->Mentions->Talents->find('list', ['limit' => 200]);
        $projects = $this->Mentions->Projects->find('list', ['limit' => 200]);
        $tasks = $this->Mentions->Tasks->find('list', ['limit' => 200]);
        $users = $this->Mentions->Users->find('list', ['limit' => 200]);
        $this->set(compact('mention', 'talents', 'projects', 'tasks', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Mention id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $mention = $this->Mentions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mention = $this->Mentions->patchEntity($mention, $this->request->getData());
            if ($this->Mentions->save($mention)) {
                $this->Flash->success(__('The mention has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The mention could not be saved. Please, try again.'));
        }
        $talents = $this->Mentions->Talents->find('list', ['limit' => 200]);
        $projects = $this->Mentions->Projects->find('list', ['limit' => 200]);
        $tasks = $this->Mentions->Tasks->find('list', ['limit' => 200]);
        $users = $this->Mentions->Users->find('list', ['limit' => 200]);
        $this->set(compact('mention', 'talents', 'projects', 'tasks', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Mention id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = NULL)
    {
        $this->autoRender=false;
        $this->request->allowMethod(['post', 'delete','get']);
//        $mention = $this->Mentions->get($id);
       $this->Mentions->deleteALL(["talent_id" => $id]);
    }


}
