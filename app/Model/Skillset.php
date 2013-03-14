<?php
App::uses('AppModel', 'Model');
/**
 * Skillset Model
 *
 * @property Skillset $ParentSkillset
 * @property Skillset $ChildSkillset
 * @property User $User
 */
class Skillset extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'ParentSkillset' => array(
			'className' => 'Skillset',
			'foreignKey' => 'parent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'ChildSkillset' => array(
			'className' => 'Skillset',
			'foreignKey' => 'parent_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'User' => array(
			'className' => 'User',
			'joinTable' => 'users_skillsets',
			'foreignKey' => 'skillset_id',
			'associationForeignKey' => 'user_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);
      function listSkillsByName(){
              return array_values($this->find('list',array('order'=>'Skillset.name')));
        }
        function getSkillId($skill=''){
                $skill = trim($skill);
                $conditions = array('Skillset.name'=>$skill);
                $this->recursive = -1;
                return $this->field('Skillset.id',$conditions);
                
        }
        
}
//87c35d8a-23d4-11e2-a5fb-7f3382f33e5b
//f4a62706-30f0-11e2-9c12-4ad347e9b9e2
