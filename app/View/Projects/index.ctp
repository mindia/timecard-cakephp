<?php foreach($projects as $project){ ?>
<?php 
  echo $this->Html->link(
    $project["Project"]["name"],
     array('controller' => 'projects', 'action' => 'view', $project["Project"]["id"])
  )
  
?>
<?php } ?>
