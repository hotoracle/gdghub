<?php
/**
  Filename: index.ctp
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Mar 16, 2013  12:24:21 PM
 */
echo $this->element('breadcrumb');
?>
<div class="row">
      <div class="span3">
            <div class="bordered">


            </div>
      </div>
      <div class="span9">
            <div class="bordered">
                  <ul class="profileThumbs thumbnails">
                        <?php for ($i = 0; $i < 4; $i++) { ?>
                              <?php
                              foreach ($users as $user) {
                                    $rLink =$this->Html->url("v/{$user['User']['id']}");
                                    $rImage = ($user['User']['image']) ? $user['User']['image'] : cRead('Application.default_avatar_large');
                                    if (stripos($rImage, 'http') === false) {
                                          $rImage = '.' . $rImage;
                                    }
                                    ?>

                                    <li class="span4">
                                          <div class="thumbnail-horiz row-fluid">

                                                <div class="span3 pull-left">
                                                      <a href="<?php echo $rLink; ?>">
                                                            <img src="<?php echo $this->Html->url('/r.php'); ?>?src=<?php echo $rImage; ?>&w=128&h=128"  alt="<?php echo $user['User']['name'] . ' Photo'; ?>" />
                                                      </a>
                                                </div>
                                                <div class="span9 caption pull-right">
                                                      <a href="<?php echo $rLink; ?>">

                                                            <h5><?php echo $user['User']['name']; ?></h5>
                                                            <p>
                                                                  <span class="title">
                                                                        <?php
                                                                        if (!$user['Profile']['title']) {
                                                                              $user['Profile']['title'] = '&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ';
                                                                        }
                                                                        ?>
            <?php echo $user['Profile']['title']; ?>
                                                                  </span>
                                                            </p>
                                                      </a>

                                                </div>
                                          </div>
                                    </li>


                              <?php } ?>
<?php } ?>
                  </ul>
            </div>
      </div>


</div>