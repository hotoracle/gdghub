<?php

/**
  Filename: basic.ctp 
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 14, 2013  6:02:19 PM
 */
if(isset($user) && isset($user['id']) && $user['id']){
?>
<a href="<?php echo $this->Html->url("/Developers/viewProfile/{$user['id']}",true); ?>">
        <?php 
        if(!isset($noPhoto) || (isset($noPhoto) && $noPhoto==false)){
                $imageUrl = (isset($user['image']) && $user['image'])? $user['image']:cRead('Application.default_avatar');
                $imageUrl = '/r.php'.'?src='.$imageUrl.'&w=300&h=300';
                echo $this->Html->image($imageUrl, array('width'=>isset($imgW)? $imgW:64,'alt'=>$user['name'],'align'=>'right','class'=>'gravatar-small')); 
        }
        echo $user['name']; ?>
</a>
        
<?php } ?>