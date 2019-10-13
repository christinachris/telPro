<?php
namespace App\Controller;
use Cake\I18n\Time;
use App\Controller\AppController;
ob_start();
class DashboardController extends AppController {

    var $name = 'Dashboard';
    var $uses = array();

    function index () {
        $this->loadModel('Tasks');
        $this->loadModel('Projects');
        $talent_id = $this->Auth->user('talent_id');
        $allArchPro=$this->Projects->find()->where(['archive'=>1])->select('id')->toList();
        $allArchIDs=[];
        foreach ($allArchPro as $allProj){
            array_push($allArchIDs,$allProj['id']);
        }
       // var_dump($allArchIDs);
        $unFinishedTsk2=$this->Tasks->find('all',['conditions'=>[['AND'=>['allocated_talent'=>$talent_id],['status_id'=>2],['project_id NOT IN'=>$allArchIDs]]],'order'=>['due_date DESC']])->toList();
        $unFinishedTsk1=$this->Tasks->find('all',['conditions'=>['AND'=>['allocated_talent'=>$talent_id],['status_id'=>1],['project_id NOT IN'=>$allArchIDs]],'order'=>['due_date DESC']])->toList();

        $this->set('unFinishedTsk2',$unFinishedTsk2);
        $this->set('unFinishedTsk1',$unFinishedTsk1);


        $this->loadModel('Notes');

        if(sizeOf($this->Notes->find()->where(['talent_id'=>$talent_id])->limit(1)->toList())==0){
            $notes = $this->Notes->newEntity();
            $this->set('notes',$notes);
        }
        else{
            $notes = $this->Notes->find()->where(['talent_id'=>$talent_id])->limit(1)->toList()[0];
            $this->set('notes',$notes);
        }


        if ($this->request->is(['patch', 'post', 'put'])) {

            $notes->note_desc=$this->request->getData()['note_desc'];
            $notes->talent_id=$talent_id;
            $notes->modify_date=Time::now();
            if($this->Notes->save($notes)){
                $this->Flash->success(__("Your personal notes has been saved successfully."));
            }
            else{
                $this->Flash->error(__('Your personal notes could not be saved. Please, try again.'));
            }
            return $this->redirect(['action' => 'index']);
        }

        $this->loadModel('Mentions');
        $mentions=$this->Mentions->find('all',['conditions'=>['AND'=>['talent_id'=>$talent_id],['viewed'=>0]],'order'=>['mention_date DESC']])->toList();
        $this->set('mentions',$mentions);

        $this->loadModel('Talents');
        $totalTalents=$this->Talents->find('all')->toList();
        $this->set('totalTalents',sizeof($totalTalents));

        $this->loadModel('Clients');
        $totalClients=$this->Clients->find('all')->toList();
        $this->set('totalClients',sizeof($totalClients));

        $this->loadModel('Projects');
        $totalProjects=$this->Projects->find('all')->toList();
        $this->set('totalProjects',sizeof($totalProjects));
        $totalArchives=$this->Projects->find('all',['conditions'=>['archive'=>1]])->toList();
        $this->set('totalArchives',sizeof($totalArchives));
        $totalUnarchives=$this->Projects->find('all',['conditions'=>['archive'=>0]])->toList();
        $this->set('totalUnarchives',sizeof($totalUnarchives));

        $completedProgress=$this->Projects->find('all',['conditions'=>['progress_num'=>100, 'archive'=>0]])->toList();
        $this->set('completedProgress',sizeof($completedProgress));

        $notCompletedProgress=$this->Projects->find('all',['conditions'=>['progress_num < '=>100, 'archive'=>0]])->toList();
        $this->set('notCompletedProgress',sizeof($notCompletedProgress));

        $this->loadModel('SkillCategories');
        $totalSkillCate=$this->SkillCategories->find('all');
        $numberOfSkillCate=array_fill(0, sizeOf($totalSkillCate->toList()), 0);
        $skillCateName=[];
        foreach($totalSkillCate as $totalSkillCates){
            array_push($skillCateName,$totalSkillCates['name']);
        }
        $this->set('skillCateName',$skillCateName);
        for($i=0;$i<sizeof($totalTalents);$i++){
            if(!($totalTalents[$i]['skill_categories_id']==null)){
                $numberOfSkillCate[$totalTalents[$i]['skill_categories_id']-1]+=1;
            }

        }
        $this->set('numberOfSkillCate',$numberOfSkillCate);

        $now=Time::now();
        $newProjects=array_fill(0, 12, 0);
        //$chartProjects=array_fill(3,12,0);
        $latestMonth=[];
        $lastMon=0;

        for ($i =11; $i >= 0; $i--) {
            $latestMonth[] = date("Y M", strtotime( date( 'Y-m-01' )." -$i months"));
        }
        $this->set('latestMonth',$latestMonth);
        //$nowDiff=Time::now()->day;
        $nowMonth=Time::now()->month;
        $nowYear=Time::now()->year;
        $totalProjectsYear=0;

        for($i=0;$i<sizeof($totalProjects);$i++){
            $projectTime= new Time($totalProjects[$i]['start_date']);
            $projectMonth = $projectTime->month;
            $projectYear= $projectTime->year;
            $nowNextMonFirDay=date('Y-m-d', strtotime(date('Y-m-01', strtotime(Time::now())) . ' +1 month'));

            //interval months between this month and the month when the project starts
            $intervalMonths=abs(date("Y",strtotime(Time::now()))-date("Y",strtotime($projectTime)))*12+date("m",strtotime(Time::now()))-date("m",strtotime($projectTime));

            if((strtotime($nowNextMonFirDay)-strtotime($totalProjects[$i]['start_date']))>0&&((strtotime($nowNextMonFirDay)-strtotime($totalProjects[$i]['start_date']))/86400<=365)){
                if((($intervalMonths)<=0)){
                    $newProjects[11]++;

                }
                elseif(($intervalMonths==1)){
                    $newProjects[10]++;

                }
                elseif(($intervalMonths==2)){
                    $newProjects[9]++;
                }
                elseif(($intervalMonths==3)){
                    $newProjects[8]++;
                }
                elseif(($intervalMonths==4)){
                    $newProjects[7]++;
                }
                elseif(($intervalMonths==5)){
                    $newProjects[6]++;
                }
                elseif(($intervalMonths==6)){
                    $newProjects[5]++;
                }
                elseif(($intervalMonths==7)){
                    $newProjects[4]++;
                }
                elseif(($intervalMonths==8)){
                    $newProjects[3]++;
                }
                elseif(($intervalMonths==9)){
                    $newProjects[2]++;
                }
                elseif(($intervalMonths==10)){
                    $newProjects[1]++;
                }
                elseif(($intervalMonths==11)){
                    $newProjects[0]++;
                }
            }
        }

        //new projects per month
        $aveProjectsMonth=$totalProjectsYear/12;
        $this->set('aveProjectsMonth',$aveProjectsMonth);

        $this->set('newProjects',$newProjects);
        //$this->set('chartProjects',$chartProjects);

        $this->loadModel('Notes');
        $errorMessage=false;
        if ($this->request->is(['patch', 'post', 'put'])) {
            //$noteWord= theEditor.plugins.wordcount.getCount();
            if(strlen($this->request->getData()['note_desc'])>4000){
                $this->set('errors','Characters exceed the upper limit');
                $errorMessage=true;
            }
        }
    }
}
