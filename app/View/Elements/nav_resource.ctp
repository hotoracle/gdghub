<?php
/**
  Filename: sidebar.ctp
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Feb 8, 2013  7:54:22 AM
 */
?>
<div class="well welcome">
    <div class="dropdown clearfix">
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display: block; position: static; margin-bottom: 5px;">
                    <li><a tabindex="-1" href="#">Google Docs</a></li>
                    <li><a tabindex="-1" href="#">Google Search</a></li>
                    <li><a tabindex="-1" href="#">Google Adsense</a></li>
                    <li><a tabindex="-1" href="#">Google Drive</a></li>
                    <li class="divider"></li>
                    <li><a tabindex="-1" href="#">Google Maps</a></li>
                    <li><a tabindex="-1" href="#">Google Earth</a></li>
                    <li><a tabindex="-1" href="#">Google APIs</a></li>
                    <li><a tabindex="-1" href="#">Google Sites</a></li>
                    <li class="divider"></li>
                    <li><a tabindex="-1" href="#">Google AppEngine</a></li>
                    <li><a tabindex="-1" href="#">Google Web Toolkit</a></li>
                    <li><a tabindex="-1" href="#">Google WebMaster Tools</a></li>
                </ul>
            </div>
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