<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SkillCategories Controller
 *
 * @property \App\Model\Table\SkillCategoriesTable $SkillCategories
 *
 * @method \App\Model\Entity\SkillCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SkillCategoriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $skillCategories = $this->paginate($this->SkillCategories);

        $this->set(compact('skillCategories'));
    }

    /**
     * View method
     *
     * @param string|null $id Skill Category id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $skillCategory = $this->SkillCategories->get($id, [
            'contain' => []
        ]);

        $this->set('skillCategory', $skillCategory);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $skillCategory = $this->SkillCategories->newEntity();
        if ($this->request->is('post')) {
            $skillCategory = $this->SkillCategories->patchEntity($skillCategory, $this->request->getData());
            if ($this->SkillCategories->save($skillCategory)) {
                $this->Flash->success(__('The skill category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The skill category could not be saved. Please, try again.'));
        }
        $this->set(compact('skillCategory'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Skill Category id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $skillCategory = $this->SkillCategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $skillCategory = $this->SkillCategories->patchEntity($skillCategory, $this->request->getData());
            if ($this->SkillCategories->save($skillCategory)) {
                $this->Flash->success(__('The skill category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The skill category could not be saved. Please, try again.'));
        }
        $this->set(compact('skillCategory'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Skill Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $skillCategory = $this->SkillCategories->get($id);
        if ($this->SkillCategories->delete($skillCategory)) {
            $this->Flash->success(__('The skill category has been deleted.'));
        } else {
            $this->Flash->error(__('The skill category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
