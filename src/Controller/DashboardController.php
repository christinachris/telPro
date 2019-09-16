<?php
namespace App\Controller;
use Cake\I18n\Time;
use App\Controller\AppController;
ob_start();
class DashboardController extends AppController {

    var $name = 'Dashboard';
    var $uses = array();

    function index () {
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
        $latestMonth=[];

        for($i=0;$i<12;$i++){
            if($i==0){
                array_unshift($latestMonth,$now->year.' Dec');
            }
            if($i==1){
                array_unshift($latestMonth,$now->year.' Nov');
            }
            if($i==2){
                array_unshift($latestMonth,$now->year.' Oct');
            }
            if($i==3){
                array_unshift($latestMonth,$now->year.' Sep');
            }
            if($i==4){
                array_unshift($latestMonth,$now->year.' Aug');
            }
            if($i==5){
                array_unshift($latestMonth,$now->year.' Jul');
            }
            if($i==6){
                array_unshift($latestMonth,$now->year.' Jun');
            }
            if($i==7){
                array_unshift($latestMonth,$now->year.' May');
            }
            if($i==8){
                array_unshift($latestMonth,$now->year.' Apr');
            }
            if($i==9){
                array_unshift($latestMonth,$now->year.' Mar');
            }
            if($i==10){
                array_unshift($latestMonth,$now->year.' Feb');
            }
            if($i==11){
                array_unshift($latestMonth,$now->year.' Jan');
            }

        }

       /* for($i=0;$i<12;$i++){
            if($now->month==1){
                array_unshift($latestMonth,$now->year.' Jan');
                //$now=$now->modify('-1 month');
            }
            elseif ($now->month==2){
                array_unshift($latestMonth,$now->year.' Feb');
                //$now=$now->modify('-1 month');
            }
            elseif ($now->month==3){
                array_unshift($latestMonth,$now->year.' Mar');
                //$now=$now->modify('-1 month');
            }
            elseif ($now->month==4){
                array_unshift($latestMonth,$now->year.' Apr');
                //$now=$now->modify('-1 month');
            }
            elseif ($now->month==5){
                array_unshift($latestMonth,$now->year.' May');
                //$now=$now->modify('-1 month');
            }
            elseif ($now->month==6){
                array_unshift($latestMonth,$now->year.' Jun');
               // $now=$now->modify('-1 month');
            }
            elseif ($now->month==7){
                array_unshift($latestMonth,$now->year.' Jul');
                //$now=$now->modify('-1 month');
            }
            elseif ($now->month==8){
                array_unshift($latestMonth,$now->year.' Aug');
               // $now=$now->modify('-1 month');
            }
            elseif ($now->month==9){
                array_unshift($latestMonth,$now->year.' Sep');
                //$now=$now->modify('-1 month');
            }
            elseif ($now->month==10){
                array_unshift($latestMonth,$now->year.' Oct');
                //$now=$now->modify('-1 month');
            }
            elseif ($now->month==11){
                array_unshift($latestMonth,$now->year.' Nov');
                //$now=$now->modify('-1 month');
            }
            elseif ($now->month==12){
                array_unshift($latestMonth,$now->year.' Dec');
                //$now=$now->modify('-1 month');
            }
        }*/

        $this->set('latestMonth',$latestMonth);
        //$nowDiff=Time::now()->day;
        $nowDiff=Time::now()->month;
        $nowYear=Time::now()->year;
		$totalProjectsYear=0;

        for($i=0;$i<sizeof($totalProjects);$i++){
            $projectTime= new Time($totalProjects[$i]['start_date']);
            $projectMonth = $projectTime->month;
            $projectYear= $projectTime->year;
            if(($projectYear==$nowYear)&&($projectMonth==1)){
                $newProjects[0]++;
				$totalProjectsYear++;
            }
            if(($projectYear==$nowYear)&&($projectMonth==2)){
                $newProjects[1]++;
				$totalProjectsYear++;
            }
            if(($projectYear==$nowYear)&&($projectMonth==3)){
                $newProjects[2]++;
				$totalProjectsYear++;
            }
            if(($projectYear==$nowYear)&&($projectMonth==4)){
                $newProjects[3]++;
				$totalProjectsYear++;
            }
            if(($projectYear==$nowYear)&&($projectMonth==5)){
                $newProjects[4]++;
				$totalProjectsYear++;
            }
            if(($projectYear==$nowYear)&&($projectMonth==6)){
                $newProjects[5]++;
				$totalProjectsYear++;
            }
            if(($projectYear==$nowYear)&&($projectMonth==7)){
                $newProjects[6]++;
				$totalProjectsYear++;
            }
            if(($projectYear==$nowYear)&&($projectMonth==8)){
                $newProjects[7]++;
				$totalProjectsYear++;
            }
            if(($projectYear==$nowYear)&&($projectMonth==9)){
                $newProjects[8]++;
				$totalProjectsYear++;
            }
            if(($projectYear==$nowYear)&&($projectMonth==10)){
                $newProjects[9]++;
				$totalProjectsYear++;
            }
            if(($projectYear==$nowYear)&&($projectMonth==11)){
                $newProjects[10]++;
				$totalProjectsYear++;
            }
            if(($projectYear==$nowYear)&&($projectMonth==12)){
                $newProjects[11]++;
				$totalProjectsYear++;
            }

           /* if(!((strtotime(Time::now())-strtotime($totalProjects[$i]['start_date']))==0)&&((strtotime(Time::now())-strtotime($totalProjects[$i]['start_date']))/86400<=365)){
                if((strtotime(Time::now())-strtotime($totalProjects[$i]['start_date']))/86400<$nowDiff){
                    $newProjects[11]++;

                }
                elseif((strtotime(Time::now())-strtotime($totalProjects[$i]['start_date']))/86400<(30+$nowDiff)){
                    $newProjects[10]++;

                }
                elseif((strtotime(Time::now())-strtotime($totalProjects[$i]['start_date']))/86400<(61+$nowDiff)){
                    $newProjects[9]++;
                }
                elseif((strtotime(Time::now())-strtotime($totalProjects[$i]['start_date']))/86400<(92+$nowDiff)){
                    $newProjects[8]++;
                }
                elseif((strtotime(Time::now())-strtotime($totalProjects[$i]['start_date']))/86400<(122+$nowDiff)){
                    $newProjects[7]++;
                }
                elseif((strtotime(Time::now())-strtotime($totalProjects[$i]['start_date']))/86400<(153+$nowDiff)){
                    $newProjects[6]++;
                }
                elseif((strtotime(Time::now())-strtotime($totalProjects[$i]['start_date']))/86400<(183+$nowDiff)){
                    $newProjects[5]++;
                }
                elseif(strtotime(Time::now())-strtotime($totalProjects[$i]['start_date'])/86400<(214+$nowDiff)){
                    $newProjects[4]++;
                }
                elseif(strtotime(Time::now())-strtotime($totalProjects[$i]['start_date'])/86400<(244+$nowDiff)){
                    $newProjects[3]++;
                }
                elseif((strtotime(Time::now())-strtotime($totalProjects[$i]['start_date']))/86400<(275+$nowDiff)){
                    $newProjects[2]++;
                }
                elseif((strtotime(Time::now())-strtotime($totalProjects[$i]['start_date']))/86400<(305+$nowDiff)){
                    $newProjects[1]++;
                }
                elseif((strtotime(Time::now())-strtotime($totalProjects[$i]['start_date']))/86400<=(336+$nowDiff)){
                    $newProjects[0]++;
                }
            }*/
        }
		
		//new projects per month
		$aveProjectsMonth=$totalProjectsYear/12;
		$this->set('aveProjectsMonth',$aveProjectsMonth);

        $this->set('newProjects',$newProjects);
    }
}