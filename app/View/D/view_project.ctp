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

                  <?php if ($projectInfo['Project']['project_url']) { ?>
                        <span class="badge badge-inverse bigger">
                              Url: <?php echo $this->Html->link($projectInfo['Project']['project_url'], $projectInfo['Project']['project_url'], array('target' => '_blank')); ?>
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
                  <?php } ?>
            </div>
      </div>
      <div class="span4">
            <div class="bordered row-fluid">
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
                              </li>
                        <?php } ?>
                  </ul>  
                  <div class="clearDiv"></div>
                  <hr />

            </div>
            <div class="bordered">
                  <p class="lead">Project Posted By

                  <?php echo $this->element('user/basic', array('user' => $userInfo['User'],'imgW'=>128)); ?>
                  </p>
                  <?php if(isset($userProjects) && $userProjects && count($userProjects)>1){ ?>
                  <p>
                       <strong>Other Projects</strong> 
                  </p>
                  <ul class="no">
                  <?php foreach($userProjects as $project){ 
                        if($project['Project']['id'] == $projectId) continue;
                        ?>
                  <li><?php echo $this->Html->link($project['Project']['name'],"viewProject/$userId/{$project['Project']['id']}"); ?></li>
                  
                  <?php } ?>
                  </ul>
                  <?php } ?>
                  <div class="clearDiv"></div>

            </div>
      </div>


