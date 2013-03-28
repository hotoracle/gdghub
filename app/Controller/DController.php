<?php

/**
  Filename: DController.php 
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Mar 16, 2013  12:21:11 PM
 */

class DController extends AppController{
      
      
       public $uses = array('Project', 'UsersSkill', 'User', 'Skillset', 'Project', 'Technology', 'Category', 'ProjectsTechnology', 'ProjectPhoto');
      
      function beforeFilter(){
            $this->Auth->allow('*');
      }
      
      function index(){
  $breadcrumbLinks = array(
                array(
                    'label' => 'Tech Profiles',
                    'link' => 'index',
                  'separator' => '&raquo;'
                ),
            );
            $this->set(compact('breadcrumbLinks'));
            //I have to find a smart way to do this 16-03-2013
            //@dft
            $conditions = array();
            if(isset($this->params['named']['skill'])){
                  
                  $skillId = $this->params['named']['skill'];
                  
                  $skillSet  = $this->Skillset->read(array('Skillset.id','Skillset.name'),$skillId);
                  $this->set('chosenSkillSet',$skillSet) ;     
                  if($skillSet){
                        $conditions['User.id'] = $this->UsersSkill->listUserIds($skillId);     
                  }
                  
            }
            $users = $this->paginate('User',$conditions);
            $this->set('users',$users);
            $skillsStats  = $this->UsersSkill->listSkillsWithStats();
            $this->set('skillsStats',$skillsStats);

//            pr($skillsStats);
            
      }
      
      function v($userId=0){
            $userInfo = $user = $this->User->getUserInfo($userId);
            if(!$userInfo){
                  $this->miniFlash('We were unable to locate the selected profile','index');
            }
            
            $breadcrumbLinks = array(
                array(
                    'label' => 'Tech Profiles',
                    'link' => 'index',
                  'separator' => '&raquo;'

                ),
                array(
                    'label' => $userInfo['User']['name'],
                    'link' => "v/{$userInfo['User']['id']}",
                    'separator' => '&raquo;'
                ),
            );
            
            $userSkillsets = $this->UsersSkill->getUserSkills($userId);
            $userProjects = $this->Project->getUserProjects($userId, 1);
            $this->set(compact('userSkillsets', 'userProjects', 'user','userId','userInfo','breadcrumbLinks'));
            
            
      }
      function viewProject($userId=0,$projectId = 0) {
            
            $projectInfo = $this->Project->read(null,$projectId);
            
            if(!$projectInfo){
                  $this->miniFlash("Project not found",'index');
            }
            $userInfo = $user = $this->User->getUserInfo($userId);
            if(!$userInfo){
                  $this->miniFlash('We were unable to locate the selected profile','index');
            }
            if($userId!=$projectInfo['Project']['created_by']){
                  $this->miniFlash("I didn't think about everything, but I thought about this. The selected project is owned by another user",'index');
            }
            
            $this->pageTitle='View Project - '.$projectInfo['Project']['name'];
            $projectTechs = $this->ProjectsTechnology->listProjectTech($projectId);
            $projectPhotos = $this->ProjectPhoto->getProjectPhotos($projectId);
            $breadcrumbLinks = array(
                array(
                    'label' => 'Tech Profiles',
                    'link' => 'index',
                  'separator' => '&raquo;'

                ),
                array(
                    'label' => $userInfo['User']['name'],
                    'link' => "v/{$userInfo['User']['id']}",
                    'separator' => '&raquo;'
                ),
                array(
                    'label' => $projectInfo['Project']['name'],
                    'link' => "viewProject/$projectId",
                    'separator'=>'|',
                ),
                
            );
            $userProjects = $this->Project->getUserProjects($userId);
                    
            $this->set(compact('projectInfo', 'projectPhotos', 'projectTechs', 'breadcrumbLinks','userInfo','userProjects','userId','projectId'));
            $this->set('usesLightBox',true);
      }
      
      
}