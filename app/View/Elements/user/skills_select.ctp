<?php

/**
  Filename: skills_select.ctp 
  @author: Femi TAIWO [dftaiwo@gmail.com]
  Created: Mar 12, 2013  7:25:36 PM
 */
?>
<ul class="noListMarker skillList">
<?php
foreach ($skillRow as $row){
    
    if($row['children']){
        echo $this->Form->label("skillgroup.{$row['Skillset']['id']}",'[+] '.$row['Skillset']['name'].':');
        echo $this->element('user/skills_select', array('skillRow' => $row['children']));
        
    }else{
       $checked = (isset($mySkillSets) && in_array($row['Skillset']['id'],$mySkillSets))? 'checked':'';
        echo '<li>';
        echo $this->Form->input("skillset.{$row['Skillset']['id']}",array('type'=>'checkbox','value'=>$row['Skillset']['id'],'label'=>$row['Skillset']['name'],'checked'=>$checked));
        echo '</li>';
    }
    
}
?>
</ul>
<hr />