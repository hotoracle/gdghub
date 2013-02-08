<?php

/**
  Filename: FeedParserShell.php
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 5, 2013  7:14:26 PM
 */
class FeedParserShell extends AppShell {

        public $uses = array('Article', 'Feed');

        function main() {
                
        }

        function pullFeeds() {

                $feedInfo = $this->Feed->getActiveFeeds();
                $this->out("Feeds Found: ".count($feedInfo));
                $freshArticles  = array();
//                $this->Article->query("Truncate articles");
                foreach ($feedInfo as $feed) {
                        $feedId = $feed['Feed']['id'];
                        
                     $result =   $this->pullFeedUrl($feedId,$feed['Feed']['url']);
                     if($result){
                              $freshArticles[$feed['Feed']['name']] = $result;
                     }
//                     break;
                }
                if(!$freshArticles) return;
                
                App::uses('CakeEmail', 'Network/Email');
                $now = date('M d h:i:sa');
                $email = new CakeEmail('default');
                $email->viewVars(array('freshArticles'=>$freshArticles));
                $email->helpers(array('Html','Text'));
                $email->template('require_approval', 'default')
                ->emailFormat('html')
                ->from('tasks@gdglagos.com')
                ->subject("New Articles - Approval Required @ $now")
                ->to('dftaiwo@gmail.com')
                ->send();
                
        }

        function pullFeedUrl($feedId,$feedUrl = '') {
                $newArticles = array();
                if (!$feedUrl){
                        $this->out("Empty Url Error");
                        return;
                }
                
                try {
                         $this->out("Pulling from $feedUrl");
                         
                         
                        $content = @file_get_contents($feedUrl);
//                             $hash = md5($feedUrl);
//                        file_put_contents(TMP."/{$hash}.xml",$content);
//                             $content = file_get_contents(TMP."/{$hash}.xml");

                        $rss = simplexml_load_string($content);
                        if (!$rss) {
                                $this->out("Parser Error");
                                return;
                        }
                         $sortOrder=0;
                        foreach ($rss->channel->item as $feedItem) {
                                if(!isset($feedItem->pubDate)){
                                        $feedItem->pubDate = 'now';
                                }
                                $feedItem->pubDate = str_replace('UT','',$feedItem->pubDate);
                                
                                $feedInfo = array(
                                    'name'=>$feedItem->title,
                                    'external_link'=>$feedItem->link,
                                    'description'=>$feedItem->description,
                                    'date_published'=>date('Y-m-d H:i:s',strtotime($feedItem->pubDate)),
                                    'sort_order'=>$sortOrder
                                );
                            
                                $articleId = $this->Article->createArticle($feedId,$feedInfo);
                                
                                if($this->Article->isNew){
                                        $feedInfo['id'] = $articleId;
                                        $newArticles[] = $feedInfo;
                                }
                                
                                $sortOrder++;
                        }
                } catch (Exception $e) {
                        $this->out("Unable to pull feed ".$e->getMessage());
                }
                return $newArticles;
        }

        function pullFeedById($feedId) {

//                $feedInfo = $this
        }

}