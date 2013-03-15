<?php
/**
  Filename: index.ctp
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Mar 10, 2013  11:50:39 AM
 */
?>

<div class="row">

      <div class="span3 dashboardBox">
            <div class="bordered">
                  <h1>My Public Profile</h1>
                  <?php echo $this->element('user/profile',array('user'=>$userInfo)); ?>
                  <div class="alignRight">
                  <?php echo $this->Html->link('Edit','editProfile', array('class' => 'btn btn-mini btn-inverse wideBtn')); ?>
                  </div>
            </div>
            <div class="bordered">
                  <h1>My Skills</h1>                
                  <?php
                  if ($userSkillsets) {
                        ?>
                  <div class="userSkills">
                        <?php
                        foreach ($userSkillsets as $skillRow) {
                              ?><span>&Because;<?php echo $skillRow['Skillset']['name']; ?></span>
                                    <?php
                              }
                              ?></div>

                        <div class="clear"></div>
                        <?php if($pendingSkillsets){ ?>
                        <hr />
                        <strong>Pending Approval</strong>
                        <div class="pendingUserSkills">
                        <?php foreach($pendingSkillsets as $skillRow){ ?>
                        <span>&Because;<?php echo $skillRow['SkillsetSubmission']['name']; ?></span>
                                    <?php
                              }
                              ?>
                        <?php } ?>
                        <div class="clear"></div>
                        <hr />

                        </div>
                        <p>&nbsp;</p>
                        <div class="alignRight">
                              <?php
                              echo $this->Html->link('Edit Skills', "editSkills", array('class' => 'btn btn-mini btn-inverse wideBtn'));
                              ?>
                        </div>
                        <?php
                  } else {
                        ?>
                        <div class="alert-info message">
                              You have not specified your skills and knowledge areas. <?php echo $this->Html->link('Specify Skills', 'editSkills', array('class' => 'btn btn-mini btn-inverse wideBtn')); ?>
                        </div>
                  <?php } ?>

            </div>
      </div>



      <div class="span9 dashboardBox">
            <div class="bordered">
                  <h1>My Projects</h1>
                  <?php
                  foreach ($myProjects as $project) {
                        $projectId = $project['Project']['id'];
                        ?>
                        <div class="row-fluid">
                              <?php if($project['ProjectPhoto']){ 
                                    $projectPhoto = $project['ProjectPhoto'][0];
                                    ?>
                              <div class="span3">
                                    
                                    <ul class="thumbnails">
                                          <?php
                                          $photosPath = cRead('Application.upload.url_projects');
                                          ?>
                                          <li>
                                                <a href="#" class="thumbImg thumbnail">
                                                      <?php echo $this->Html->image($photosPath . $projectPhoto['pic_url']); ?>
                                                      <?php echo $projectPhoto['description']; ?>
                                                </a>
                                          </li>
                                    </ul>  
                              </div>
                              <?php } ?>
                              <div class="<?php if($project['ProjectPhoto']) echo 'span8'; ?>">
                                    <h3><?php echo $this->Html->link($project['Project']['name'],"viewProject/$projectId"); ?></h3>
                                    <p><?php echo $project['Project']['description']; ?></p>
                                    <p>&nbsp;</p>
                              <p><?php echo $this->Html->link('Full Details',"viewProject/$projectId"); ?></p>

                              </div>

                        </div>
                  
                  <hr />
                        <?php
                  }
                  ?>
                  <?php
                  foreach ($myProjects as $project) {
                        $projectId = $project['Project']['id'];
                        ?>
                        <div class="row-fluid">
                              <?php if($project['ProjectPhoto']){ 
                                    $projectPhoto = $project['ProjectPhoto'][0];
                                    ?>
                              <div class="span3">
                                    
                                    <ul class="thumbnails">
                                          <?php
                                          $photosPath = cRead('Application.upload.url_projects');
                                          ?>
                                          <li>
                                                <a href="#" class="thumbImg thumbnail">
                                                      <?php echo $this->Html->image($photosPath . $projectPhoto['pic_url']); ?>
                                                      <?php echo $projectPhoto['description']; ?>
                                                </a>
                                          </li>
                                    </ul>  
                              </div>
                              <?php } ?>
                              <div class="<?php if($project['ProjectPhoto']) echo 'span8'; ?>">
                                    <h3><?php echo $this->Html->link($project['Project']['name'],"viewProject/$projectId"); ?></h3>
                                    <p><?php echo $project['Project']['description']; ?></p>
                                    <p>&nbsp;</p>
                              <p><?php echo $this->Html->link('Full Details',"viewProject/$projectId"); ?></p>

                              </div>

                        </div>
                  
                  <hr />
                        <?php
                  }
                  ?>
                  <div class="alignRight">
                        <?php
                        echo $this->Html->link('Add Project', "addProject", array('class' => 'btn btn-mini btn-inverse wideBtn'));
                        ?>
                  </div>
            </div>
      </div>

</div>