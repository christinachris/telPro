<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * Logs Controller
 *
 * @property \App\Model\Table\LogsTable $Logs
 *
 * @method \App\Model\Entity\Log[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LogsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Tasks', 'Projects']
        ];
        $logs = $this->paginate($this->Logs);

        $this->set(compact('logs'));
    }

    /**
     * View method
     *
     * @param string|null $id Log id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $log = $this->Logs->get($id, [
            'contain' => ['Tasks', 'Projects']
        ]);

        $this->set('log', $log);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($taskid = NULL)
    {
        $this->autoRender = false;
        $log = $this->Logs->newEntity();
        if ($this->request->is('post')) {
            // $log = $this->Logs->patchEntity($log, $this->request->getData());
            $today = date_create_from_format('Y-m-d H:i:s', date('Y-m-d H:i:s'));
            $log->log_time = $today;
            $log->task_id = $taskid;

            if ($this->Logs->save($log)) {
                $this->Flash->success(__('The log has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The log could not be saved. Please, try again.'));
        }
        $tasks = $this->Logs->Tasks->find('list', ['limit' => 200]);
        $projects = $this->Logs->Projects->find('list', ['limit' => 200]);
        $this->set(compact('log', 'tasks', 'projects'));
    }

    public function addLogs($action = NULL,$taskid = NULL ,$projectid = NULL,$user_name = NULL,$user_role = NULL, $value = NULL)
    {
        $this->autoRender = false;
//        $DD = TableRegistry::get('tasks')->find('all',['fields'=> ['task_name']])->where(['id' => 221]);
//        $AA = TableRegistry::get('status')->find('all',['fields'=> ['status_name']])->where(['status_id' => 3]);
        $log = $this->Logs->newEntity();
        $log = $this->Logs->patchEntity($log, $this->request->getData());
        $today = date_create_from_format('Y-m-d H:i:s', date('Y-m-d H:i:s'));
        $log->log_time = $today;

        if($taskid == 0){
            $log->task_name = NULL;
            $log->task_id = NULL;
        }else {
            $log->task_id = $taskid;
            $log->task_name = TableRegistry::get('tasks')->find('all', ['fields' => ['task_name']])->where(['id' => $taskid]);
        }
        $log->project_id = $projectid;
        $log->action_type = $action;
        $log->user_name= $user_name;
        $log->user_role = $user_role;
        $log->value = $value;
        $this->Logs->save($log);
    }

    /**
     * Edit method
     *
     * @param string|null $id Log id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $log = $this->Logs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $log = $this->Logs->patchEntity($log, $this->request->getData());
            if ($this->Logs->save($log)) {
                $this->Flash->success(__('The log has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The log could not be saved. Please, try again.'));
        }
        $tasks = $this->Logs->Tasks->find('list', ['limit' => 200]);
        $projects = $this->Logs->Projects->find('list', ['limit' => 200]);
        $this->set(compact('log', 'tasks', 'projects'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Log id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($projectid = null)
    {
        $this->request->allowMethod(['post', 'delete','get']);
        if ($this->Logs->deleteALL(["project_id" => $projectid])) {
            $this->Flash->success(__('The log has been deleted.'));
        } else {
            $this->Flash->error(__('The log could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
