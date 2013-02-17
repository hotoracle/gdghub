<?php

/**
  Filename: paginator.ctp 
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 15, 2013  11:28:48 PM
 */
?>
<div class="alignCenter smaller">
<p><?php
                        echo $this->Paginator->counter(array(
                            'format' => __d('cake', 'Page {:page} of {:pages}, showing {:current} out of {:count}')
                        ));
                        ?></p>
                <div class="pagination pagination-centered">
                        <ul>
                        <?php
                        echo $this->Paginator->prev(__('Previous'), array('tag'=>'li'), null, array('class' => 'prev disabled'));
                        echo $this->Paginator->numbers(array('separator' => '', 'currentClass' => 'active hidden', 'class' => '', 'tag' => 'li'));
                        echo $this->Paginator->next(__('Next'), array('tag'=>'li'), null, array('class' => 'next disabled'));

                        ?>
                        </ul>
                </div>
</div>