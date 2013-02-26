<?php

/**
  Filename: insert_code.ctp 
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 26, 2013  1:14:07 AM
 */
$insertTargetId = isset($insertTargetId)? $insertTargetId:'AskDescription'; 

?>
<div class="modal hide custom-width-modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header alignRight">
            <button class="btn btn-mini" data-dismiss="modal" aria-hidden="true">Close</button>

      </div>
      <div class="modal-body">
            <!-- content will be loaded here -->

            Language: <?php echo $this->Form->select('code_type', $codeTypes, array('id' => 'selCodeType')); ?>
            <div class='fullWidth'>
                  <textarea id="codeEditor" rows="8" cols="100"></textarea>
            </div>

      </div>
      <div class="modal-footer">
            <a class="btn btn-inverse" onclick="insertCode('<?php echo $insertTargetId; ?>');">Insert Code</a>
            
            <a class="btn" data-dismiss="modal" aria-hidden="true">Close</a>

      </div>
</div>