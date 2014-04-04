<?php $this->Html->script( 'issues', array( 'inline' => false ) ); ?>
<?php 
echo $this->Html->link(
  'Back to all projects',
  '/projects/'
)
?>
<br>
<div class="project-name">
	<div >
		<h4>
			<a href="/projects/<?php echo $project['Project']['id'] ?>"><strong><?php echo $project['Project']['name'] ?></strong></a>
		</h4>
		<?php if($this->App->is_admin($current_user['User'], $project['Member'])):?>
		<div class="pull-right">
			<?php if($project['Project']['status'] == Configure::read('STATUS_ACTIVE')):?>
			<a href="/projects/<?php echo $project['Project']['id'] ?>/members" class="btn btn-default">Add a member</a>
			<a href="/projects/<?php echo $project['Project']['id'] ?>/edit" class="btn btn-default">Edit</a>
			<a href="#" class="btn btn-default">Close</a>
			<a href="#" class="btn btn-default">Archive</a>
			<?php else:?>
			<a href="#" class="btn btn-default">Active</a>
			<?php endif ?>
	    	</div>
		<?php endif?>
	</div>
	<div class="project-is-public">
		<?php if($project['Project']['is_public']): ?>
		<span class="label label-info">Public</span>
		<?php else:?>
		<span class="label label-default">Private</span>
		<?php endif ?>
	</div>
</div>
<hr>
<p class="project-description">
	<p><?php echo nl2br($project['Project']['description']) ?></p>
</p>

<div class="panel panel-default">
	<div class="panel-heading">
		<div class="panel-title">
			<h4>Issue</h4>
			<?php if( $project['Project']['status'] == Configure::read('STATUS_ACTIVE') ): ?>
			<?php if ($this->App->is_member($current_user['User'], $project['Member']) ): ?>
			<a href="/projects/<?php echo $project['Project']['id'] ?>/issues/new" class="btn btn-xs btn-default">Add a issue</a>
			<?php endif ?>
			<?php endif ?>
		</div>
	</div>
	<div class="panel-body">
		<div class="btn-group btn-group-sm" style="margin-bottom:10px">
			<a href="/issues/?project_id=<?php echo $project['Project']['id']?>&status=open" class="btn btn-default btn-iss-status" data-remote="true">Open</a>
			<a href="/issues/?project_id=<?php echo $project['Project']['id']?>&status=closed" class="btn btn-default btn-iss-status" data-remote="true">Closed</a>
			<a href="/issues/?project_id=<?php echo $project['Project']['id']?>&status=not_do_today" class="btn btn-default btn-iss-status" data-remote="true">Don't do today</a>
		</div>
		<div id="issues" class="media-list">
			<?php echo $this->element('Issues/list') ?>
		</div>
	</div><!--/panel content-->
</div><!--/panel-->



<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>Comments</h4>
				</div>
			</div>
			<div class="panel-body">
				<div id="comments">
					<?php foreach($comments as $comment):?>
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="panel-title">
								<span><?php echo $this->Html->link($comment['User']['name'], '/users/'.$comment['User']['id']) ?></span>
								<span class="pull-right"><?php echo $this->App->timeAgo($comment['Comment']['created_at']) ?></span>
							</div>
						</div>
						<div class="panel-body">
							<?php echo nl2br($comment['Comment']['body']) ?>
						</div><!--/panel content-->
					</div><!--/panel-->
					<?php endforeach ?>
				</div>
			</div><!--/panel content-->
		</div><!--/panel-->
	</div>

	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>WorkLoads</h4>
				</div>
			</div>
			<div class="panel-body">
				<div id="work-logs">
					<ul class="media-list">
					<?php // todo show workloads ?>
					</ul>
				</div>
			</div><!--/panel content-->
		</div><!--/panel-->
	</div>
</div>
