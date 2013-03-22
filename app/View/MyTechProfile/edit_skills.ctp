<?php

/**
  Filename: edit_skills.ctp 
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Mar 12, 2013  7:20:31 PM
 */
echo $this->element('breadcrumb');
?>

<div class="row">

        <div class="span9">
                <div class="alert alert-info">
                      <h4>Specify your skills below</h4>
                      
                </div>
              <p>There's a comprehensive list of relevant tech skills in our database, but it is not exhaustive. <br />
                            If you specify a skill/knowledge area that we do not yet have, we will save it but it  will only be displayed on your profile and on the platform after we verify that such a skill exists. <br /> We are doing this to make sure the platform is as clean and usable as possible.
                      </p>
<?php echo $this->Form->create('Skills'); ?>
                      <?php echo $this->element('form_validator'); ?>
              <div class="fullWidth">
<?php echo $this->Form->input('selSkills',array('id'=>'selSkills','label'=>'Enter Skills Below','required')); ?>
              </div>
               <span id="searchLog"></span>
                <div id="selectedSkills" class="userSkills">
                      <div class="userSkills">
                        <?php
                        foreach ($mySkillSets as $skillRow) {
                              ?><span>&Because;<?php echo $skillRow['Skillset']['name']; ?>
                              <?php echo $this->Html->link('[x]',"removeSkill/{$skillRow['Skillset']['id']}"); ?>
                              </span>
                                    <?php
                              }
                              ?></div>

                        <div class="clear"></div>
                        <p>&nbsp;</p>
                       
                </div>
                <div class="clear"></div>
<?php echo $this->Form->submit('Update',array('div'=>false,'class'=>'btn wideBtn')); ?>&nbsp;<?php
                echo $this->Html->link('Cancel & Return','index',array('class'=>'btn wideBtn')); 
?>
<?php echo $this->Form->end(); ?>
        </div>
</div>

<script>
        $(function() {
                var availableTags = <?php echo json_encode($possibleSkills); ?>
                
                function split( val ) {
                        return val.split( /,\s*/ );
                }
                function extractLast( term ) {
                        return split( term ).pop();
                }
 
                $( "#selSkills" )
                // don't navigate away from the field on tab when selecting an item
                .bind( "keydown", function( event ) {
                        if ( event.keyCode === $.ui.keyCode.TAB &&
                                $( this ).data( "autocomplete" ).menu.active ) {
                                event.preventDefault();
                        }
                })
                .autocomplete({
                        minLength: 0,
                        source: function( request, response ) {
                                // delegate back to autocomplete, but extract the last term
                                response( $.ui.autocomplete.filter(
                                availableTags, extractLast( request.term ) ) );
                        },
                        focus: function() {
                                // prevent value inserted on focus
                                return false;
                        },
                        select: function( event, ui ) {
                                var terms = split( this.value );
                                // remove the current input
                                terms.pop();
                                // add the selected item
                                terms.push( ui.item.value );
                                // add placeholder to get the comma-and-space at the end
                                terms.push( "" );
                                this.value = terms.join( ", " );
                                return false;
                        }
                });
  $(window).keydown(function(event){
    if( (event.keyCode == 13)) {
      event.preventDefault();
      return false;
    }
  });
  
        });
</script>
