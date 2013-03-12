<?php
class ProjectsTechnology extends AppModel{
    
    var $displayField = 'technology_id';
    
    function getProjectTech($projectId=0){
        
        return $this->find('list',array('conditions'=>array( 'ProjectsTechnology.project_id'=>$projectId)));
        
    }
    
    
    
}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
