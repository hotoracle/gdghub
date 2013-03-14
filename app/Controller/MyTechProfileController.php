<?php

/**
  Filename: MyTechProfileController.php
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Mar 10, 2013  11:49:06 AM
 */
class MyTechProfileController extends AppController {

      public $uses = array('Project', 'UsersSkill', 'User', 'Skillset', 'Project', 'Technology', 'Category', 'ProjectsTechnology', 'ProjectPhoto','SkillsetSubmission');

      public function index() {
            /** Show the users dashboard the same way the general public sees it */
            $userSkillsets = $this->UsersSkill->getUserSkills($this->_thisUserId);
            $pendingSkillsets = $this->SkillsetSubmission->getPendingUserSubmissions($this->_thisUserId);
            $myProjects = $this->Project->getUserProjects($this->_thisUserId,1);
            $this->set(compact('userSkillsets', 'myProjects','pendingSkillsets'));
      }

      public function editSkills() {
            $breadcrumbLinks = array(
                array(
                    'label' => 'My Dashboard',
                    'link' => 'index'
                ),
                
                array(
                    'label' => 'Edit Skills',
                )
            );
             $this->set(compact('breadcrumbLinks'));
            $this->set('usesAutocomplete',true);

             $rules = array(
                 'Skills'=>array(
                     'selSkills'=>array(
                         FV_REQUIRED=>'You must specify at least one skill here to submit'
                     )
                 )
             )     ;
             $this->FormValidator->setRules($rules);
             
            if (!empty($this->data) && $this->FormValidator->validate()) {
                  App::uses('Sanitize', 'Utility');

                  
                  $submittedSkillsets = $this->data['Skills']['selSkills'];
                  
                  $skillsProvided = explode(',', $submittedSkillsets);
                  $skillIds = array();
                  $selectedSkilllSets  = $unidentifiedSkills = array();
                  foreach ($skillsProvided as $skill) {

                        $skill = Sanitize::paranoid($skill,array(' ','.','(',')','-','_'));
                        $skill = trim($skill);
                        if(!$skill) continue;
                        $skillId  = $this->Skillset->getSkillId($skill);
                        if(!$skillId){
                              $unidentifiedSkills[] = $skill;
                              $data = array(
                                  'name'=>$skill,
                                  'user_id'=>$this->_thisUserId
                              );
                              $this->SkillsetSubmission->addSubmission($data);
                              continue;
                        }
                        $selectedSkilllSets[] = $skillId;
                  }

                  
                  
                  foreach ($selectedSkilllSets as $skillsetId) {
                        if (!$skillsetId)
                              continue;

                        $data = array(
                            'user_id' => $this->_thisUserId,
                            'skillset_id' => $skillsetId
                        );
                        if ($this->UsersSkill->field('skillset_id', $data)) {
                              continue; //already created
                        }
                        $this->UsersSkill->create($data);
                        $this->UsersSkill->save($data);
                  }
                  $message = 'Skills Updated';
                  if($unidentifiedSkills){
                        $unidentifiedSkills=join('<br /> - ',$unidentifiedSkills);
                        $message.="<br />However, the following skills were not recognized and will be reviewed by our team prior to approval: <br /> - $unidentifiedSkills";
                  }
                        
                  $this->miniFlash($message, 'index');
            }

            
            $possibleSkills = $this->Skillset->listSkillsByName();
            
            $this->set('possibleSkills',$possibleSkills);
            
            $mySkillSets = $this->UsersSkill->getUserSkills($this->_thisUserId);

            $this->set('mySkillSets', $mySkillSets);
      }

      public function addProject() {
            $breadcrumbLinks = array(
                array(
                    'label' => 'My Dashboard',
                    'link' => 'index'
                ),
             
                array(
                    'label' => 'Post New Project',
                )
            );
             $this->set(compact('breadcrumbLinks'));
            
            $totalProjects = $this->Project->countUserProjects($this->_thisUserId);
            if($totalProjects>=cRead('Application.upload.max_projects')){
                  $this->miniFlash("You have already added the maximum of $totalProjects projects on this platform",'index');
            }
            
            $rules = array('Project' => array(
                    'name' => array(
                        FV_REQUIRED => 'Missing Project Name',
                        FV_MAX_LENGTH => array('error' => 'The name of your project is too long!', 'param' => 200)
                    ),
                    'description' => array(
                        FV_REQUIRED => 'Please provide a description for this project',
                        FV_MIN_LENGTH => array('error' => 'Please provide a longer description for this project', 'param' => 100),
                    ),
                    'category_id' => array(
                        FV_REQUIRED => 'Missing Project Category. Please choose the most relevant category for your project',
                    ),
                )
            );


            $this->FormValidator->setRules($rules);
            $technologies = array(
                'id' => '0',
                'name' => '-',
                'children' => $this->Technology->getChildrenTree(NULL)
            );

            $categories = $this->Category->find('list', array('order' => 'name'));

            $this->set('technologies', $technologies);
            $this->set('categories', $categories);
            if ($this->FormValidator->validate()) {


                  $submittedProjectData = $this->data['Project'];
                  $projectUrl = '';
                        if($submittedProjectData['project_url']){
                              if (filter_var($submittedProjectData['project_url'], FILTER_VALIDATE_URL) !== false) {
                                    $projectUrl  = $submittedProjectData['project_url'];
                              }
                        }
                  $projectData = array(
                      'name' => $submittedProjectData['name'],
                      'description' => $submittedProjectData['description'],
                      'project_url' =>$projectUrl,
                      'category_id' => $submittedProjectData['category_id'],
                      'created_by' => $this->_thisUserId,
                  );

                  $selectedTech = array();

                  if (isset($this->data['technologies']) && is_array($this->data['technologies'])) {

                        $selectedTech = array_unique(array_values($this->data['technologies']));
                  }


                  $zeroTech = array_search(0, $selectedTech);

                  if ($zeroTech !== false) {
                        unset($selectedTech[$zeroTech]);
                  }

                  if (!$selectedTech) {

                        $this->sFlash('Please select at least one technology for this project', true);
                        return;
                  }


                  $this->Project->create($projectData);
                  if (!$this->Project->save($projectData)) {


                        $this->sFlash('An unexpected error occurred while trying to save this project. Please try again later', true);
                        return;
                  }

                  $projectId = $this->Project->id;
                  $techSelections = array();

                  foreach ($selectedTech as $technologyId) {
                        if (!$technologyId)
                              continue;
                        $techSelections[] = array(
                            'project_id' => $projectId,
                            'technology_id' => $technologyId,
                        );
                  }


                  $this->ProjectsTechnology->saveAll($techSelections);

                  $this->miniFlash("Project Saved. Use the form below to add photos", "viewProject/$projectId");
            }
      }

      function _getUserProject($projectId) {

            $projectInfo = $this->Project->getUserProject($projectId, $this->_thisUserId);

            if (!$projectInfo) {

                  $this->miniFlash('Unable to find selected project', 'index');
            }
            $this->set(compact('projectInfo', 'projectId'));
            return $projectInfo;
      }

      function viewProject($projectId = 0) {
            $projectInfo = $this->_getUserProject($projectId);
            $projectTechs = $this->ProjectsTechnology->listProjectTech($projectId);
            $projectPhotos = $this->ProjectPhoto->getProjectPhotos($projectId);
             $breadcrumbLinks = array(
                array(
                    'label' => 'My Dashboard',
                    'link' => 'index'
                ),
                array(
                    'label' => $projectInfo['Project']['name'],
                    'link' => "viewProject/$projectId",
                    'separator' => '||||'
                ),
                array(
                    'label' => 'Post New Project',
                    'link' => 'addProject',
                )
            );
             $this->set(compact('projectInfo','projectPhotos','projectTechs','breadcrumbLinks'));
      
            if (count($projectPhotos) < cRead('Application.upload.max_project_photos') && !empty($this->data) && isset($this->data['ProjectPhoto']['upload'])) {
                  $imagesSaved = 0;
                  $photoFields = array_key_exists('photos', $this->data) ? $this->data['photos'] : array();

                  //@TODO handle with a component which can resize uploads too.
                  foreach ($photoFields as $photoField) {
                        if (!is_array($photoField))
                              continue;
                        if ($photoField['error'] != 0) {
                              continue;
                        }
                        if (stripos($photoField['type'], 'image') === false) {

                              //Not an image type
                              continue;
                        }
                        if (!getimagesize($photoField['tmp_name'])) {
                              //Not a jpg image type
                              continue;
                        }
                        if (!isset($photoField['name']))
                              continue;
                        $fileParts = explode('.', $photoField['name']);

                        if (count($fileParts) < 2)
                              continue;

//                $fileExtension = $fileParts[count($fileParts)-1];
                        $fileExtension = array_pop($fileParts);

                        $destinationImg = str_replace('-', '_', $projectId) . '_' . uniqid() . ".$fileExtension";

                        $photoDir = cRead('Application.upload.abs_projects');
                        if (!file_exists($photoDir)) {
                              if (!mkdir($photoDir, 0777, true)) {
                                    $this->sFlash("Insufficient Permissions while trying to create $photoDir", true);
                                    return;
                              }
                        }

                        @move_uploaded_file($photoField['tmp_name'], $photoDir . DS . $destinationImg);
                        $data = array(
                            'ProjectPhoto' => array(
                                'name' => $photoField['name'],
                                'project_id' => $projectId,
                                'user_id' => $this->_thisUserId,
                                'pic_url' => $destinationImg,
                            )
                        );

                        $this->ProjectPhoto->create($data);
                        $this->ProjectPhoto->save($data);
                        $imagesSaved++;
                  }

                  $this->miniFlash("Images Saved: {$imagesSaved}", "viewProject/$projectId");
            }
      }

      function editProject($projectId = 0) {
            
            $projectInfo = $this->_getUserProject($projectId);
            $this->set('projectInfo', $projectInfo);
            
            $breadcrumbLinks = array(
                array(
                    'label' => 'My Dashboard',
                    'link' => 'index'
                ),
                array(
                    'label' => $projectInfo['Project']['name'],
                    'link' => "viewProject/$projectId",
                    'separator' => '||||'
                ),
                array(
                    'label' => 'Post New Project',
                    'link' => 'addProject',
                )
            );
            
            $this->set(compact('breadcrumbLinks'));
            
            $currentTechs = $this->ProjectsTechnology->getProjectTech($projectId);

            $rules = array('Project' => array(
                    'name' => array(
                        FV_REQUIRED => 'Missing Project Name',
                        FV_MAX_LENGTH => array('error' => 'The name of your project is too long!', 'param' => 200)
                    ),
                    'description' => array(
                        FV_REQUIRED => 'Please provide a description for this project',
                        FV_MIN_LENGTH => array('error' => 'Please provide a longer description for this project', 'param' => 100),
                    ),
                    'category_id' => array(
                        FV_REQUIRED => 'Missing Project Category. Please choose the most relevant category for your project',
                    ),
                )
            );


            $this->FormValidator->setRules($rules);



            if (!empty($this->data)) {

                  if ($this->FormValidator->validate()) {


                        $submittedProjectData = $this->data['Project'];
                        $projectUrl = '';
                        if($submittedProjectData['project_url']){
                              if (filter_var($submittedProjectData['project_url'], FILTER_VALIDATE_URL) !== false) {
                                    $projectUrl  = $submittedProjectData['project_url'];
                              }
                        }
                  
                        $projectData = array(
                            'name' => $submittedProjectData['name'],
                            'description' => $submittedProjectData['description'],
                            'project_url' => $projectUrl,
                            'category_id' => $submittedProjectData['category_id'],
                            'created_by' => $this->_thisUserId,
                        );

                        $selectedTech = array();

                        if (isset($this->data['technologies']) && is_array($this->data['technologies'])) {
                              $selectedTech = array_unique(array_values($this->data['technologies']));
                        }



                        $zeroTech = array_search(0, $selectedTech);

                        if ($zeroTech !== false) {
                              unset($selectedTech[$zeroTech]);
                        }

                        if (!$selectedTech) {

                              $this->sFlash('Please select at least one technology for this project', true);
                              return;
                        }

                        $techSelections = array();

                        foreach ($selectedTech as $technologyId) {
                              if (!in_array($technologyId, $currentTechs)) {
                                    if (!$technologyId)
                                          continue;
                                    $techSelections[] = array(
                                        'project_id' => $projectId,
                                        'technology_id' => $technologyId,
                                    );
                              }
                        }

                        $deselectedTechs = array();

                        foreach ($currentTechs as $projectTechId => $technologyId) {
                              if (!in_array($technologyId, $selectedTech)) {
                                    $deselectedTechs[] = $projectTechId;
                              }
                        }

                        $this->Project->id = $projectId;
                        $this->Project->save($projectData);

                        if ($deselectedTechs) {

                              $this->ProjectsTechnology->deleteAll(array('ProjectsTechnology.project_id' => $projectId, 'ProjectsTechnology.id' => $deselectedTechs));
                        }

                        $this->ProjectsTechnology->saveAll($techSelections);

                        $this->miniFlash('Changes to Project saved', "viewProject/$projectId");
                  } else {

                        $this->sFlash("Unable to save", true);
                  }
            } else {

                  $this->data = $projectInfo;
            }

            $technologies = array(
                'id' => '0',
                'name' => '-',
                'children' => $this->Technology->getChildrenTree(NULL)
            );


            $categories = $this->Category->find('list', array('order' => 'name'));

            $this->set('technologies', $technologies);
            $this->set('categories', $categories);
            $this->set('currentTechs', $currentTechs);
      }

      public function deleteProjectPhoto($projectId = 0, $photoId = 0) {
            $projectInfo = $this->_getUserProject($projectId);
            $projectPhoto = $this->ProjectPhoto->read('ProjectPhoto.project_id', $photoId);
            if (!$projectPhoto) {
                  $this->sFlash("Unable to find selected photo", true);
                  $this->redirect("viewProject/$projectId");
            }
            if ($projectPhoto['ProjectPhoto']['project_id'] != $projectId) {
                  $this->sFlash("Unable to find selected photo", true);
                  $this->redirect("viewProject/$projectId");
            }
            $this->ProjectPhoto->delete($photoId);
            $this->miniFlash("Photo Deleted", "viewProject/$projectId", true);
      }
      
      public function removeSkill($skillId=0) {
      
            if(!$this->Skillset->exists($skillId)){
                  $this->miniFlash('Not found', 'editSkills');
            }
            
            $this->UsersSkill->removeSkill($this->_thisUserId,$skillId);
            $this->miniFlash('Skills Updated', 'editSkills');


      }
      public function editProfile() {
            
            $userInfo = $this->User->getUserInfo($this->_thisUserId);
            pr($userInfo);

      }

      
}