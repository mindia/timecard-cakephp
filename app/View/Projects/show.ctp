<?php 
echo $this->Html->link(
  'Back to all projects',
  '/projects/'
)
?>
<div class="project-header">
 	<div class="project-name">
	    <h2>
	      <?php echo $project['Project']['name'] ?>
	    </h2>
  	</div>
	<div class="project-description">
		<p><?php echo nl2br($project['Project']['description']) ?></p>
	</div>
	<div class="project-is-public">
	<?php if($project['Project']['is_public']): ?>
		<span class="label label-info">Public</span>
	<?php else:?>
		<span class="label label-default">Private</span>
	<?php endif ?>
	</div>

	<?php if($this->App->is_admin($current_user['User'], $project['Member'])):?>
	<div class="project-actions">
		<?php if($project['Project']['status'] == Configure::read('STATUS_ACTIVE')):?>
		<a href="#" class="btn btn-default">Add a member</a>
		<a href="#" class="btn btn-default">Edit</a>
		<a href="#" class="btn btn-default">Close</a>
		<a href="#" class="btn btn-default">Archive</a>
		<?php else:?>
		<a href="#" class="btn btn-default">Active</a>
		<?php endif ?>
    	</div>
	<?php endif?>
</div>

<div class="row">

</div>