<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?php echo $this->Form->create('Project', array('url' => $_thisUrl)); ?>

<?php echo $this->element('form_validator'); ?>

<div class="row">
    <div class="span8">
          <div class="bordered fullWidth">
        <h4>Project Details&nbsp;</h4>
        <div data-role="fieldcontain">
            <fieldset data-role="controlgroup">
                <?php echo $this->Form->input('name', array('placeholder' => 'Project Name', 'required' => 'required', 'label' => false)); ?>
            </fieldset>
        </div>
        <div data-role="fieldcontain">
            <fieldset data-role="controlgroup">
                <?php echo $this->Form->input('description', array('type' => 'textarea', 'placeholder' => 'Description of this Project', 'required' => 'required', 'label' => '<span>Minimum of 100 characters</span>', 'rows' => 4)); ?>
            </fieldset>
        </div>
        <div data-role="fieldcontain">
            <fieldset data-role="controlgroup">
                <?php echo $this->Form->input('project_url', array('placeholder' => 'Website', 'label' => 'Website <span>If this project has a website.</span>')); ?>
            </fieldset>
        </div>
        <div data-role="fieldcontain">
            <fieldset data-role="controlgroup">
                <label for="city_name">Project Category:<span>Choose the most appropriate category?</label>
                <?php echo $this->Form->select('category_id', $categories, array('empty' => false)); ?>
            </fieldset>
        </div>
        
            
            <?php 
            if(isset($projectId)){
            echo $this->Form->submit('Update', array('class' => 'btn btn-primary ', 'div' => false)); ?> &nbsp;<?php
            echo $this->Html->link('Back to Project', "viewProject/$projectId", array('class' => 'btn btn-primary '));  ?> &nbsp;<?php
            echo $this->Html->link('Projects List', 'index', array('class' => 'btn btn-primary ')); 
                
            }else{
            echo $this->Form->submit('Create', array('class' => 'btn btn-primary wideBtn', 'div' => false)); 
            ?>&nbsp;<?php
            echo $this->Html->link('Cancel', 'index', array('class' => 'btn btn-danger wideBtn','confirm'=>'Are you sure?')); 
            }
            
            ?>

    </div>
    </div>
    <div class="span4 ">
          <div class="bordered">
                        <h4>Project Technologies&nbsp;</h4>

        <div data-role="fieldcontain">
            <fieldset data-role="controlgroup">
                <?php echo $this->Form->label('techselections', 'Select the technologies used on this project'); ?>
                <?php
                $selected = array();
                //echo $form->input('Model.name', array('multiple' => 'checkbox', 'options' => $technologies, 'selected' => $selected));

                echo $this->element('user/technologies_select', array('technologyRow' => $technologies['children']));
                ?>

            </fieldset>
        </div>

        <div data-role="fieldcontain">

        </div>

    </div>
    </div>
</div>

<span class="grey">
</span>
<br />
<br />
<?php echo $this->Form->end(); ?>
    
