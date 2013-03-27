<?php
/**
  Filename: sidebar.ctp
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 8, 2013  7:54:22 AM
 */
?>
<?php if($this->name=='Dashboard' && $this->action=='index') { ?>
<div class="well welcome">
        <h1>Welcome!</h1>
        <p>
                <span class="smaller">The <span class="blue">DevHub</span> is a community-driven platform to <a href="<?php echo $this->Html->url('/D'); ?>" ><span class="maroon">connect with &amp; find</span></a> Developers, Designers and Serious Tech Enthusiasts</span>
        </p>
</div>
<?php } ?>
<div class="bordered alignCenter" id="sideAskQuestion">
      <p class="lead"><a href="<?php echo $this->Html->url('/Questions'); ?>">Do you have a question?<br />Get answers from Experts in the Community.</a></p>
      
</div>
<div class="bordered bordered-light alignCenter">
      <div class="" id="listedQuestion">
            <?php echo $this->Html->link('Are you listed?','/MyTechProfile',array('id'=>'textLikeLink')); ?>
            
      </div>
      <?php if(isset($randomSkills) && $randomSkills){ ?>
            <?php foreach($randomSkills as $row){ ?>
            <div class="bordered">
                  <span class="skillItem"><?php echo $this->Html->link($row['Skillset']['name']. ' | More Like This ','/D/index/skill:'.$row['Skillset']['id'],array('class'=>'white')); ?></span>
                  
                        <ul class="thumbnails">

            <?php foreach($row['Users'] as $user){ ?>
            
            <li class="thumbnail">
                        <?php echo $this->element('user/basic', array('user' => $user['User'])); ?>
            </li>
            <?php } ?>
                  </ul>
            </div>
            <?php } ?>
                        <?php echo $this->Html->link('View All',"/D") ;?>

      <?php } ?>
      <hr />
      <?php if(isset($skillsStats) && $skillsStats){ ?>
      <div class="userSkills">
                  <?php foreach($skillsStats as $skillStat){ 
                        
                        $rLink = $this->Html->url("index/skill:{$skillStat['Skillset']['id']}");
                        ?>
                  <a href="<?php echo $rLink; ?>"><span>&Because; <?php echo $skillStat['Skillset']['name']; ?><em> x <?php echo $skillStat['UsersSkill']['qcount']; ?></em></span></a>
                  <?php } ?>
                  <div class="clearDiv"></div>
            </div>
                  <?php } ?>

</div>

<div id="gplusActivities" class="bordered">
        <div class="center">
<g:plus href="https://plus.google.com/112227844855698647164" ></g:plus>
        </div>
<?php if (isset($gplusActivity) && $gplusActivity){ ?>
        <ul>
<?php
$limit = 8;
$a=0;
foreach($gplusActivity as $row){
        if($a>$limit) break;
        $a++;
?>
                <li>
                        <?php echo $this->Html->link($row['title'],$row['link'],array('target'=>'_blank')); ?> <span><?php echo $row['date'];?></span>
                </li>
                <?php } ?>
        </ul>
        <?php echo $this->Html->link("Visit Google+ Page","https://plus.google.com/".Configure::read('Application.gplus_page_id'),array('class'=>'maroon')); ?>
</div>
<?php } ?>