<?php
$projectId = $projectInfo['Project']['id'];
echo $this->element('breadcrumb');

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
            
<?php if($projectInfo['Project']['project_url']){ ?>
<span class="badge badge-inverse bigger">
      Project Url: <?php echo $this->Html->link($projectInfo['Project']['project_url'],$projectInfo['Project']['project_url'],array('target'=>'_blank')); ?>
</span>
<p>&nbsp;</p>

<?php } ?>
<?php
                  if ($projectTechs) {
                        ?><div>
                        <?php
                        foreach ($projectTechs as $tech) {
                              ?><span class="badge badge-success">&Because;&nbsp;<?php echo $tech['Technology']['name']; ?></span>
                                    <?php
                              }
                              ?>
                        </div>

                        <div class="clear"></div>
                        <p>&nbsp;</p>
                  <?php  } ?>
            <?php echo $this->Html->link('Edit Project Details', "editProject/$projectId", array('class' => 'btn btn-primary btn-small')); ?>

      </div>
      </div>
      <div class="span4">
            <div class="bordered">
            <ul class="thumbnails">
                  <?php
                        $photosPath = cRead('Application.upload.url_projects');

                        foreach ($projectPhotos as $photo) {
                              $fullImagePath = $photosPath . $photo['ProjectPhoto']['pic_url'];
                               $imageUrl = $fullImagePath;     
                              $imageUrl = '/r.php'.'?src='.$imageUrl.'&w=235';
                              ?>
                              <li class="span6 lightboxGallery" >
                                    <a href="<?php echo $this->Html->url($fullImagePath); ?>" class="thumbImg thumbnail">
                                          <?php echo $this->Html->image($imageUrl); ?>
                                          <?php echo $photo['ProjectPhoto']['description']; ?>
                                    </a>
                                    <div class="thumbActions center">
                              <?php
                              echo $this->Html->link('Delete Photo',"deleteProjectPhoto/$projectId/{$photo['ProjectPhoto']['id']}",array('confirm'=>'Delete this photo?','class'=>'red'));
                              ?>
                              </div>
                              </li>
                        <?php } ?>
            </ul>  
            <div class="clearDiv"></div>
            <hr />
            <h4>Upload Photos</h4>
            <?php if(count($projectPhotos) < cRead('Application.upload.max_project_photos')){ ?>
            <div class="alert-info alert">
                  Only JPG (JPEG) files are allowed
            </div>
            <?php
            $maxAllowed = cRead('Application.upload.max_project_photos');
            $spacesLeft = $maxAllowed - count($projectPhotos);
            echo $this->Form->create('ProjectPhoto', array('url' => $_thisUrl, 'type' => 'file'));
            for ($a = 1; $a <= $spacesLeft; $a++) {

                  echo $this->Form->input("photos.{$a}", array('type' => 'file', 'label' => false, 'div' => false, 'accept' => "image/jpg"));
                  echo '<br />';
            }
            echo $this->Form->hidden('upload', array('value' => 1));
            echo $this->Form->submit('Upload', array('class' => 'btn btn-primary'));
            echo $this->Form->end();
            ?>
            <?php }else{ ?>
            <div class="alert alert-info">
                  You will not be able to upload another photo for this project.<Br />The maximum allowed project photos is <?php echo cRead('Application.upload.max_project_photos'); ?>. 
            </div>
            <?php } ?>
      </div>
      </div>
      </div>


