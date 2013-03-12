<?php
/**
  Filename: index.ctp
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Mar 10, 2013  11:50:39 AM
 */
?>
<pre>
- My Bio Profile 
- Public Contact Info
- Skills
- Projects
      - Project Description
      - Project Tech
      - Project Photos
</pre>
<div class="row">

      <div class="span3 dashboardBox">
            <div class="bordered">
                  <h1>My Public Profile</h1>            
            </div>
            <div class="bordered">
                  <h1>My Skills</h1>                
                  <?php
                  if ($userSkillsets) {
                        ?><div class="userSkills">
                        <?php
                        foreach ($userSkillsets as $skillRow) {
                              ?><span>&Because;<?php echo $skillRow['Skillset']['name']; ?></span>
                                    <?php
                              }
                              ?></div>

                        <div class="clear"></div>
                        <p>&nbsp;</p>
                        <div class="alignRight">
                              <?php
                              echo $this->Html->link('Edit Skills', "editSkills",array('class'=>'btn btn-mini btn-inverse wideBtn'));
                              ?>
                        </div>
                        <?php
                  } else {
                        ?>
                        <div class="alert-info message">
                              You have not specified your skills and knowledge areas. <?php echo $this->Html->link('Specify Skills', 'editSkills',array('class'=>'btn btn-mini btn-inverse wideBtn')); ?>
                        </div>
                  <?php } ?>

            </div>
      </div>



      <div class="span9 dashboardBox">
            <div class="bordered">
                  <h1>My Projects</h1>
                   <div class="alignRight">
                              <?php
                              echo $this->Html->link('Add Project', "addProject",array('class'=>'btn btn-mini btn-inverse wideBtn'));
                              ?>
                        </div>
            </div>
      </div>

</div>