<?php
class ProjectPhoto extends AppModel{
    
    function getProjectPhotos($projectId=0){
        
        return $this->find('all',array('conditions'=>array('ProjectPhoto.project_id'=>$projectId),'recursive'=>-1,'order'=>'ProjectPhoto.sort_order DESC'));
        
    }
    
    
}
