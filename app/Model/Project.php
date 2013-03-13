<?php

class Project extends AppModel{
    
      public $hasMany= array('ProjectPhoto','ProjectsTechnology');
      
    function getUserProjects($userId=0,$recursive = 0){
        
            $conditions =  array('Project.created_by'=>$userId);
            $results =  $this->find('all',array('conditions'=>$conditions,'recursive'=>$recursive));
//            if($includePhoto){
//                
//                  foreach($results as $index=>$project){
//                        $mainPhoto = $this->ProjectPhoto->find('first',array('conditions'=>array('ProjectPhoto.project_id'=>$project['Project']['id']),'recursive'=>-1));
//                        if(!$mainPhoto) continue;
//                        $results[$index]['MainPhoto'] = $mainPhoto['ProjectPhoto'];
//
//                  }
//            }
//            if($includeTech){
//                
//                  foreach($results as $index=>$project){
//                        $projectTechs = $this->ProjectsTechnology->listProjectTech($project['Project']['id']);
//                        $results[$index]['ProjectsTechnology'] =$projectTechs;
//
//                  }
//            }
//            
        return $results;
            
    }
    function countUserProjects($userId=0){
        
            $conditions =  array('Project.created_by'=>$userId);
            return $this->find('count',array('conditions'=>$conditions));
        
            
    }
    
    
    function getUserProject($projectId=0,$userId=0){
        
            $conditions =  array('Project.created_by'=>$userId,'Project.id'=>$projectId);
            return $this->find('first',array('conditions'=>$conditions));
        
            
    }
    
    
    
    
    
}