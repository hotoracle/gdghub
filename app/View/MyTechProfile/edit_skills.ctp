<?php

/**
  Filename: edit_skills.ctp 
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Mar 12, 2013  7:20:31 PM
 */
?>
<div class="row">
<?php //echo $this->element('user_menu'); ?>

        <div class="span9">
                <div class="devNotes">
                        There's certainly a better way of doing this. Please use auto-complete
                </div>
<?php echo $this->Form->create('Skills'); ?>
<?php // echo $this->Form->input('selSkills',array('id'=>'selSkills','label'=>'Enter Skills Below')); ?>
               <span id="searchLog"></span>
                <div id="selectedSkills" class="userSkills"></div>
                <div class="clear"></div>
        <?php echo $this->Form->label('SkillSelection', 'Select Your Skills Below'); ?>

<?php
$selected = array();
echo $this->element('user/skills_select', array('skillRow' => $skillSets['children']));
?>
<?php echo $this->Form->submit('Update',array('div'=>false)); ?>&nbsp;<?php
                echo $this->Html->link('Cancel','mySkills',array('class'=>'btn btn-primary long')); 
?>
<?php echo $this->Form->end(); ?>
        </div>
</div>


<script>
    $(function() {
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
                source: function( request, response ) {
                    $.getJSON( "<?php echo $this->Html->url('/Public/autocompleteSkills'); ?>", {
                        term: extractLast( request.term )
                    }, response );
                },
                search: function() {
                    // custom minLength
                    var term = extractLast( this.value );
                    if ( term.length < 2 ) {
                        return false;
                    }
                },
                focus: function(x,r) {
                    // prevent value inserted on focus
                    
                    return false;
                },
                select: function( event, ui ) {
                itemId = ui.item.id;
                itemLabel = ui.item.name;
                itemHtml='<span id="'+itemId+'"><a href="javascript: removeSelectedDiv(\'#'+ itemId +'\');">x</a> ' + itemLabel + '<input type="hidden" name="data[autoskillset]['+itemId+']" value="'+itemId+'" /></span>';
                $( "#selectedSkills" ).append(itemHtml);
                return;
                     return;
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
            }).data( "autocomplete" )._renderItem = function( ul, item ) {
            return $( "<li>" )
                .data( "item.autocomplete", item )
                .append( "<a>" + item.name  + "</a>" )
                .appendTo( ul );
        };
    });
    
    function removeSelectedDiv(childElt){
//        if(confirm("Remove?")){
                $(childElt).remove();
    //    }
    }
    </script>