<?php

class Project extends AppModel{
    
    function getUserProjects($userId=0){
        
            $conditions =  array('Project.created_by'=>$userId);
            return $this->find('all',array('conditions'=>$conditions));
        
            
    }
    
    
    function getUserProject($projectId=0,$userId=0){
        
            $conditions =  array('Project.created_by'=>$userId,'Project.id'=>$projectId);
            return $this->find('first',array('conditions'=>$conditions));
        
            
    }
    
    
    
    
    
}