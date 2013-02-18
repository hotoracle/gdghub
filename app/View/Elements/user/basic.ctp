<?php

/**
  Filename: basic.ctp 
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 14, 2013  6:02:19 PM
 */

?>
<a href="<?php echo $this->Html->url("/Developers/viewProfile/{$user['id']}"); ?>">
        <?php 
        if(!isset($noPhoto) || (isset($noPhoto) && $noPhoto==false)){
                $imageUrl = (isset($user['image']) && $user['image'])? $user['image']:'gravatar.gif';
                echo $this->Html->image($imageUrl, array('width'=>64,'alt'=>$user['name'],'align'=>'right','class'=>'gravatar-small')); 
        }
        echo $user['name']; ?>
</a>
        
