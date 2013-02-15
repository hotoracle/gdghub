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

}