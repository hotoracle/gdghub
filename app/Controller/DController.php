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
                    'label' => 'Profiles',
                )
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
            if(!$user){
                  $this->miniFlash('We were unable to locate the selected profile','index');
            }
            $userSkillsets = $this->UsersSkill->getUserSkills($userId);
            $userProjects = $this->Project->getUserProjects($userId, 1);
            $this->set(compact('userSkillsets', 'userProjects', 'user','userId','userInfo'));
            
            
      }
      
      
      
}