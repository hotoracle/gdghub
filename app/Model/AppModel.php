<?php
 

App::uses('Model', 'Model');

 
class AppModel extends Model {
        
        
        
        function extractKeys($data){
                
                $keys = array();
                foreach($data as $row){
                        
                        if(isset($row[$this->alias][$this->primaryKey])){
                                $keys[] = $row[$this->alias][$this->primaryKey];
                        }
                        
                }
                return $keys;
        }
        
        function getChildrenTree($parentId, $results = array()) {

                $thisModel = $this->name;
                $order  = array();
                if($this->hasField('name')){
                        $order = "{$this->name}.name";
                }
                $results = $this->find('all', array('order'=>$order, 'conditions' => array("{$thisModel}.parent_id" => $parentId)));

                foreach ($results as $key => $row) {

                        $results[$key]['children'] = $this->getChildrenTree($row["$thisModel"]['id'], $results[$key]);
                }

                return $results;
        }
}
