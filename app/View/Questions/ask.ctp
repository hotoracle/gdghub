<?php
/**
  Filename: ask.ctp
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 12, 2013  6:43:00 PM
 */
?>
<div>

      <h1>Ask a Question</h1>
      <div class="floatRight"><?php echo $this->Html->link('Browse Questions', 'index'); ?></div>
      <p>
            This portion should explain the rules and provide tips for asking questions
      </p>
      <div class="row">
            <div class="span7 bordered shadowed fullWidth">        

                  <?php echo $this->Form->create('Ask'); ?>
                  <?php echo $this->element('form_validator'); ?>
                  <?php echo $this->Form->input('title'); ?>

                  <?php echo $this->Form->input('description', array('type' => 'textarea', 'rows' => 10)); ?>
                  <div class="normalWidth bordered">
                        Click on "Insert Code" to paste your code  - if part of your question contains code : <input type="button" value="Insert Code" class="btn btn-success btn-primary"  data-toggle="modal" data-target="#myModal" />
                  </div>

                  <div class="ui-widget">
                <?php echo $this->Form->input('tags', array('id' => 'tags', 'label' => 'Tags <span class="smaller">Used to identity technologies, platforms and products. Separate different tags using commas</span>')); ?> 
        </div>
                  <?php echo $this->Form->submit('Submit'); ?>
                  <?php echo $this->Form->end(); ?>
            </div>
            <div class="span4 bordered shadowed">

                  Provide context sensitive help/tips here

            </div>
      </div>
</div>

<?php echo $this->element("questions/insert_code"); ?>
<script>

</script>
<script>
        $(function() {
                var availableTags = <?php echo json_encode($possibleTags); ?>
                
                function split( val ) {
                        return val.split( /,\s*/ );
                }
                function extractLast( term ) {
                        return split( term ).pop();
                }
 
                $( "#tags" )
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
        });
</script>