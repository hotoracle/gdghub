<?php

/**
  Filename: QHelper.php
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 14, 2013  5:54:54 PM
 */
class QvHelper extends AppHelper {

        /**
         * Return a human-friendly time
         * @param string $dateTime
         * @return string formatted time
         */
        
        function longTime($dateTime) {
                $t = strtotime($dateTime);
                return date('h:ia l F jS, Y', $t);
        }

        function shortenText($text,$maxLength=350){
                
                $text = strip_tags($text);
                $text = substr($text,0,$maxLength);
                $textParts = explode(' ',$text);
                array_pop($textParts);
                $text  = join(' ',$textParts).' ...';
                
                return $text;
                
                
        }
}