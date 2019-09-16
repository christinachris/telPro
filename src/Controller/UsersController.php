<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Controller\Component\AuthComponent;
use Cake\Event\Event;
use Cake\Mailer\Email;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Security;
use Cake\Mailer\TransportFactory;


/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }



    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Images']
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $user->token = Security::hash(Security::randomBytes(32));
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->loadModel('Talents');
        $talent = $this->Talents->find('list',
            ['valueField' => function($e){
                return ' '. $e->first_name. ' ' . $e->last_name;
            }])->toArray();
        $this->set("talents",$talent);
        $this->set(compact('user'));

    }
    public function forgetPassword(){
        $myEmail = $this->request->getData('email');
        $myToken = Security::hash(Security::randomBytes(32));

        $user = $this->Users->find('all')->where(['email'=>$myEmail])->first();
        if($this->request->is('post')){

            $user = $this->Users->patchEntity($user, $this->request->getData());
            $user->token = $myToken;
            if($this->Users->save($user)){
                $this->Flash->success(__('a reset password link has been sent to your email('.$myEmail.')'));
                $email = new Email();
                $email->setFrom(['2656514352@qq.com'=>'Set My Brand Up']);
                $email->setTo($myEmail);
                $email->setSubject("Reset Password");
                $email->send("Please click link below to reset your password 
                http://localhost:8765/users/resetPassword/$myToken");
                return $this->redirect(['action' => 'login']);


            }



        }
        $this->set(compact('user'));


    }


    public function resetPassword($token){
        $user = $this->Users->find('all')->where(['token'=>$token])->first();
        if($user==null){
            $this->Flash->error(__('the link is expired'));
            return $this->redirect(['action' => 'login']);

        }
        $myToken = Security::hash(Security::randomBytes(32));
        if($this->request->is(['patch', 'post', 'put'])){
            $user->password=$this->request->getData('password');
            $user->token = $myToken;
            if($this->Users->save($user)){
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->loadModel('Talents');
        $talent = $this->Talents->find('list',
            ['valueField' => function($e){
                return ' '. $e->first_name. ' ' . $e->last_name;
            }])->toArray();
        $this->set("talents",$talent);
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if($id!=30){
            if ($this->Users->delete($user)) {
                $this->Flash->success(__('The user has been deleted.'));
            }else {
                $this->Flash->error(__('The user could not be deleted. Please, try again.'));
            }
        }else{
            $this->Flash->error(__('Super Admin can not be deleted'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function login() {

        $this->viewBuilder()->setLayout('login');

        if ($this->request->is('post')) {
            $users=$this->Auth->identify();
            if ($users) {
                $this->Auth->setUser($users);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Incorrect username or password. Please try again.'));
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

   public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow('logout');
    }

    public function isAuthorized($user)
    {
        if(in_array($this->request->getParam('action'),['add','edit','index','view','delete'])&&$user['id']==8){
            return true;
        }
        if(in_array($this->request->getParam('action'),['forgetPassword','resetPassword'])){
            return true;
        }
    }

}
