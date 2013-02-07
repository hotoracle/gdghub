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
        public $isNew = false;

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

                $hash = md5($feedId . '_' . $feedInfo['name']);
                $existingArticle = $this->findByHash($hash);
                $this->isNew  = false;
                if ($existingArticle)
                        return $existingArticle['Article']['id'];
                $this->isNew  = true;
                $feedInfo['feed_id'] = $feedId;
                $feedInfo['hash'] = $hash;
                $this->create($feedInfo);
                $this->save($feedInfo);
                return $this->id;
        }

        function getArticles($feedId,$published=1) {

                $conditions = array('Article.feed_id' => $feedId,'Article.published'=>$published);
                $limit = 10;
                $order = array('Article.sort_order'=>'ASC','Article.id'=>'DESC');
                return $this->find('all', compact('conditions','limit','order'));
        }
        
        function getArticle($articleSlug){
                return $this->findBySlug($articleSlug);
        }

}
