<?php
$projectId = $projectInfo['Project']['id'];

?>
 
<div class="row">
      <div class="span8">
      <div class=" hero-unit">
            <h3>
      <?php
      echo $projectInfo['Project']['name'];
      ?>
</h3>   
            <p>
            <?php echo $projectInfo['Project']['description']; ?>
            </p>
            

            <?php echo $this->Html->link('Edit Project Details', "editProject/$projectId", array('class' => 'btn btn-primary btn-small')); ?>

      </div>
      </div>
      <div class="span4">
            <div class="bordered">
            <ul class="thumbnails">
                  <?php 
                  $photosPath = cRead('Application.upload.url_projects');

                  foreach ($projectPhotos as $photo) { ?>
                        <li>
                              

                              <a href="#" class="thumbImg thumbnail">
                                    <?php echo $this->Html->image( $photosPath. $photo['ProjectPhoto']['pic_url'], array('width' => 135)); ?>
                                    <?php echo $photo['ProjectPhoto']['description']; ?>
                              </a>
                              <div class="thumbActions center">
                              <?php
                              echo $this->Html->link('Delete Photo',"deleteProjectPhoto/$projectId/{$photo['ProjectPhoto']['id']}",array('class'=>'Delete this photo?'));
                              ?>
                              </div>
                        </li>
                  <?php } ?>
            </ul>  
            <div class="clearDiv"></div>
            <hr />
            <h4>Upload Photos</h4>
            <div class="devNotes">
                  This here should list the allowed file uploads
            </div>
            <?php
            echo $this->Form->create('ProjectPhoto', array('url' => $_thisUrl, 'type' => 'file'));
            for ($a = 1; $a < 4; $a++) {

                  echo $this->Form->input("photos.{$a}", array('type' => 'file', 'label' => false, 'div' => false, 'accept' => "image/*"));
                  echo '<br />';
            }
            echo $this->Form->hidden('upload', array('value' => 1));
            echo $this->Form->submit('Upload', array('class' => 'btn btn-primary'));
            echo $this->Form->end();
            ?>

      </div>
      </div>
      </div>


