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
            $users = $this->paginate('User');
            $this->set('users',$users);
            
            
      }
      
      function v($userId=0){
            $user = $this->User->getUserInfo($userId);
            if(!$user){
                  $this->miniFlash('We were unable to locate the selected profile','index');
            }
            $userSkillsets = $this->UsersSkill->getUserSkills($userId);
            $userProjects = $this->Project->getUserProjects($userId, 1);
            $this->set(compact('userSkillsets', 'userProjects', 'user','userId'));
            
            
      }
      
      
      
}