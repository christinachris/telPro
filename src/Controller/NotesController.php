<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Notes Controller
 *
 * @property \App\Model\Table\NotesTable $Notes
 *
 * @method \App\Model\Entity\Note[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NotesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $notes = $this->paginate($this->Notes);

        $this->set(compact('notes'));
    }

    /**
     * View method
     *
     * @param string|null $id Note id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $note = $this->Notes->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('note', $note);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $note = $this->Notes->newEntity();	
        if ($this->request->is('post')) {
            $note = $this->Notes->patchEntity($note, $this->request->getData());
			$errorMessage=false;
			if(strlen($note)>4000){
                //$this->set('errors','Characters exceed the upper limit');
                $errorMessage=true;				
			}
			if($errorMessage){
				//$this->set('errors','Characters exceed the upper limit');
				$this->Flash->error(__('The note could not be saved. Characters exceed the upper limit.'));
				return $this->redirect(["controller" => 'Dashboard','action' => 'index']);
			}
            if ($this->Notes->save($note)) {
                $this->Flash->success(__('The note has been saved.'));

                return $this->redirect(['action' => 'index']);
            }else{
            $this->Flash->error(__('The note could not be saved. Please, try again.'));
			}
        }
        $users = $this->Notes->Users->find('list', ['limit' => 200]);
        $this->set(compact('note', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Note id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
         $this->autoRender =false;
        $note = $this->Notes->newEntity();
		$errorMessage=false;	
        if ($this->request->is(['patch', 'post', 'put'])) {
            $note = $this->Notes->patchEntity($note, $this->request->getData());
			$errorMessage=false;
			if(strlen($this->request->getData()['note_desc'])>4000){
                //$this->set('errors','Characters exceed the upper limit');
                $errorMessage=true;				
			}
			if($errorMessage){
				//$this->set('errors','Characters exceed the upper limit');
				$this->Flash->error(__('The note could not be saved. Characters exceed the upper limit.'));
				return $this->redirect(["controller" => 'Dashboard','action' => 'index']);
			}
            if ($this->Notes->save($note)) {
                $this->Flash->success(__('The note has been saved.'));
                return $this->redirect(["controller" => 'Dashboard','action' => 'index']);
            }else{
					$this->Flash->error(__('The note could not be saved. Please, try again.'));          			
			return $this->redirect(["controller" => 'Dashboard','action' => 'index']);
			}
        }
        $users = $this->Notes->Users->find('list', ['limit' => 200]);
        $this->set(compact('note', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Note id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $note = $this->Notes->get($id);
        if ($this->Notes->delete($note)) {
            $this->Flash->success(__('The note has been deleted.'));
        } else {
            $this->Flash->error(__('The note could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
