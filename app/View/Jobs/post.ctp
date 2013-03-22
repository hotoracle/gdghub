<?php
/**
  Filename: ask.ctp
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 12, 2013  6:43:00 PM
 */
?>
<div>

      <h1>Post A Job</h1>
      <div class="floatRight"><?php echo $this->Html->link('Browse Jobs', 'index'); ?></div>
      <p>
            This portion should explain the rules and provide tips for posting jobs.
      </p>
      <div class="row">
            <div class="span7 bordered shadowed fullWidth">        

                  <?php echo $this->Form->create('Post'); ?>
                  <?php echo $this->element('form_validator'); ?>
                  <?php echo $this->Form->input('title'); ?>

                  <?php echo $this->Form->input('description', array('type' => 'textarea', 'rows' => 10, 'required')); ?>
              <div class="fullWidth">
<?php echo $this->Form->input('selSkills',array('id'=>'selSkills','label'=>'Enter Required Skills Below','required')); ?>
              </div>
               <span id="searchLog"></span>
		<!--
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

		-->
<!--
                  <div class="ui-widget">
                <?php echo $this->Form->input('tags', array('id' => 'tags', 'label' => 'Tags <span class="smaller">Used to identity technologies, platforms and products. Separate different tags using commas</span>')); ?> 
        </div>
-->
                  <?php echo $this->Form->submit('Submit'); ?>
                  <?php echo $this->Form->end(); ?>
            </div>
            <div class="span4 bordered shadowed">

                  Provide context sensitive help/tips here

            </div>
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
