<?php

/**
  Filename: SnippetHelper.php
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 25, 2013  3:47:05 PM
 */
class SnippetHelper extends AppHelper {

      function highlight($element) {
            
            $r = str_get_html($html);
            $r->set_callback('highlightSnippets');
            return $r;
            
      }

}

function highlightSnippets($element) {
      if(!is_object($element) || !isset($element->tag)){
            return;
      }
      $settings = Configure::read('syntaxHighlighter');
//      $supportedTypes = isset($settings['supportedTypes'])? $settings['supportedTypes']:array();
      
      $srcCodeTag = isset($settings['tag'])? $settings['tag']:'srccode';
      
      if ($element->tag == 'srccode') {
            $brushType = 'Text';
            if (isset($element->type) && in_array($element->type, $supportedTypes)) {
                  $brushType = 'js';
            }
            $parts = array(
                "<pre class=\"brush: $brushType;ruler: true;\">",
                $element->innertext,
                "</pre>"
            );
            $element->outertext = join("\n", $parts);
      }
}