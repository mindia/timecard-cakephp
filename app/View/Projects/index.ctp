<div class="new-project" style="margin-bottom:20px">
	<?php echo $this->Html->link("New Project", ['controller' => 'projects', 'action' => 'new'], ['class'=>'btn btn-default']); ?>
</div>
<div class="btn-group btn-group-sm" style="margin-bottom:20px">
	<a href="/projects/?status=<?php echo Configure::read('STATUS_ACTIVE'); ?>" class="btn btn-default">Active</a>
	<a href="/projects/?status=<?php echo Configure::read('STATUS_CLOSED'); ?>" class="btn btn-default">Closed</a>
	<a href="/projects/?status=<?php echo Configure::read('STATUS_ARCHIVED'); ?>" class="btn btn-default">Archive</a>
</div>

<div class="row">
<?php if(count($projects)>0):?>
<?php foreach($projects as $project): ?>
	<div class="col-md-4" style="margin-bottom:20px;">
		<div class="project" id="project_<?php echo $project['Project']['id'] ?>" style="height:200px;">
			<div class="project-name">
				<?php 
				  echo $this->Html->link(
				    $project["Project"]["name"],
				    '/projects/'.$project["Project"]["id"]
				  )
				?>
			</div>
			<?php if(isset($project['Project']['description'])):?>
			<div>
				<p><?php echo nl2br(h($project['Project']['description'])) ?></p>
			</div>
			<?php endif?>
			<div id="members">
				<?php foreach($project['Member'] as $member):?>
					<?php echo $this->Html->link($project_users[$member['user_id']], '/users/'.$member['user_id']) ?>
				<?php endforeach?>
			</div>
		</div>
	</div>
<?php endforeach; ?>
<?php else:?>
	<p class="alert alert-danger">プロジェクトが見つかりませんでした</p>
<?php endif ?>
</div>
