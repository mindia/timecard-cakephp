<div class="row">
	<div class="col-md-7">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="issue-author text-muted">
				    <b><?php echo $issue['Author']['name'] ?></b> opened this issue <?php echo $this->App->timeAgo($issue['Issue']['created_at']) ?>
				    <?php echo $this->Html->link('Edit', '/issues/'.$issue['Issue']['id'].'/edit', ['class'=>'btn btn-sm btn-default pull-right']) ?>
				  </div>
				<div class="panel-title">
					<h4><?php echo h($issue['Issue']['subject']) ?></h4>
				</div>
				<div class="issue-status">
					<?php if((int)$issue['Issue']['status'] === 1): ?>
					<span class="label label-success">Open</span>
					<?php else: ?>
					<span class="label label-danger">Close</span>
					<?php endif ?>
				</div>
			</div>
			<div class="panel-body">
				<div class="issue">
				  <div class="issue-assignee well">
				    <?php if( isset($issue['Assignee']['id'])): ?>
				      <b><?php echo $this->Html->link($issue['Assignee']['name'], '/users/'.$issue['Assignee']['id']) ?></b> is assigned
				    <?php else: ?>
				        No one is assigned
				    <?php endif ?>
				    will start at <?php echo (isset($issue['Issue']['will_start_at'])? $issue['Issue']['will_start_at']:"today") ?>
				  </div>
				  
				  <div class="issue-description">
				    <?php echo (isset($issue['Issue']['description'])? nl2br($issue['Issue']['description']):"No description given.") ?>
				  </div>

				  <?php if ($this->App->is_member($current_user['User'], $project_member['Member']) &&  $issue['Project']['status'] == Configure::read('STATUS_ACTIVE')): ?>
				    <div class="issue-actions">
				      <?php //todo issue menu?>
				    </div>
				  <?php endif ?>
				</div>
			</div><!--/panel content-->
		</div><!--/panel-->
	</div>

	<div class="col-lg-5">
	  <h3>
	  	<a href="/projects/<?php echo h($issue['Project']['id']) ?>"><?php echo h($issue['Project']['name']) ?></a>
	  </h3>
	  <?php echo nl2br($issue['Project']['description']) ?>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>Comments</h4>
				</div>
			</div>
			<div class="panel-body">
				<?php foreach($comment_user as $comment):?>
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="panel-title">
							<?php if ($this->App->is_member($current_user['User'], $project_member['Member']) &&  $issue['Project']['status'] == Configure::read('STATUS_ACTIVE')): ?>
							<a href="#" class="close pull-right">×</a>
							<a href="#" class="btn btn-default btn-xs pull-right">Edit</a>
							<?php endif?>

							<span><?php echo $this->Html->link($comment['User']['name'], '/users/'.$comment['User']['id']) ?></span> 
							commented <span class="pull-right"><?php echo $this->App->timeAgo($comment['Comment']['created_at']) ?></span>
						</div>
					</div>
					<div class="panel-body">
						<?php echo nl2br($comment['Comment']['body']) ?>
					</div><!--/panel content-->
				</div><!--/panel-->
				<?php endforeach ?>

				<?php if ($this->App->is_member($current_user['User'], $project_member['Member']) &&  $issue['Project']['status'] == Configure::read('STATUS_ACTIVE')): ?>
				<div>
					<?php echo $this->Form->create('Comment', ['url'=>'/issues/'.$issue['Issue']['id'].'/comment']); ?>
						<div class="form-group">
							<?php echo $this->Form->input('body', ['type'=>'textarea', 'class'=>'form-control', 'placeholder'=>'Leave a comment', 'label'=>false]);?>
						</div>
						<div class="actions pull-right">
							<input class="btn btn-success" type="submit" value="Comment" name="commit"></input>
						</div>
					</form>
				</div>
				<?php endif?>
			</div><!--/panel content-->
		</div><!--/panel-->
	</div>

	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>Workloads</h4>
				</div>
			</div>
			<div class="panel-body">
				<ul class="media-list">
					<?php foreach($issue['Workload'] as $workload):?>
					<?php if(is_null($workload['end_at'])):?><?php continue; ?><?php endif ?>
					<li class="media">
						<div class="workload">
							<a href="/users/<?php echo $workload['user_id'] ?>">kkrrjp</a>
							<br>
							WorkTime <?php echo $this->Workload->progressTime($workload['start_at'], $workload['end_at']); ?>
							<br>
							Start At: <?php echo $workload['start_at'] ?> / End At: <?php echo $workload['end_at'] ?>
							<div class="actions">
								<a class="btn btn-default" href="/workloads/<?php echo $workload['id'] ?>/edit">Edit</a>
								<a class="btn btn-danger" data-confirm="Are you sure?" data-method="delete" href="/workloads/<?php echo $workload['id'] ?>" rel="nofollow">Destroy</a>
							</div>
						</div>
					</li>
					<?php endforeach ?>
				</ul>
			</div><!--/panel content-->
		</div><!--/panel-->
	</div>
</div>

