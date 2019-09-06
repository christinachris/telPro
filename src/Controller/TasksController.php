<?php

namespace App\Controller;

use App\Controller\AppController;
use MongoDB\BSON\UTCDateTime;
use PhpParser\Node\Expr\Empty_;

/**
 * Tasks Controller
 *
 * @property \App\Model\Table\TasksTable $Tasks
 *
 * @method \App\Model\Entity\Task[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TasksController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */

    public function index($id)
    {

        if (!empty($id)) {
            $this->paginate = [
                'contain' => ['Projects', 'Status', 'Colours', 'Labels', 'Comments', 'Talents']
            ];
//        $tasks = $this->paginate($this->Tasks);

            $taskAdd = $this->Tasks->newEntity();
            if ($this->request->is('post')) {
                $array = $this->request->data['upload'];
                $taskAdd = $this->Tasks->patchEntity($taskAdd, $this->request->getData());

                // Save images Path
                //var_dump($array);
                if(!empty($array['tmp_name'])) {
                    $date = date('YmdHis');
                    $dir = WWW_ROOT . 'img/uploads' . DS; //<!-- app/webroot/img/
                    move_uploaded_file($array['tmp_name'], $dir . $date . $array['name']);
                    $path = $dir . $date . $array['name'];
                    $taskAdd->upload_path = $path;
                }
                else{
                    $taskAdd->upload_path = NULL;
                }
                if ($this->Tasks->save($taskAdd)) {
                    $this->Flash->success(__('The task has been saved.'));
                } else {
                    $this->Flash->error(__('The task could not be saved. Please, try again.'));
                }
            }

            $type_results = $this->Tasks->Colours->find('list', ['keyField' => 'colour_id',
                'valueField' => 'card_type'])->toArray();
            $this->set('card_types', $type_results);

//-       In order to display all the tasks card instead of only 20 of them.
            $tasks = $this->Tasks->find('all', ['limit' => 200])->where(['project_id' => $id]);
            //Find ("all")  to get all the data from Table "task_status"
            $status = $this->Tasks->Status->find('all', ['limit' => 200]);
            $projects = $this->Tasks->Projects->find('list')->where(['id' => $id]);
            $projectName = $this->Tasks->Projects->find('all')->where(['id' => $id]);
            $projectNum = $this->Tasks->Projects->find()->where(['id' => $id])->first();
            $colours = $this->Tasks->Colours->find('all', ['limit' => 200]);
            $labels = $this->Tasks->Labels->find('list', ['limit' => 200]);
            $talents = $this->Tasks->Projects->Talents->find('all', ['limit' => 200]);
            $this->set(compact('tasks', 'status', 'taskAdd', 'projects', 'colours', 'labels', 'id', 'projectNum', 'comments', 'taskEdit', 'talents', 'projectName'));
        } else {
            return $this->redirect(['controller' => 'projects', 'action' => 'index']);
        }
    }

    /**
     * View method
     *
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $task = $this->Tasks->get($id, [
            'contain' => ['Projects', 'Status', 'Colours', 'Labels']
        ]);

        $this->set('task', $task);
    }

    public function fetchCard($id = null)
    {
        $task = $this->Tasks->get($id, [
            'contain' => ['Projects', 'Status', 'Colours', 'Labels']
        ]);

        $this->set([
            'task' => $task,
            '_serialize' => 'task',
        ]);
        $this->RequestHandler->renderAs($this, 'json');
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $task = $this->Tasks->newEntity();
        if ($this->request->is('post')) {
            $array = $this->request->data['upload'];
            $task = $this->Tasks->patchEntity($task, $this->request->getData());

            // Save images Path
            //var_dump($array);
            $date = date('YmdHis');
            $dir = WWW_ROOT . 'img/uploads' . DS; //<!-- app/webroot/img/
            move_uploaded_file($array['tmp_name'], $dir . $date . $array['name']);
            $path = $dir . $date . $array['name'];
            $task->images_path = $path;

            if ($this->Tasks->save($task)) {
                $this->Flash->success(__('The task has been added.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The task could not be saved. Please, try again.'));
        }
        $projects = $this->Tasks->Projects->find('list', ['limit' => 200]);
        $status = $this->Tasks->Status->find('list', ['limit' => 200]);
        $colours = $this->Tasks->Colours->find('list', ['limit' => 200]);
        $labels = $this->Tasks->Labels->find('list', ['limit' => 200]);
        $this->set(compact('task', 'projects', 'status', 'colours', 'labels'));
    }

    //Function: Getting Data from View/Task index and Update Task card Status_id to Database Table
    public function updateId($taskId, $statusId)
    {
        $this->autoRender = false;
        $task = $this->Tasks->get($taskId);
        $task->status_id = $statusId;
        $task->moved_date = date_create_from_format('Y-m-d H:i:s', date('Y-m-d H:i:s'));
        $this->Tasks->save($task);
        // get values here
//        echo $this->request->data['taskId'];
//        echo $this->request->data['statusId'];
//        if ($this->Tasks->save($task)) {
//            $this->Flash->success(__('The task has been saved.'));
//        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $taskEdit = $this->Tasks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $array = $this->request->data['upload'];

            $taskEdit = $this->Tasks->patchEntity($taskEdit, $this->request->getData());
            // convert datetime format
            $taskEdit->due_date = date_format(date_create_from_format('Y/m/d H:i', $taskEdit->due_date), 'Y-m-d H:i:s');

            // Save images Path
            //var_dump($array);
            $date = date('YmdHis');
            $dir = WWW_ROOT . 'img/uploads' . DS; //<!-- app/webroot/img/
            if (!empty($array['tmp_name'])) {
                move_uploaded_file($array['tmp_name'], $dir . $date . $array['name']);
                $path = $dir . $date . $array['name'];
                $taskEdit->upload_path = $path;
            }

            if ($this->Tasks->save($taskEdit)) {
                $this->Flash->success(__('Tasks has been successfully Updated ! '));
                return $this->redirect(['controller' => 'Tasks', 'action' => 'index', $taskEdit->project_id]);
            } else {
                $this->Flash->error(__('The task could not be saved. Please, try again.'));
                return $this->redirect(['controller' => 'Tasks', 'action' => 'index', $taskEdit->project_id]);
            }

        }
//        }

        $type_results = $this->Tasks->Colours->find('list', ['keyField' => 'colour_id',
            'valueField' => 'card_type'])->toArray();
        $this->set('card_types', $type_results);

        $projects = $this->Tasks->Projects->find('list', ['limit' => 200]);
        $status = $this->Tasks->Status->find('list', ['limit' => 200]);
        $colours = $this->Tasks->Colours->find('list', ['limit' => 200]);
        $labels = $this->Tasks->Labels->find('list', ['limit' => 200]);
        $comments = $this->Tasks->Comments->find('all')->where(['task_id' => $id])->order(['comment_date' => 'DESC']);
        $this->set(compact('$taskEdit', 'projects', 'status', 'colours', 'labels', 'comments'));
    }


    public function editfetch($id)
    {
        $this->autoRender = false;

        $taskfetch = $this->Tasks->get($id, [
            'contain' => ['Projects', 'Status', 'Colours', 'Labels']
        ]);
        $this->set('task', $taskfetch);

    }

    /**
     * Delete method
     *
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id)
    {

        $this->request->allowMethod(['post', 'delete', 'get']);
        $task = $this->Tasks->get($id);
        if ($this->Tasks->delete($task)) {
            return $this->redirect(['action' => 'index', $task->project_id]);
        } else {
            $this->Flash->error(__('The task could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function deleteImg($id)
    {

        $this->autoRender = false;
        $this->request->allowMethod(['post', 'delete', 'get', 'ajax']);
        $task = $this->Tasks->get($id);
        $findme = 'webroot';
        $mystring = $task->upload_path;
        $pos2 = stripos($mystring, $findme);
        $path = substr($mystring, $pos2);
        $realpath = urldecode(str_replace("%5C", "/", urlencode($path)));
        unlink($_SERVER['DOCUMENT_ROOT'] . "/IMS-project/" . $realpath);
        $task->upload_path = NULL;
        $this->Tasks->save($task);
    }

}
