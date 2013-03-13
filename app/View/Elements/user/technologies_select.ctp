<ul class="noListMarker ">
<?php
//echo $this->element('projects/technologies_select',array('technologyRow'=> $technologies['children']));

foreach ($technologyRow as $row){
    
    if($row['children']){
        echo $this->Form->label("technologygroup.{$row['Technology']['id']}",'[+] '.$row['Technology']['name'].':');
        echo $this->element('user/technologies_select',array('technologyRow'=> $row['children']));
        
    }else{
       $checked = (isset($currentTechs) && in_array($row['Technology']['id'],$currentTechs))? 'checked':'';
        echo '<li>';
        echo $this->Form->input("technologies.{$row['Technology']['id']}",array('type'=>'checkbox','value'=>$row['Technology']['id'],'label'=>$row['Technology']['name'],'checked'=>$checked));
        echo '</li>';
    }
    
}
?>
</ul>
<hr />