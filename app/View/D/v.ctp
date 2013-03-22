<?php
/**
  Filename: v.ctp
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Mar 16, 2013  12:24:29 PM
 */
echo $this->element('breadcrumb');
?>
<div class="row dashboardBox">
      <div class="span4">
            <ul class="thumbnails">
                  <li>
                        <div class="thumbnail">
                              <?php
                              $rImage = ($user['User']['image']) ? $user['User']['image'] : cRead('Application.default_avatar_large');
                              if (stripos($rImage, 'http') === false) {
                                    $rImage = '.' . $rImage;
                              }
                              ?>
                              <img src="<?php echo $this->Html->url('/r.php'); ?>?src=<?php echo $rImage; ?>&w=300&h=300"  alt="<?php echo $user['User']['name'] . ' Photo'; ?>" />
                              <div class="caption">
                                    <h3 class="profileName"><?php echo $user['User']['name']; ?></h3>
                                    <p><em><?php echo $user['Profile']['title']; ?></em></p>
                                    <hr />
                                    <p><?php echo (isset($summarizeProfile) && $summarizeProfile) ? $this->Qv->shortenText($user['Profile']['profile_summary'], 500) : $user['Profile']['profile_summary']; ?></p>
                              </div>
                              <hr />
                              <?php echo $this->element('user/contact_prop'); ?>
                        </div>
                  </li>
            </ul>
            <hr />


      </div>
      <div class="span8">
            <div class="bordered">
                  <div class="userSkills">
                        <h1>Skills</h1>
                        <?php
                        foreach ($userSkillsets as $skillRow) {
                              ?><a href="#"><span>&Because;<?php echo $skillRow['Skillset']['name']; ?></span></a>
                              <?php
                        }
                        ?></div>
                  <div class="clearDiv"></div>

            </div>
            <div class="bordered">
                  <h1>Projects</h1>
                  <?php
                  foreach ($userProjects as $project) {
                        $projectId = $project['Project']['id'];
                        ?>
                        <div class="row-fluid">
                              <?php
                              if ($project['ProjectPhoto']) {
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
                              <div class="<?php if ($project['ProjectPhoto']) echo 'span8'; ?>">
                                    <h3><?php echo $this->Html->link($project['Project']['name'], "viewProject/$projectId"); ?></h3>
                                    <p><?php echo $project['Project']['description']; ?></p>
                                    <p>&nbsp;</p>
                                    <p></p>

                              </div>

                        </div>

                        <hr />
                        <?php
                  }
                  ?>
            </div>
      </div>
</div>

