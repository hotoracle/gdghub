<?php

/**
  Filename: test_parse.php 
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 25, 2013  3:40:24 PM
 */

$html ='
      This is text at the beginning
  <srccode type="php">
  This is a test part
</srccode>
This is text outside both
  <srccode type="javascript">
  This is javascript
</srccode>
This is text at the end
';

require_once ('../Vendor/simple_html_dom.php');
function highlightSnippets($element) {
        $supportedTypes = array();
        if ($element->tag=='srccode'){
              $brushType = 'Text';
              if(isset($element->type) && in_array($element->type,$supportedTypes)){
                  $brushType = 'js';
              }
              $parts = array(
                  "<pre class=\"brush: $brushType;ruler: true;\">",
                  $element->innertext,
                  "</pre>"
              );
              $element->outertext = join("\n",$parts);
                
        }
} 
$r = str_get_html($html);
$r->set_callback('highlightSnippets');

echo $r;
foreach($r->find('srccode') as $element) {
       echo $element->innerText() . "\n";
       
}
//print_r($r);







//preg_match('/<h2>(.*?)<\/h2>/s', $data, $matches);