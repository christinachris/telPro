<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
ob_start();

/**
 * Talents Controller
 *
 * @property \App\Model\Table\TalentsTable $Talents
 *
 * @method \App\Model\Entity\Talent[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TalentsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */

    public function index()
    {


        $this->paginate = [
            'contain' => ['Specialities', 'SkillCategories','Projects'],'order' => [
                'Talents.id' => 'desc']
        ];
        $this->loadModel('Projects');
        $user_id=$this->Auth->user('talent_id');
        $user_name=$this->Auth->user('username');
        $user_role=$this->Auth->user('role');


        if($user_role=='Project Manager'){
            $this->loadModel('TalentProjects');
            $project = $this->TalentProjects->find('all')->where(['talent_id'=>$user_id])->toArray();
            $array=[];
            foreach($project as $some){

                $array[]=$some->project_id;
            }

            $project = $this->TalentProjects->find('all')->where(['Project_id IN'=>$array])->toArray();
            foreach($project as $some){

                $arrays[]=$some->talent_id;
            }

            $talents = $this->paginate($this->Talents->find('all')->where(['Talents.archive' => false ,'Talents.id IN'=>$arrays])->contain([]));
        }else{
            $talents = $this->paginate($this->Talents->find('all')->where(['Talents.archive' => false ])->contain(['Projects']));
        }

        $this->set("user_role", $user_role);
        $this->set("user_name", $user_name);
        $this->set(compact('talents'));

        $this->loadModel('TalentNotes');
        $talentNote = $this->TalentNotes->newEntity();




        if ($this->request->is('post')) {

            $talentNote = $this->TalentNotes->patchEntity($talentNote, $this->request->getData());
            $talentNote->created_date= Time::now()->i18nFormat('yyyy-MM-dd HH:mm:ss', 'GMT+10');
            $talentNote->edited_date=Time::now()->i18nFormat('yyyy-MM-dd HH:mm:ss');

            if ($this->TalentNotes->save($talentNote)) {
                $this->Flash->success(__('The talent note has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The talent note could not be saved. Please, try again.'));
        }
        $this->set('talentNote', $talentNote);
    }

    public function archiveIndex()
    {

        $user_id=$this->Auth->user('id');
        $user_role=$this->Auth->user('role');
        $user_name=$this->Auth->user('username');


        $this->set("user_name", $user_name);
        $this->set("user_role", $user_role);

        $this->paginate = [
            'contain' => ['Specialities', 'SkillCategories']
        ];
        $talents = $this->paginate($this->Talents->find('all')->where(['Talents.archive' => true])->contain([]));

        $this->set(compact('talents'));
    }



    /**
     * View method
     *
     * @param string|null $id Talent id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {

        $user_id=$this->Auth->user('id');
        $user_role=$this->Auth->user('role');
        $user_name=$this->Auth->user('username');


        $this->set("user_name", $user_name);
        $this->set("user_role", $user_role);

        $talent = $this->Talents->get($id, [
            'contain' => ['Specialities', 'SkillCategories', 'TalentNotes','Projects']
        ]);

        $this->set('talent', $talent);
        $this->set('id', $id);
        $this->loadModel('Activities');
        $this->loadModel('ClientNotes');
        $this->loadModel('TalentNotes');
        $this->loadModel('Projects');
        $this->loadModel('talent_projects');
        $this->loadModel('Clients');
        $this->loadModel('Users');
        $talentNote = $this->TalentNotes->newEntity();
        $activity = $this->Activities->newEntity();

        $this->loadModel('Projects');
        $this->loadModel('Talents');
        $talent_project = $this->Talents->get($id, [
            'contain' => [ 'Specialities', 'SkillCategories', 'Projects','TalentNotes']
        ]);
        //    var_dump($client_talent['projects'][0]['talents']);
        $this->set('talent_project',$talent_project['projects']);

$talentID=$this->Users->find('all',['conditions'=>['talent_id'=>$id]])->select('id');


        $clientnote=$this->ClientNotes->find('all',['conditions'=>['talent_id'=>$talentID]])->select(['create_date'=>'create_date','client_id'=>'client_id','content','summary'=>'content','date'=>'create_date','time'=>'create_date']);
        $clientactivity=$this->Activities->find('all',['conditions'=>['talent_id'=>$talentID]])->select(['create_date'=>'create_date','client_id'=>'client_id','type','summary','date','time']);
        $allActivity=$clientnote->unionAll($clientactivity)->epilog('ORDER BY create_date DESC')->toList();
        $this->set('allActivity',$allActivity);

        $talent_firstName=$talent_project->first_name;
        $talent_lastName=$talent_project->last_name;
        $this->set('talentfn',$talent_firstName);
        $this->set('talentln',$talent_lastName);

        $client=$this->Clients->find('all')->toList();
        $this->set('client',$client);

        if ($this->request->is('post')) {

            $activity = $this->Activities->patchEntity($activity, $this->request->getData());
            $activity->create_date= Time::now()->i18nFormat('yyyy-MM-dd HH:mm:ss', 'GMT+10');
            $activity->edit_date=Time::now()->i18nFormat('yyyy-MM-dd HH:mm:ss');
            $activity->client_id=$id;


            if ($this->Activities->save($activity)) {
                $this->Flash->success(__('The activity has been added.'));
                return $this->redirect(['action' => 'view',$id]);
            }
        }
        $this->set('activity', $activity);





        if ($this->request->is('post')) {

            $talentNote = $this->TalentNotes->patchEntity($talentNote, $this->request->getData());
            $talentNote->created_date= Time::now()->i18nFormat('yyyy-MM-dd HH:mm:ss', 'GMT+10');
            $talentNote->edited_date=Time::now()->i18nFormat('yyyy-MM-dd HH:mm:ss');
            $talentNote->talent_id=$id;

            if ($this->TalentNotes->save($talentNote)) {
                $this->Flash->success(__('The talent note has been saved.'));

                return $this->redirect(['action' => 'view', $id]);
            }
            $this->Flash->error(__('The talent note could not be saved. Please, try again.'));
        }
        $this->set('talentNote', $talentNote);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        $user_id=$this->Auth->user('id');
        $user_role=$this->Auth->user('role');
        $user_name=$this->Auth->user('username');


        $this->set("user_name", $user_name);
        $this->set("user_role", $user_role);

        $talent = $this->Talents->newEntity();
        $talent->archive=0;
        if ($this->request->is('post')) {
            $talent = $this->Talents->patchEntity($talent, $this->request->getData());
            if ($this->Talents->save($talent)) {
                if(isset($_POST['occupied'])){
                    if($this->request->getData()['occupied']=='1'||$this->request->getData()['occupied']=='on'){
                        $talent->occupied=1;
                    }
                    else{
                        $talent->occupied=0;
                    }

                }
                $this->Flash->success(__('The talent has been saved.'));


                return $this->redirect(['controller'=>'Talents','action' => 'index']);
            }
            $this->Flash->error(__('The talent could not be saved. Please, try again.'));
        }
        $specialities = $this->Talents->Specialities->find('list', ['limit' => 200]);
        $skillCategories = $this->Talents->SkillCategories->find('list', ['limit' => 200]);
        $this->set(compact('talent', 'specialities', 'skillCategories'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Talent id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $user_id=$this->Auth->user('id');
        $user_role=$this->Auth->user('role');
        $user_name=$this->Auth->user('username');


        $this->set("user_name", $user_name);
        $this->set("user_role", $user_role);

        $talent = $this->Talents->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $talent = $this->Talents->patchEntity($talent, $this->request->getData());
            if ($this->Talents->save($talent)) {
                $this->Flash->success(__('The talent has been saved.'));

                return $this->redirect(['controller'=>'Talents','action' => 'index']);
            }
            $this->Flash->error(__('The talent could not be saved. Please, try again.'));
        }
        $specialities = $this->Talents->Specialities->find('list', ['limit' => 200]);
        $skillCategories = $this->Talents->SkillCategories->find('list', ['limit' => 200]);
        $this->set(compact('talent', 'specialities', 'skillCategories'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Talent id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $talent = $this->Talents->get($id);
        if ($this->Talents->delete($talent)) {
            $this->Flash->success(__('The talent has been deleted.'));
        } else {
            $this->Flash->error(__('The talent could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller'=>'Talents', 'action' => 'archive_index']);
    }


    public function archive($id = null)
    {
        $talents = $this->Talents->get($id);
        if ($talents == null) {
            throw new NotFoundException();
        }

        // If an article is archived, it is "unpublished" as well
        $talents->archive = true;

        if ($this->Talents->save($talents)) {
            $this->Flash->success(__('Your talent has been archived.'));

        } else {
            $this->Flash->error(__('Unable to archive your talent.'));
        }

        return $this->redirect(['action' => 'index']);

    }


    public function unarchive($id = null)
    {
        $talents = $this->Talents->get($id);
        if ($talents == null) {
            throw new NotFoundException();
        }

        // If an article is archived, it is "unpublished" as well
        $talents->archive = false;

        if ($this->Talents->save($talents)) {
            $this->Flash->success(__('Your talent has been archived.'));

        } else {
            $this->Flash->error(__('Unable to archive your talent.'));
        }

        return $this->redirect(['action' => 'archive_index']);
    }


    public function isAuthorized($user)
    {
        if($this->request->getParam('action')==='view'){
            return true;
        }
        if(in_array($this->request->getParam('action'),['add','delete','archive','archiveIndex'])){
            return parent::isAuthorized($user);
        }

        return true;
    }
}
