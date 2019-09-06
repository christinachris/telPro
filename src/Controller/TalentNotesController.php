<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TalentNotes Controller
 *
 * @property \App\Model\Table\TalentNotesTable $TalentNotes
 *
 * @method \App\Model\Entity\TalentNote[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TalentNotesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Talents']
        ];
        $talentNotes = $this->paginate($this->TalentNotes);

        $this->set(compact('talentNotes'));
    }

    /**
     * View method
     *
     * @param string|null $id Talent Note id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $talentNote = $this->TalentNotes->get($id, [
            'contain' => ['Talents']
        ]);

        $this->set('talentNote', $talentNote);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $talentNote = $this->TalentNotes->newEntity();
        if ($this->request->is('post')) {
            $talentNote = $this->TalentNotes->patchEntity($talentNote, $this->request->getData());
            if ($this->TalentNotes->save($talentNote)) {
                $this->Flash->success(__('The talent note has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The talent note could not be saved. Please, try again.'));
        }
        $talents = $this->TalentNotes->Talents->find('list', ['limit' => 200]);
        $this->set(compact('talentNote', 'talents'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Talent Note id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $talentNote = $this->TalentNotes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $talentNote = $this->TalentNotes->patchEntity($talentNote, $this->request->getData());
            if ($this->TalentNotes->save($talentNote)) {
                $this->Flash->success(__('The talent note has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The talent note could not be saved. Please, try again.'));
        }
        $talents = $this->TalentNotes->Talents->find('list', ['limit' => 200]);
        $this->set(compact('talentNote', 'talents'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Talent Note id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $talentNote = $this->TalentNotes->get($id);
        if ($this->TalentNotes->delete($talentNote)) {
            $this->Flash->success(__('The talent note has been deleted.'));
        } else {
            $this->Flash->error(__('The talent note could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' =>'Talents', 'action' => 'view', $talentNote->talent_id]);
    }
//    public function isAuthorized($user)
//    {
//
//        return false;
//    }
}
