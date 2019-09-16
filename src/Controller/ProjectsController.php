<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;
use Cake\I18n\Time;
ob_start();
/**
 * Projects Controller
 *
 * @property \App\Model\Table\ProjectsTable $Projects
 *
 * @method \App\Model\Entity\Project[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProjectsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {

        $user_id = $this->Auth->user('talent_id');
        $user_role = $this->Auth->user('role');
        $user_name = $this->Auth->user('username');
        $view_full_project_list = $this->Auth->user('permission_view_full_project_list');
        $view_limited_project_list = $this->Auth->user('permission_view_limited_project_list');
// Auth
        if ($view_limited_project_list == 1 && $view_full_project_list == 0) {
            $this->loadModel('Talent_projects');
            $project = $this->Talent_projects->find('all')->where(['talent_id' => $user_id])->toArray();

            $array = [];
            foreach ($project as $some) {
                $array[] = $some->project_id;
            }
            $this->set("user_role", $user_role);
            $this->set("user_name", $user_name);
            $this->paginate = [
                'contain' => ['Clients', 'Talents']
            ];
            if(empty($array)){
                $projects = $this->paginate($this->Projects->find('all')->where(['Projects.id' => -1])->contain(['Clients', 'Talents']));
            }else{
            $projects = $this->paginate($this->Projects->find('all')->where(['Projects.archive' => 0, 'Projects.id IN' => $array])->contain(['Clients', 'Talents']));
            }
        } else if ($view_full_project_list == 1) {
            $projects = $this->paginate($this->Projects->find('all')->where(['Projects.archive' => 0])->contain(['Clients', 'Talents']));
        } else {
            $projects = $this->paginate($this->Projects->find('all')->where(['Projects.id' => -1])->contain(['Clients', 'Talents']));

        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($this->request->getData()['Progress_Status'] == 1) {
                $projects = $this->Projects->find('all')->where(['AND' => ['Projects.archive' => 0, 'progress_num <' => 100]])->contain(['Clients', 'Talents']);
            } elseif ($this->request->getData()['Progress_Status'] == 2) {
                $projects = $this->Projects->find('all')->where(['AND' => ['Projects.archive' => 0, 'progress_num' => 100]])->contain(['Clients', 'Talents']);
            } elseif ($this->request->getData()['Progress_Status'] == 0) {
                $projects = $this->Projects->find('all')->contain(['Clients', 'Talents']);
            }
        }

        $this->set(compact('projects'));


    }


    public function add()
    {
        $this->loadModel('Clients');
        $project = $this->Projects->newEntity();
        //$clients = $this->Clients->find('all');
        TableRegistry::config('TalentProjects', [
            'table' => 'talent_projects'
        ]);

        $this->loadModel('Talents');


        $clientNames = $this->Clients->find('list', ['keyField' => 'id', 'valueField' => function ($e) {
            return $e->first_name . ' ' . $e->last_name;
        }]);
        $talentNames = $this->Talents->find('list', ['keyField' => 'id', 'valueField' => function ($e) {
            return $e->first_name . ' ' . $e->last_name;
        }]);

        $errorMessage = false;
        if ($this->request->is('post')) {
            //var_dump($this->request->getData());
            if ($this->request->getData()['talent_name'] == '') {
                $errorMessage = true;
                $this->set('errors', 'please choose at least one talent.');
            }
            if ($this->request->getData()['end_date'] != '' && $this->request->getData()['start_date']) {
                if ($this->request->getData()['end_date'] < $this->request->getData()['start_date']) {
                    $this->set('errorDate', 'End date should greater than start date.');
                    $errorMessage = true;
                }
            }
            if ($errorMessage == false) {
                $project = $this->Projects->patchEntity($project, $this->request->getData());

                $project->progress_num = 0;
                $project->progress_status = 'Y';
                if ($this->request->getData()['start_date'] != '') {
                    $project->start_date = $this->request->getData()['start_date'];
                } else {
                    $project->start_date = null;
                }
                if ($this->request->getData()['end_date'] != '') {
                    $project->end_date = $this->request->getData()['end_date'];
                } else {
                    $project->end_date = null;
                }
                $project->client_id = $this->request->getData()['client_name'];

                //var_dump ($this->request->getData()['talent_name']);
                //var_dump($this->request->getData());
                $this->Projects->save($project);


                for ($i = 0; $i < sizeof($this->request->getData()['talent_name']); $i++) {
                    $talentProject = TableRegistry::get('TalentProjects')->newEntity();
                    $talentProject->talent_id = $this->request->getData()['talent_name'][$i];
                    $talentProject->project_id = $project->id;
                    TableRegistry::get('TalentProjects')->save($talentProject);
                }


                return $this->redirect(['controller' => 'tasks', 'action' => 'index', $project->id]);
            }
        }

        $this->set(compact('project', 'clients', 'clientNames', 'talentNames'));

    }

    /**
     * Edit method
     *
     * @param string|null $id Project id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->loadModel('Clients');
        TableRegistry::config('TalentProjects', [
            'table' => 'talent_projects'
        ]);
        $this->loadModel('Talents');


        $project = $this->Projects->get($id, [
            'contain' => ['Talents']
        ]);

        //$startdate=$project->start_date;


        $clientNames = $this->Clients->find('list', ['keyField' => 'id', 'valueField' => function ($e) {
            return $e->first_name . ' ' . $e->last_name;
        }]);
        $talentNames = $this->Talents->find('list', ['keyField' => 'id', 'valueField' => function ($e) {
            return $e->first_name . ' ' . $e->last_name;
        }]);


        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($this->request->getData()['talent_name'] == '') {
                $this->set('errors', 'please choose at least one talent.');
                $errorMessage = true;
            }
            if ($this->request->getData()['end_date'] != '' && $this->request->getData()['start_date']) {
                if ($this->request->getData()['end_date'] < $this->request->getData()['start_date']) {
                    $this->set('errorDate', 'End date should greater than start date.');
                    $errorMessage = true;
                }
            }

            if ($errorMessage == false) {
                $project = $this->Projects->patchEntity($project, $this->request->getData());
                $project->progress_num = $this->request->getData()['progress_num'];

                if ($this->request->getData()['start_date'] != '') {
                    $project->start_date = $this->request->getData()['start_date'];
                } else {
                    $project->start_date = null;
                }
                if ($this->request->getData()['end_date'] != '') {
                    $project->end_date = $this->request->getData()['end_date'];
                } else {
                    $project->end_date = null;
                }

                $project->client_id = $this->request->getData()['client_id'];
                $this->Projects->save($project);

                TableRegistry::get('TalentProjects')->deleteAll(['project_id' => $project->id]);
                for ($i = 0; $i < sizeof($this->request->getData()['talent_name']); $i++) {
                    $talentProject = TableRegistry::get('TalentProjects')->newEntity();
                    $talentProject->talent_id = $this->request->getData()['talent_name'][$i];
                    $talentProject->project_id = $project->id;
                    TableRegistry::get('TalentProjects')->save($talentProject);
                }

                return $this->redirect(['action' => 'index']);
            }

        }

        $selectedTalent = [];
        for ($i = 0; $i < sizeof($project->talents); $i++) {
            array_push($selectedTalent, $project->talents[$i]->id);
        }

        $this->set(compact('project', 'clients', 'clientNames', 'talentNames', 'selectedTalent', 'errorDate'));
    }


    public function updateProgress($projectId, $progressNum)
    {
        $this->autoRender = false;
        $project = $this->Projects->get($projectId);
        $project->progress_num = $progressNum;
        if ($this->Projects->save($project)) {
            $message = "success";
        }
    }

    public function resetProgress($projectId)
    {
        $this->autoRender = false;
        $project = $this->Projects->get($projectId);
        $project->progress_num = 0;
        if ($this->Projects->save($project)) {
            $message = "success";
        }
    }


    /**
     * Delete method
     *
     * @param string|null $id Project id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $project = $this->Projects->get($id);
        if ($this->Projects->delete($project)) {
            $this->Flash->success(__('The project has been deleted.'));
        } else {
            $this->Flash->error(__('The project could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' => 'Projects', 'action' => 'archive_index']);
    }

    public function archiveIndex()
    {
        $this->paginate = [
            'contain' => ['Clients', 'Talents']
        ];
        $projects = $this->paginate($this->Projects->find('all')->where(['Projects.archive' => 1])->contain([]));

        $this->set(compact('projects'));
    }


    public function archive($id = null)
    {
        $projects = $this->Projects->get($id);
        if ($projects == null) {
            throw new NotFoundException();
        }

        // If an article is archived, it is "unpublished" as well
        $projects->archive = 1;

        if ($this->Projects->save($projects)) {
            $this->Flash->success(__('Your project has been archived.'));

        } else {
            $this->Flash->error(__('Unable to archive your project.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function unarchive($id = null)
    {
        $projects = $this->Projects->get($id);
        if ($projects == null) {
            throw new NotFoundException();
        }

        // If an article is archived, it is "unpublished" as well
        $projects->archive = 0;

        if ($this->Projects->save($projects)) {
            $this->Flash->success(__('Your project has been archived.'));

        } else {
            $this->Flash->error(__('Unable to archive your project.'));
        }

        return $this->redirect(['action' => 'archive_index']);
    }


    public function isAuthorized($user)
    {

        if(in_array($this->request->getParam('action'),['add','view','delete','archive','archiveIndex'])){
            $user_id=$this->Auth->user('talent_id');
            $user_role=$this->Auth->user('role');
            $user_name=$this->Auth->user('username');
            if($user_role=='Project Manager'||'Admin'|| 'Superadmin'){
               return true;
            }
        }

        return true;
    }



//    public function isAuthorized($user)
//    {
//        if ($this->request->getParam('action') === "add" && $user['permission_add_project'] == 1) {
//            return true;
//        }
//        if ($this->request->getParam('action') === "delete" && $user['permission_delete_project'] == 1) {
//            return true;
//        }
//        if ($this->request->getParam('action') === "index" && ($user['permission_view_full_project_list'] == 1 || $user['permission_view_limited_project_list'] == 1)) {
//            return true;
//        }
//        if ($this->request->getParam('action') === "archive" && $user['permission_archive_project'] == 1) {
//            return true;
//        }
//        if ($this->request->getParam('action') === "unarchive" && $user['permission_unarchive_project'] == 1) {
//            return true;
//        }
//        if ($this->request->getParam('action') === "archiveIndex" && $user['permission_view_archive_project_list'] == 1) {
//            return true;
//        }
//
//        if (in_array($this->request->getParam('action'), ['view', 'edit']) && ($user['permission_view_full_project_list'] == 1)) {
//            return true;
//
//
//        }
//
//
//        if (in_array($this->request->getParam('action'), ['view', 'edit']) && ($user['permission_view_limited_project_list'] == 1)) {
//            $this->loadModel('Talent_projects');
//            $user_id = $user['id'];
//            $projectId = (int)$this->request->getParam('pass.0');
//            $project = $this->Talent_projects->find('all')->where(['talent_id' => $user_id])->toArray();
//
//            $array = [];
//            foreach ($project as $some) {
//                $array[] = $some->project_id;
//            }
//            foreach ($array as $aaa) {
//                if ($aaa == $projectId) {
//                    return true;
//                }
//            }
//
//        }
//        return false;
//
//
//    }
}

