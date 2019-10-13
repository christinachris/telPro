<?php
namespace App\Controller;

use App\Model\Entity\ArticleView;
use App\Model\Entity\Role;
use App\Model\Table\ArticlesTable;
use App\Model\Table\ArticleViewsTable;
use Cake\Database\Query;
use Cake\Http\Exception\NotFoundException;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
ob_start();

/**
 * Clients Controller
 *
 * @property \App\Model\Table\ClientsTable $Clients
 *
 * @method \App\Model\Entity\Client[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClientsController extends AppController
{
    var $components = array('Flash');


    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */


    public function limitIndex()
    {

        $clients = $this->Clients->find('all')->where(['Clients.id' == 3])->contain([]);
        $clients = $this->paginate($clients);

    }

    public function index()
    {
//        $this->paginate = [
//            'contain' => ['Talents'],'limit'=>'20','order' => [
//                'Clients.id' => 'desc']
//        ];
        $user_id = $this->Auth->user('id');
        $user_role = $this->Auth->user('role');
        $user_name = $this->Auth->user('username');
        $user_talent_id = $this->Auth->user('talent_id');
        $view_full_client_list = $this->Auth->user('permission_view_full_client_list');
        $view_limited_client_list = $this->Auth->user('permission_view_limited_client_list');


        if ($view_limited_client_list == 1 && $view_full_client_list == 0) {
            $this->loadModel('TalentProjects');
            $project = $this->TalentProjects->find('all')->where(['talent_id' => $user_talent_id])->toArray();
            $array = [];
            foreach ($project as $some) {

                $array[] = $some->project_id;
            }
            $this->loadModel('Projects');

            $project = $this->Projects->find('all')->where(['id IN' => $array])->toArray();
            foreach ($project as $some) {

                $arrays[] = $some->client_id;
            }
            $clients = $this->Clients->find('all')->where(['Clients.archive' => false, 'Clients.id IN' => $arrays])->contain(['Talents', 'Activities', 'clientNotes']);
            $clients = $this->paginate($clients);

        } else if ($view_full_client_list == 1) {
            $clients = $this->Clients->find('all')->where(['Clients.archive' => false])->contain(['Talents', 'Activities', 'clientNotes']);
            $clients = $this->paginate($clients);
        } else {
            $clients = $this->Clients->find('all')->where(['Clients.id' => -1])->contain(['Talents', 'Activities', 'clientNotes']);
            $clients = $this->paginate($clients);
        }


        $this->set("user_name", $user_name);

        $this->set("user_role", $user_role);

        $this->set('clients', $clients);

        $this->loadModel('Activities');
        $now = Time::now()->i18nFormat('yyyy-MM-dd');
        $client_act = $this->Clients->find('all')->where(['and' => ['Clients.archive' => false]])->contain(['Talents', 'Activities'])->toList();

        foreach ($client_act as $client_acts) {

            $min = 10000;
            for ($i = 0; $i < sizeof($client_acts['activities']); $i++) {
                $differenceDate = (strtotime($now) - strtotime($client_acts['activities'][$i]['date'])) / 86400;
                if ($differenceDate > 0 && $differenceDate < $min) {
                    $min = $differenceDate;
                    $client2 = $this->Clients->newEntity();
                    $client2->id = $client_acts->id;
                    $client2->last_contactdate = $client_acts['activities'][$i]['date'];
                    $this->Clients->save($client2);
                }
            }
        }

        $activity = $this->Activities->newEntity();
        if ($this->request->is('post')) {
            $activity = $this->Activities->patchEntity($activity, $this->request->getData());
            $activity->create_date = Time::now()->i18nFormat('yyyy-MM-dd HH:mm:ss', 'GMT+10');
            $activity->edit_date = Time::now()->i18nFormat('yyyy-MM-dd HH:mm:ss');
            $activity->activity_flag = 0;
            if ($this->Activities->save($activity)) {
                $this->Flash->success(__('The activity has been added.'));
                return $this->redirect(['action' => 'index']);
            }

        }
        $lastcontacted = $this->Activities->find('all', array('order' => array('Activities.id' => 'DESC')))->where(['Activities.client_id' => 107]);
        $clients->last_contactdate = $lastcontacted->first();

        $this->set(compact('clients', 'lastcontacted'));
        $this->set('activity', $activity);


        $this->loadModel('ClientNotes');
        $clientNote = $this->ClientNotes->newEntity();
        if ($this->request->is('post')) {

            $clientNote = $this->ClientNotes->patchEntity($clientNote, $this->request->getData());
            $clientNote->create_date = Time::now()->i18nFormat('yyyy-MM-dd HH:mm:ss', 'GMT+10');
            $clientNote->edit_date = Time::now()->i18nFormat('yyyy-MM-dd HH:mm:ss');


            if ($this->ClientNotes->save($clientNote)) {
                $this->Flash->success(__('The client note has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The client note could not be saved. Please, try again.'));
        }
        $this->set('clientNote', $clientNote);

    }

    public function archiveIndex()
    {


        $user_id = $this->Auth->user('id');
        $user_role = $this->Auth->user('role');
        $user_name = $this->Auth->user('username');


        $this->set("user_name", $user_name);
        $this->set("user_role", $user_role);

        $this->paginate = [
            'contain' => ['Talents']
        ];
        $clients = $this->paginate($this->Clients->find('all')->where(['Clients.archive' => true])->contain([]));


        $this->set(compact('clients'));
    }


    /**
     * View method
     *
     * @param string|null $id Client id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {

        $user_id = $this->Auth->user('id');
        $user_role = $this->Auth->user('role');
        $user_name = $this->Auth->user('username');


        $this->set("user_name", $user_name);
        $this->set("user_role", $user_role);


        $client = $this->Clients->get($id, [
            'contain' => ['Activities', 'Emails', 'Phones', 'Projects', 'ClientNotes']
        ]);

        $this->set('client', $client);
        $this->set('id', $id);
        $this->loadModel('Activities');
        $this->loadModel('ClientNotes');

        $activity = $this->Activities->newEntity();
        $clientNote = $this->ClientNotes->newEntity();


        $this->loadModel('Projects');
        $this->loadModel('Talents');
        $client_talent = $this->Clients->get($id, [
            'contain' => ['Activities', 'Emails', 'Phones', 'Projects' => ['Talents'], 'ClientNotes']
        ]);
        //    var_dump($client_talent['projects'][0]['talents']);
        $this->set('client_talent', $client_talent['projects']);


        if ($this->request->is('post')) {

            $activity = $this->Activities->patchEntity($activity, $this->request->getData());
            $activity->create_date = Time::now()->i18nFormat('yyyy-MM-dd HH:mm:ss', 'GMT+10');
            $activity->edit_date = Time::now()->i18nFormat('yyyy-MM-dd HH:mm:ss');
            $activity->client_id = $id;
            $activity->activity_flag = 0;


            if ($this->Activities->save($activity)) {
                $this->Flash->success(__('The activity has been added.'));
                return $this->redirect(['action' => 'view', $id]);
            }
        }
        $this->set('activity', $activity);

        if ($this->request->is('post')) {

            $clientNote = $this->ClientNotes->patchEntity($clientNote, $this->request->getData());
            $clientNote->create_date = Time::now()->i18nFormat('yyyy-MM-dd HH:mm:ss', 'GMT+10');
            $clientNote->edit_date = Time::now()->i18nFormat('yyyy-MM-dd HH:mm:ss');
            $clientNote->client_id = $id;

            if ($this->ClientNotes->save($clientNote)) {
                $this->Flash->success(__('The client note has been saved.'));

                return $this->redirect(['action' => 'view', $id]);
            }
            $this->Flash->error(__('The client note could not be saved. Please, try again.'));
        }
        $this->set('clientNote', $clientNote);

        /* cannot get activity id for each activity, so comment it for now.

    if ($this->request->is(['patch', 'post', 'put'])) {
        $activity = $this->Activities->patchEntity($activity, $this->request->getData());
        $activity->edit_date=Time::now()->i18nFormat('yyyy-MM-dd HH:mm:ss');
        $activity->client_id=$id;
        $activity->summary=$this->request->getData();
        $activity->type=$this->request->getData();
        $activity->date=$this->request->getData();
        $activity->time=$this->request->getData();

        $this->Activities->save($activity);

        if ($this->Activities->save($activity)) {
            $this->Flash->success(__('The activity has been saved.'));

            return $this->redirect(['action' => 'view',$id]);
        }
        $this->Flash->error(__('The activity could not be saved. Please, try again.'));
    }*/
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */

    public function add()
    {

        $user_id = $this->Auth->user('id');
        $user_role = $this->Auth->user('role');
        $user_name = $this->Auth->user('username');


        $this->set("user_name", $user_name);
        $this->set("user_role", $user_role);

        $this->loadModel('Phones');
        $this->loadModel('Emails');
        $client = $this->Clients->newEntity();
        $client->archive = 0;

        if ($this->request->is('post')) {
            $client = $this->Clients->patchEntity($client, $this->request->getData());

            if ($this->Clients->save($client)) {
                $this->Flash->success(__('The client has been saved.'));
            }

            for ($i = 0; $i < sizeof($this->request->getData()['Phones']); $i++) {
                $phones = $this->Phones->newEntity();
                $phones->title = $this->request->getData()['Phones'][$i]['title'];
                $phones->phone_no = $this->request->getData()['Phones'][$i]['phone_no'];
                if (isset($_POST['Phones'][$i]['is_primary'])) {
                    if ($this->request->getData()['Phones'][$i]['is_primary'] == '1' || $this->request->getData()['Phones'][$i]['is_primary'] == 'on') {
                        $phones->is_primary = 1;
                    } else {
                        $phones->is_primary = 0;
                    }
                } else {
                    $phones->is_primary = 0;
                }
                $phones->client_id = $client->id;


                $this->Phones->save($phones);
            }

            for ($i = 0; $i < sizeof($this->request->getData()['Emails']); $i++) {
                $emails = $this->Emails->newEntity();
                $emails->title = $this->request->getData()['Emails'][$i]['title'];
                $emails->email_address = $this->request->getData()['Emails'][$i]['email_address'];
                if (isset($_POST['Emails'][$i]['is_primary'])) {
                    if ($this->request->getData()['Phones'][$i]['is_primary'] == '1' || $this->request->getData()['Emails'][$i]['is_primary'] == 'on') {
                        $emails->is_primary = 1;
                    } else {
                        $emails->is_primary = 0;
                    }
                } else {
                    $emails->is_primary = 0;
                }
                $emails->client_id = $client->id;


                $this->Emails->save($emails);
            }

            if (isset($_POST['flag'])) {
                if ($this->request->getData()['flag'] == '1' || $this->request->getData()['flag'] == 'on') {
                    $client->flag = 1;
                } else {
                    $client->flag = 0;
                }

            }

            return $this->redirect(['action' => 'index']);

            $this->Flash->error(__('The client could not be saved. Please, try again.'));
        }
        $talents = $this->Clients->Talents->find('list',
            ['valueField' => function ($e) {
                return $e->position . ' ' . ':' . ' ' . $e->first_name . ' ' . $e->last_name;
            },
                'conditions' => ['Talents.position IN' => ['Admin', 'Superadmin', 'Project Manager']]])->toArray();
        $this->set(compact('client', 'talents'));

    }


    /**
     * Edit method
     *
     * @param string|null $id Client id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $user_id = $this->Auth->user('id');
        $user_role = $this->Auth->user('role');
        $user_name = $this->Auth->user('username');


        $this->set("user_name", $user_name);
        $this->set("user_role", $user_role);

        $this->loadModel('Phones');
        $this->loadModel('Emails');
        $client = $this->Clients->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $clientphones = $this->Phones->find('all', ['conditions' => ['client_id' => $id]])->toList();
            $clientemails = $this->Emails->find('all', ['conditions' => ['client_id' => $id]])->toList();

            for ($i = 0; $i < sizeof($clientphones); $i++) {
                $this->Phones->delete($clientphones[$i]);
            }

            foreach ($this->request->getData()['Phones'] as $i => $phone) {
                // var_dump($this->request->getData());
                $phones = $this->Phones->newEntity();
                $phones->title = $this->request->getData()['Phones'][$i]['title'];
                $phones->phone_no = $this->request->getData()['Phones'][$i]['phone_no'];
                if ($this->request->getData()['phone_primary'][0] == $i) {

                    $phones->is_primary = 1;
                } else {
                    $phones->is_primary = 0;
                }

                $phones->client_id = $client->id;


                $this->Phones->save($phones);
            }

            for ($i = 0; $i < sizeof($clientemails); $i++) {
                $this->Emails->delete($clientemails[$i]);
            }

            foreach ($this->request->getData()['Emails'] as $i => $email) {
                // var_dump($this->request->getData());
                $emails = $this->Emails->newEntity();
                $emails->title = $this->request->getData()['Emails'][$i]['title'];
                $emails->email_address = $this->request->getData()['Emails'][$i]['email_address'];
                if ($this->request->getData()['email_primary'][0] == $i) {

                    $emails->is_primary = 1;
                } else {
                    $emails->is_primary = 0;
                }

                $emails->client_id = $client->id;


                $this->Emails->save($emails);
            }

            $client = $this->Clients->patchEntity($client, $this->request->getData());


            $this->Clients->save($client);
            $this->Flash->success(__('The client has been updated.'));
            return $this->redirect(["controller" => "Clients", 'action' => 'index']);
        }
        $talents = $this->Clients->Talents->find('list',
            ['valueField' => function ($e) {
                return $e->position . ' ' . ':' . ' ' . $e->first_name . ' ' . $e->last_name;
            },
                'conditions' => ['Talents.position IN' => ['Admin', 'Superadmin', 'Project Manager']]])->toArray();
        $phones = $this->Phones->find('all', ['conditions' => ['client_id' => $id]]);
        $emails = $this->Emails->find('all', ['conditions' => ['client_id' => $id]]);
        $this->set(compact('client', 'talents', 'phones', 'emails'));


    }

    public function viewCredentials($id = null)
    {
        $this->loadModel('Activities');

        $client = $this->Clients->get($id);
        $this->set('client', $client);
        return $this->redirect(['controller' => 'Clients', 'action' => 'index']);

    }


    /**
     * Delete method
     *
     * @param string|null $id Client id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $client = $this->Clients->get($id);
        if ($this->Clients->delete($client)) {
            $this->Flash->success(__('Your client has been deleted.'));
        } else {
            $this->Flash->error(__('The client could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' => 'Clients', 'action' => 'archive_index']);
    }

    public function setFlag($id = null)
    {

        $client = $this->Clients->get($id);
        if ($client->flag == 1) {
            $client->flag = 0;
        } else {
            $client->flag = 1;
        }
        $this->Clients->save($client);

    }

    public function archive($id = null)
    {


        $clients = $this->Clients->get($id);
        if ($clients == null) {
            throw new NotFoundException();
        }

        // If an article is archived, it is "unpublished" as well
        $clients->archive = true;

        if ($this->Clients->save($clients)) {
            $this->Flash->success(__('Your client has been archived.'));

        } else {
            $this->Flash->error(__('Unable to archive your client.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function unarchive($id = null)
    {
        $clients = $this->Clients->get($id);
        if ($clients == null) {
            throw new NotFoundException();
        }

        // If an article is archived, it is "unpublished" as well
        $clients->archive = false;

        if ($this->Clients->save($clients)) {
            $this->Flash->success(__('Your client has been unarchived.'));

        } else {
            $this->Flash->error(__('Unable to client your article.'));
        }

        return $this->redirect(['action' => 'archive_index']);
    }

    public function isAuthorized($user)
    {
        if ($user['role'] != "SuperAdmin") {
            if (in_array($this->request->getParam('action'), ['view']) && ($user['permission_view_full_client_list'] == 1)) {

                return true;
            }

            if (in_array($this->request->getParam('action'), ['edit']) && ($user['permission_view_full_client_list'] == 1 && $user['permission_edit_client'] == 1)) {

                return true;
            }

            if (in_array($this->request->getParam('action'), ['view']) && ($user['permission_view_limited_client_list'] == 1)) {
                if ($user['permission_view_full_client_list'] == 1) {

                    return true;
                }
                $clientId = (int)$this->request->getParam('pass.0');//this is the id of the client
                $this->loadModel('TalentProjects');
                $project = $this->TalentProjects->find('all')->where(['talent_id' => $user['talent_id']])->toArray();//this is an array that store all the project that has this talent.
                $array = [];
                foreach ($project as $some) {

                    $array[] = $some->project_id;// store all the id to array
                }
                $this->loadModel('Projects');

                $project = $this->Projects->find('all')->where(['id IN' => $array])->toArray();//store all the project to the array
                foreach ($project as $some) {

                    $arrays[] = $some->client_id;//use array to store all the client_id
                }
                foreach ($arrays as $aaa) {
                    if ($aaa == $clientId) {
                        return true;
                    }


                }
            }


            if (in_array($this->request->getParam('action'), ['edit']) && ($user['permission_view_limited_client_list'] == 1 && $user['permission_edit_client'] == 1)) {
                if ($user['permission_view_full_client_list'] == 1) {

                    return true;
                }
                $clientId = (int)$this->request->getParam('pass.0');
                $this->loadModel('TalentProjects');
                $project = $this->TalentProjects->find('all')->where(['talent_id' => $user['talent_id']])->toArray();
                $array = [];
                foreach ($project as $some) {

                    $array[] = $some->project_id;
                }
                $this->loadModel('Projects');

                $project = $this->Projects->find('all')->where(['id IN' => $array])->toArray();
                foreach ($project as $some) {

                    $arrays[] = $some->client_id;
                }
                foreach ($arrays as $aaa) {
                    if ($aaa == $clientId) {
                        return true;
                    }


                }
            }
            if (in_array($this->request->getParam('action'), ['archive', 'archiveIndex'])) {
                return parent::isAuthorized($user);
            }

            if ($this->request->getParam('action') === 'index' && ($user['permission_view_full_client_list'] == 1 || $user['permission_view_limited_client_list'] == 1)) {

                return true;
            }


            if ($this->request->getParam('action') === 'add' && $user['permission_add_client'] == 1) {

                return true;
            }

            if ($this->request->getParam('action') === 'delete' && $user['permission_delete_client'] == 1) {
                return true;
            }


            return false;
        } else {
            return true;
        }

    }
}
