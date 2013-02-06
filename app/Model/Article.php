<?php

App::uses('AppModel', 'Model');

/**
 * Article Model
 *
 * @property Feed $Feed
 */
class Article extends AppModel {

        /**
         * Display field
         *
         * @var string
         */
        public $displayField = 'name';
        public $actsAs =array('Sluggable'=>array('label'=>'name','overwrite'=>true))      ;


        //The Associations below have been created with all possible keys, those that are not needed can be removed

        /**
         * belongsTo associations
         *
         * @var array
         */
        public $belongsTo = array(
            'Feed' => array(
                'className' => 'Feed',
                'foreignKey' => 'feed_id',
                'conditions' => '',
                'fields' => '',
                'order' => ''
            )
        );

        function createArticle($feedId, $feedInfo) {

                $slug = Inflector::slug($feedId . '_' . $feedInfo['name']);

                $existingArticle = $this->findBySlug($slug);
                if ($existingArticle)
                        return $existingArticle['Article']['id'];

                $feedInfo['feed_id'] = $feedId;

                $this->create($feedInfo);
                $this->save($feedInfo);
                return $this->id;
        }

        function getArticles($feedId) {

                $conditions = array('Article.feed_id' => $feedId);
                $limit = 10;
                $order = array('Article.created' => 'DESC','Article.sort_order'=>'ASC');
                return $this->find('all', compact('conditions','limit','order'));
        }
        
        function getArticle($articleSlug){
                return $this->findBySlug($articleSlug);
        }

}
