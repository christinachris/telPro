<?php

namespace App\Controller;

use App\Controller\AppController;
use MongoDB\BSON\UTCDateTime;
use phpDocumentor\Reflection\DocBlock\Description;
use PhpParser\Node\Expr\Empty_;
use Cake\ORM\TableRegistry;
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
    public function startsWith ($string, $startString)
    {
        $len = strlen($startString);
        return (substr($string, 0, $len) === $startString);
    }

    public function index($id)
    {

        if (!empty($id)) {
            $this->paginate = [
                'contain' => ['Projects', 'Status', 'Colours', 'Labels', 'Comments', 'Talents','logs']
            ];
//        $tasks = $this->paginate($this->Tasks);

            $taskAdd = $this->Tasks->newEntity();
            if ($this->request->is('post')) {
                $array = $this->request->data['upload'];
                $taskAdd = $this->Tasks->patchEntity($taskAdd, $this->request->getData());
                // @mention START -------------
                // Get @mention Data
//                debug($taskAdd->description);
                $DescArray = explode(" ",$taskAdd->description);
                //set due date
                $taskAdd->due_date = date('Y-m-d H:i:s',strtotime(strtr($this->request->getData()['due_date'],'-', ' ')));
                $today = date_create_from_format('Y-m-d H:i:s', date('Y-m-d H:i:s'));
                foreach($DescArray as $item){
                    if($this->startsWith($item,"@")){
                        //Getting string start with @ and Break in to first and last name
                        $nameArray = explode("-",substr($item, 1));
//                        foreach($nameArray as $name){
//                            debug($nameArray);
                        $first_name= $nameArray[0];
                        $last_name = $nameArray[1];
                        $mentionedTalent = TableRegistry::get('talents')->find()->where(["last_name"=>$last_name,"first_name"=>$first_name ]);
                        foreach ($mentionedTalent as $key1 => $value){
                            $talent_id=$value["id"];
                        }
                        $this->set(compact('mentionedTalent'));
                        // load Mentions Table - Save Data
                        $model =$this->loadModel('Mentions');
                        $mention = $model->newEntity();
                        $mention->talent_id = $talent_id;
                        $mention->mention_date = $today;
                        $mention->project_id = $id;
                        $mention->task_id = null;
                        $model->save($mention);
                    }
                }
                // @mention END ----------------
                // Save images Path
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
              // -----------Word Limited Start ---------------
                $errorMessage=false;
                $note = $this->request->getData()['description'];
                if(strlen($note)>5000){
                    //$this->set('errors','Characters exceed the upper limit');
                    $errorMessage=true;
                }
                if($errorMessage){
                    //$this->set('errors','Characters exceed the upper limit');
                    $this->Flash->error(__('The task could not be saved. Characters exceed the upper limit.'));

                }
                // -----------Word Limited End ---------------
                else {
                    if ($this->Tasks->save($taskAdd)) {
                        $this->Flash->success(__('The task has been saved.'));
                    } else {
                        $this->Flash->error(__('The task could not be saved. Please, try again.'));
                    }
                }
            }

            $type_results = $this->Tasks->Colours->find('list', ['keyField' => 'colour_id',
                'valueField' => 'card_type'])->toArray();
            $this->set('card_types', $type_results);


//-       In order to display all the tasks card instead of only 20 of them.
            $tasks = $this->Tasks->find('all')->where(['project_id' => $id]);
            //Find ("all")  to get all the data from Table "task_status"
            $status = $this->Tasks->Status->find('all', ['limit' => 200]);
            $projects = $this->Tasks->Projects->find('list')->where(['id' => $id]);
            $projectName = $this->Tasks->Projects->find('all')->where(['id' => $id]);
            $projectNum = $this->Tasks->Projects->find()->where(['id' => $id])->first();
            $colours = $this->Tasks->Colours->find('all', ['limit' => 200]);
            $labels = $this->Tasks->Labels->find('list', ['limit' => 200]);

            $talents = $this->Tasks->Projects->Talents->find('all');
            //Get logs belongs to current project
            $logs = TableRegistry::get('logs')->find('all', ["order" => ["id" => "DESC"]])->where(['project_id' => $id]);
            $this->set(compact('tasks', 'status', 'taskAdd', 'projects', 'colours', 'labels', 'id', 'projectNum', 'comments', 'taskEdit', 'talents', 'projectName','logs','array'));

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
            debug($taskEdit->description);
            debug($taskEdit->due_date);
            // @mention START -------------
            // Get @mention Data
//                debug($taskAdd->description);
            $DescArray = explode(" ",$taskEdit->description);
            $today = date_create_from_format('Y-m-d H:i:s', date('Y-m-d H:i:s'));
            foreach($DescArray as $item){
                if($this->startsWith($item,"@")){
                    //Getting string start with @ and Break in to first and last name
                    $nameArray = explode("-",substr($item, 1));
//                        foreach($nameArray as $name){
//                            debug($nameArray);
                    $first_name= $nameArray[0];
                    $last_name = $nameArray[1];
                    $mentionedTalent = TableRegistry::get('talents')->find()->where(["last_name"=>$last_name,"first_name"=>$first_name ]);
                    foreach ($mentionedTalent as $key1 => $value){
                        $talent_id=$value["id"];
                    }
                    $this->set(compact('mentionedTalent'));
                    // load Mentions Table - Save Data
                    $model =$this->loadModel('Mentions');
                    $mention = $model->newEntity();
                    $mention->talent_id = $talent_id;
                    $mention->mention_date = $today;
                    $mention->project_id = $id;
                    $mention->task_id = null;
                    $model->save($mention);
                }
            }
            // @mention END ----------------
            // convert datetime format
            $taskEdit->due_date = date('Y-m-d H:i:s',strtotime(strtr($this->request->getData()['due_date'],'-', ' ')));
            //$taskEdit->due_date = date_format(date_create_from_format('Y/m/d H:i', $taskEdit->due_date), 'Y-m-d H:i:s');
            debug($taskEdit->description);
            // Save images Path
            //var_dump($array);
            $date = date('YmdHis');
            $dir = WWW_ROOT . 'img/uploads' . DS; //<!-- app/webroot/img/
            if (!empty($array['tmp_name'])) {
                move_uploaded_file($array['tmp_name'], $dir . $date . $array['name']);
                $path = $dir . $date . $array['name'];
                $taskEdit->upload_path = $path;
            }
            $errorMessage=false;
            $note = $this->request->getData()['description'];
            if(strlen($note)>5000){
                //$this->set('errors','Characters exceed the upper limit');
                $errorMessage=true;
            }
            if($errorMessage){
                //$this->set('errors','Characters exceed the upper limit');
                $this->Flash->error(__('The task could not be saved. Characters exceed the upper limit.'));
                return $this->redirect(["controller" => 'Tasks','action' => 'index', $taskEdit->project_id]);
            }
            else {
                if ($this->Tasks->save($taskEdit)) {
                    $this->Flash->success(__('Tasks has been successfully Updated ! '));
                    return $this->redirect(['controller' => 'Tasks', 'action' => 'index', $taskEdit->project_id]);
                } else {
                    $this->Flash->error(__('The task could not be saved. Please, try again.'));
                    return $this->redirect(['controller' => 'Tasks', 'action' => 'index', $taskEdit->project_id]);
                }
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

        $this->request->allowMethod(['post', 'delete', 'get','ajax']);
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
    public function isAuthorized($user)
    {

        if(in_array($this->request->getParam('action'),['index','add','view','delete','archive','archiveIndex'])){
            $user_id=$this->Auth->user('talent_id');
            $user_role=$this->Auth->user('role');
            $user_name=$this->Auth->user('username');
            if($user_role=='Project Manager'||'Admin'|| 'Superadmin'){
                return true;
            }
        }

        return true;
    }
}
