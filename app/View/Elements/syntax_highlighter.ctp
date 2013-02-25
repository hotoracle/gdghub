<?php

/**
  Filename: syntax_highlighter.ctp
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 25, 2013  7:01:41 PM
 */
?>
<?php echo $this->Html->css('sh/shCore') ?>
<?php echo $this->Html->css('sh/shThemeDefault') ?>
<?php echo $this->Html->script('sh/scripts/shCore') ?>
<?php // echo $this->Html->script('sh/scripts/shBrushAppleScript.js')  ?>
<?php // echo $this->Html->script('sh/scripts/shBrushAS3.js')  ?>
<?php // echo $this->Html->script('sh/scripts/shBrushBash.js')  ?>
<?php // echo $this->Html->script('sh/scripts/shBrushColdFusion.js')  ?>
<?php // echo $this->Html->script('sh/scripts/shBrushCpp.js')  ?>
<?php echo $this->Html->script('sh/scripts/shBrushJScript.js') ?>
<?php echo $this->Html->script('sh/scripts/shBrushPhp.js') ?>
<?php echo $this->Html->script('sh/scripts/shBrushPlain.js') ?>
<?php echo $this->Html->script('sh/scripts/shBrushXml.js') ?>

<script>
      $().ready(function(){
            
          SyntaxHighlighter.all();  
            
      });
      
      </script>