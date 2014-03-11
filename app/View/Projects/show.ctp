<?php $this->Html->script( 'issues', array( 'inline' => false ) ); ?>
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


<h3>
  Issue
  <?php if( $project['Project']['status'] == Configure::read('STATUS_ACTIVE') ): ?>
    <?php if ($this->App->is_member($current_user['User'], $project['Member']) ): ?>
      <a href="/projects/<?php echo $project['Project']['id'] ?>/issues/new" class="btn btn-xs btn-default">Add a issue</a>
    <?php endif ?>
  <?php endif ?>
</h3>
<div class="btn-group btn-group-sm" style="margin-bottom:10px">
	<a href="/issues/?project_id=<?php echo $project['Project']['id']?>&status=open" class="btn btn-default btn-iss-status" data-remote="true">Open</a>
	<a href="/issues/?project_id=<?php echo $project['Project']['id']?>&status=closed" class="btn btn-default btn-iss-status" data-remote="true">Closed</a>
	<a href="/issues/?project_id=<?php echo $project['Project']['id']?>&status=not_do_today" class="btn btn-default btn-iss-status" data-remote="true">Don't do today</a>
</div>
<div id="issues" class="media-list">
	<?php echo $this->element('Issues/list') ?>
</div>

<div class="row">
	<div class="col-lg-6">
		<h3>Comments</h3>
		<div id="comments">
			<ul class="media-list">
			<?php foreach($comments as $comment):?>
			<li class="media">
				<div class="comment">
					<div class="comment-author">
					<?php echo $this->Html->link($comment['User']['name'], '/users/'.$comment['User']['id']) ?> @ <?php echo $this->App->timeAgo($comment['Comment']['created_at']) ?>
					</div>
					<div class="comment-body">
					<?php echo nl2br($comment['Comment']['body']) ?>
					</div>
				</div>
			</li>
			<?php endforeach ?>
			</ul>
		</div>
	</div>

		<div class="col-lg-6">
			<div class="section">
				<h3>Workloads</h3>
				<ul class="media-list">
				<?php foreach($workloads as $workload):?>
				<?php if(is_null($workload['Workload']['end_at'])):?><?php continue; ?><?php endif ?>
					<li class="media">
						<div class="workload">
							<a href="/users/<?php echo $workload['Workload']['user_id'] ?>">kkrrjp</a>
							<br>
							WorkTime <?php echo $this->Workload->progressTime($workload['Workload']['start_at'], $workload['Workload']['end_at']); ?>
							<br>
							Start At: <?php echo $workload['Workload']['start_at'] ?> / End At: <?php echo $workload['Workload']['end_at'] ?>
							<div class="actions">
								<a class="btn btn-default" href="/workloads/<?php echo $workload['Workload']['id'] ?>/edit">Edit</a>
								<a class="btn btn-danger" data-confirm="Are you sure?" data-method="delete" href="/workloads/<?php echo $workload['Workload']['id'] ?>" rel="nofollow">Destroy</a>
							</div>
						</div>
					</li>
				<?php endforeach ?>
				</ul>
			</div>
		</div>
</div>
