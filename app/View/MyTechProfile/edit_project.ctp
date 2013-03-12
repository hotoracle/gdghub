<?php

echo $this->element('projects/my_nav');
$projectId = $projectInfo['Project']['id'];




?>

<h4>Edit Project</h4>
<?php
echo $this->element('projects/form');

?>