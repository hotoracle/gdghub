<?php

/**
  Filename: EvHelper.php
  @author: Damilare Fagbemi [damilarefagbemi@gmail.com]
  Created: Mar 22, 2013  11:20:54 AM
 */
class EvHelper extends AppHelper {

      /**
       * Return a human-friendly time
       * @param string $dateTime
       * @return string formatted time
       */
      function longTime($dateTime) {
            $t = strtotime($dateTime);
            return date('h:ia l F jS, Y', $t);
      }

      function shortenText($text, $maxLength = 350) {

            $text = strip_tags($text);
            $text = substr($text, 0, $maxLength);
            $textParts = explode(' ', $text);
            array_pop($textParts);
            $text = join(' ', $textParts) . ' ...';

            return $text;
      }

      function highlight($rawHtml='') {
            require_once(APP.'Vendor/simple_html_dom.php');
            $r = str_get_html($rawHtml);
       //     $r->set_callback('highlightSnippets');
            return $r;
      }

      function highlightSnippets($rawHtml='') {
            return $this->highlight($rawHtml);
      }

}

function highlightSnippets($element) {
      if (!is_object($element) || !isset($element->tag)) {
            return;
      }
      
      $settings = Configure::read('syntaxHighlighter');
      
      $supportedTypes = isset($settings['supportedTypes'])? $settings['supportedTypes']:array();

      $srcCodeTag = isset($settings['tag']) ? $settings['tag'] : 'srccode';

      if ($element->tag == $srcCodeTag) {
            
            $brushType = 'text';
            
            if (isset($element->type) && array_key_exists($element->type, $supportedTypes)) {
                  $brushType =$element->type;
            }
            
            $parts = array(
                "<pre class=\"brush: $brushType;ruler: true; toolbar: false;\">",
                htmlentities($element->innertext),
                "</pre>"
            );
            $element->outertext = join("\n", $parts);
      }elseif($element->tag=='img'){ 
            //prevent people just placing images and scripts need to go too!
            if(isset($element->src)){
                  $element->outertext = "[img]".$element->src."[/img]";
            }
      }elseif($element->tag=='script'){ 
            //prevent people just placing images and scripts need to go too!
            
            $element->outertext = "[script]".htmlentities($element->innertext)."[/script]";
            
      }elseif($element->tag!='text'){
            $element->outertext = '['.$element->tag.']'.($element->innertext).'[/'.$element->tag.']';
      }
}
