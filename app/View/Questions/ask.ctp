<?php
/**
  Filename: ask.ctp
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 12, 2013  6:43:00 PM
 */
?>
<div>
      <h1>Ask a Question</h1>

      <p>
            This portion should explain the rules and provide tips for asking questions
      </p>
      <div class="row">
            <div class="span7 bordered shadowed fullWidth">        

                  <?php echo $this->Form->create('Ask'); ?>
                  <?php echo $this->element('form_validator'); ?>
                  <?php echo $this->Form->input('title'); ?>
                  <?php echo $this->Form->input('description', array('type' => 'textarea','rows'=>10)); ?>
                  <div class="normalWidth">
                        <input type="button" value="Insert Code" class="btn btn-inverse btn-mini"  data-toggle="modal" data-target="#myModal" />
                  </div>

                  <?php echo $this->Form->input('tags'); ?>
                  <?php echo $this->Form->submit('Submit'); ?>
                  <?php echo $this->Form->end(); ?>
            </div>
            <div class="span4 bordered shadowed">

                  Provide context sensitive help/tips here

            </div>
      </div>
</div>
<div class="modal hide custom-width-modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header alignRight">
            <button class="btn btn-mini" data-dismiss="modal" aria-hidden="true">Close</button>

      </div>
      <div class="modal-body">
            <!-- content will be loaded here -->

            Language: <?php echo $this->Form->select('code_type', $codeTypes, array('id' => 'selCodeType')); ?>
            <div class='fullWidth'>

                  <textarea id="codeEditor" rows="8" cols="100">
This is test code outside php
                        <?php echo '<?php 
        echo $_SERVER["HTTP_HOST"]; 
?>'; ?>
                  </textarea>
            </div>

      </div>
      <div class="modal-footer">
            <button class="btn btn-inverse" onclick="insertCode();">Insert Code</button>
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>

      </div>
</div>

<script>
                  function insertCode() {

                        var enteredCode = $('#codeEditor').val();
                        var selectedCodeType = $('#selCodeType').val();

                        $('#codeEditor').val('');

                        $('#selCodeType').val('');
                        
                        
                        var preCodeTag = postCodeTag = '';
                        if (selectedCodeType) {
                              preCodeTag = '\n[code_' + selectedCodeType + '_code]\n';
                              postCodeTag = '\n[/code_' + selectedCodeType + '_code]\n';
                        }
                        var completeCode = preCodeTag + enteredCode + postCodeTag;
                        
                        
                        try {
                              insertAtCaret('AskDescription', completeCode);
                        } catch (e) {
                              var currentText = $('#AskDescription').val();
                              $('#AskDescription').val(currentText + completeCode);

                        }
                        $('#myModal').modal('hide');


                  }

</script>