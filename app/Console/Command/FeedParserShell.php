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
                foreach ($feedInfo as $feed) {
                        $feedId = $feed['Feed']['id'];
                        
                        $this->pullFeedUrl($feedId,$feed['Feed']['url']);
                }
        }

        function pullFeedUrl($feedId,$feedUrl = '') {
                if (!$feedUrl){
                        $this->out("Empty Url Error");
                        return;
                }
                
                try {
                         $this->out("Pulling from $feedUrl");
                        $content = @file_get_contents($feedUrl);

                        $rss = simplexml_load_string($content);
                        if (!$rss) {
                                $this->out("Parser Error");
                                return;
                        }
                         $sortOrder=0;
                        foreach ($rss->channel->item as $feedItem) {
                                
                                $feedItem->pubDate = str_replace('UT','',$feedItem->pubDate);
                                
                                $feedInfo = array(
                                    'name'=>$feedItem->title,
                                    'external_link'=>$feedItem->link,
                                    'description'=>$feedItem->description,
                                    'date_published'=>date('Y-m-d H:i:s',strtotime($feedItem->pubDate)),
                                    'sort_order'=>$sortOrder
                                );
                                
                                $this->Article->createArticle($feedId,$feedInfo);
                                $sortOrder++;
                        }
                } catch (Exception $e) {
                        $this->out("Unable to pull feed {$e->message}");
                }
        }

        function pullFeedById($feedId) {

//                $feedInfo = $this
        }

}