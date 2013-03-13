<?php

echo $this->element('breadcrumb');
$projectId = $projectInfo['Project']['id'];




?>

<h4>Edit Project</h4>
<?php
echo $this->element('user/project_form');

?>