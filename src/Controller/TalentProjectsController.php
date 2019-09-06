<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TalentProjects Controller
 *
 * @property \App\Model\Table\TalentProjectsTable $TalentProjects
 *
 * @method \App\Model\Entity\TalentProject[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TalentProjectsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Talents', 'Projects']
        ];
        $talentProjects = $this->paginate($this->TalentProjects);

        $this->set(compact('talentProjects'));
    }

    /**
     * View method
     *
     * @param string|null $id Talent Project id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $talentProject = $this->TalentProjects->get($id, [
            'contain' => ['Talents', 'Projects']
        ]);

        $this->set('talentProject', $talentProject);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $talentProject = $this->TalentProjects->newEntity();
        if ($this->request->is('post')) {
            $talentProject = $this->TalentProjects->patchEntity($talentProject, $this->request->getData());
            if ($this->TalentProjects->save($talentProject)) {
                $this->Flash->success(__('The talent project has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The talent project could not be saved. Please, try again.'));
        }
        $talents = $this->TalentProjects->Talents->find('list', ['limit' => 200]);
        $projects = $this->TalentProjects->Projects->find('list', ['limit' => 200]);
        $this->set(compact('talentProject', 'talents', 'projects'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Talent Project id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $talentProject = $this->TalentProjects->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $talentProject = $this->TalentProjects->patchEntity($talentProject, $this->request->getData());
            if ($this->TalentProjects->save($talentProject)) {
                $this->Flash->success(__('The talent project has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The talent project could not be saved. Please, try again.'));
        }
        $talents = $this->TalentProjects->Talents->find('list', ['limit' => 200]);
        $projects = $this->TalentProjects->Projects->find('list', ['limit' => 200]);
        $this->set(compact('talentProject', 'talents', 'projects'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Talent Project id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $talentProject = $this->TalentProjects->get($id);
        if ($this->TalentProjects->delete($talentProject)) {
            $this->Flash->success(__('The talent project has been deleted.'));
        } else {
            $this->Flash->error(__('The talent project could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user)
    {

        return false;
    }
}
