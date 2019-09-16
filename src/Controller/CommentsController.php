<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
/**
 * Comments Controller
 *
 * @property \App\Model\Table\CommentsTable $Comments
 *
 * @method \App\Model\Entity\Comment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CommentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Tasks']
        ];
        $comments = $this->paginate($this->Comments);


        $tasks = $this->Comments->Tasks->find('all', ['limit' => 200]);
        $this->set(compact('comments','tasks'));
    }

    /**
     * View method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $comment = $this->Comments->get($id, [
            'contain' => []
        ]);

        $this->set('comment', $comment);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id,$taskid)
    {
        $comment = $this->Comments->newEntity();

        if ($this->request->is('post')) {
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());
            // @mention START -------------
            // Get @mention Data
//                debug($taskAdd->description);
            $DescArray = explode(" ",$comment->comment_desc);
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
                    $tasknames = TableRegistry::get('tasks')->find()->where( ["id" => $taskid] );
                    foreach ($mentionedTalent as $key1 => $value){
                        $talent_id=$value["id"];
                    }
                    foreach ($tasknames as $key1 => $value){
                        $taskname = $value["task_name"];
                    }
                    $this->set(compact('mentionedTalent'));
                    // load Mentions Table - Save Data
                    $model =$this->loadModel('Mentions');
                    $mention = $model->newEntity();
                    $mention->talent_id = $talent_id;
                    $mention->mention_date = $today;
                    $mention->project_id = $id;
                    $mention->task_id = $taskid;
                    $mention->task_name = $taskname;
                    $model->save($mention);
                }
            }
            // @mention END ----------------
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));

                return $this->redirect(['controller'=> 'tasks', 'action' => 'index', $id]);
            }
            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
        }

        $this->set(compact('comment','comments'));
    }

    public function startsWith ($string, $startString)
    {
        $len = strlen($startString);
        return (substr($string, 0, $len) === $startString);
    }


    /**
     * Edit method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null, $projectId)
    {
        $comment = $this->Comments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));

                return $this->redirect(['controller'=> 'tasks', 'action' => 'index', $projectId]);
            }
            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
        }
        $this->set(compact('comment'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null,$projectId)
    {
//        $this->request->allowMethod(['post', 'delete']);
        $comment = $this->Comments->get($id);
        if ($this->Comments->delete($comment)) {
            $this->Flash->success(__('The comment has been deleted.'));
        } else {
            $this->Flash->error(__('The comment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller'=> 'tasks', 'action' => 'index', $projectId]);
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
