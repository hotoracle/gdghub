<?php
App::uses('AppModel', 'Model');
/**
 * QcVote Model
 *
 * @property User $User
 * @property QuestionComment $QuestionComment
 */
class QcVote extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'QuestionComment' => array(
			'className' => 'QuestionComment',
			'foreignKey' => 'question_comment_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
