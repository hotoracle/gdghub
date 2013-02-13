<?php
App::uses('AppModel', 'Model');
/**
 * QuestionComment Model
 *
 * @property QuestionComment $QuestionComment
 * @property User $User
 * @property Question $Question
 * @property QcVote $QcVote
 * @property QuestionComment $QuestionComment
 */
class QuestionComment extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'QuestionComment' => array(
			'className' => 'QuestionComment',
			'foreignKey' => 'question_comment_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Question' => array(
			'className' => 'Question',
			'foreignKey' => 'question_id',
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
		'QcVote' => array(
			'className' => 'QcVote',
			'foreignKey' => 'question_comment_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'QuestionComment' => array(
			'className' => 'QuestionComment',
			'foreignKey' => 'question_comment_id',
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

}
