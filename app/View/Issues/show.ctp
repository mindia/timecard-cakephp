<div class="row">
	<div class="col-lg-6">
		<div class="issue">
		  <div class="issue-author text-muted">
		    <b><?php echo $issue['Author']['name'] ?></b> opened this issue <?php echo $this->App->timeAgo($issue['Issue']['created_at']) ?>
		    <?php echo $this->Html->link('Edit', '/issues/'.$issue['Issue']['id'].'/edit', ['class'=>'btn btn-sm btn-default pull-right']) ?>
		  </div>
		  <div class="issue-subject">
		    <h2 style="margin:0">
		      <?php //echo  link_to_provider(@issue) ?>
		      <?php echo h($issue['Issue']['subject']) ?>
		    </h2>
		  </div>
		  <div class="issue-assignee">
		    <?php if( isset($issue['Assignee']['id'])): ?>
		      <b><?php echo $this->Html->link($issue['Assignee']['name'], '/users/'.$issue['Assignee']['id']) ?></b> is assigned
		    <?php else: ?>
		        No one is assigned
		    <?php endif ?>
		    will start at <?php echo (isset($issue['Issue']['will_start_at'])? $issue['Issue']['will_start_at']:"today") ?>
		  </div>
		  <div class="issue-status">
		    <?php if((int)$issue['Issue']['status'] === 1): ?>
		      <span class="label label-success">Open</span>
		    <?php else: ?>
		      <span class="label label-danger">Close</span>
		    <?php endif ?>
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
	</div>
	<div class="col-lg-6">
	  <h2>
	  	<a href="/projects/<?php echo h($issue['Project']['id']) ?>"><?php echo h($issue['Project']['name']) ?></a>
	  </h2>
	  <?php echo nl2br($issue['Project']['description']) ?>
	</div>
</div>

<?php //todo comment & workload display?>
<div class="row">
	<div class="col-lg-6">
		<h3>Comments</h3>
		<ul class="media-list">
			<!--<%= render partial: 'comments/comment', collection: @issue.comments.order("id ASC") %>-->
			<?php foreach($comment_user as $comment):?>
			<li class="media comment-area">
			<div class="comment">
				<div class="comment-author">
					<?php echo $this->Html->link($comment['User']['name'], '/users/'.$comment['User']['id']) ?> commented <?php echo $this->App->timeAgo($comment['Comment']['created_at']) ?>
				</div>
				<div class="comment-body">
					<?php echo nl2br($comment['Comment']['body']) ?>
				</div>
				<div class="comment-actions">
					<?php if ($this->App->is_member($current_user['User'], $project_member['Member']) &&  $issue['Project']['status'] == Configure::read('STATUS_ACTIVE')): ?>
					<a href="#" class="btn btn-default">Edit</a>
					<a href="#" class="btn btn-danger">Destroy</a>
					<?php endif?>
				</div>
			</div>
			</li>
			<?php endforeach ?>
		</ul>

		<?php if ($this->App->is_member($current_user['User'], $project_member['Member']) &&  $issue['Project']['status'] == Configure::read('STATUS_ACTIVE')): ?>
		<?php echo $this->Form->create('Comment', ['url'=>'/issues/'.$issue['Issue']['id'].'/comment']); ?>
			<div class="form-group">
				<?php echo $this->Form->input('body', ['type'=>'textarea', 'class'=>'form-control', 'placeholder'=>'Leave a comment', 'label'=>false]);?>
			</div>
			<div class="actions pull-right">
				<input class="btn btn-success" type="submit" value="Comment" name="commit"></input>
			</div>
		</form>
		<?php endif?>
	</div>

	<div class="col-lg-6">
		<div class="section">
			<h3>Workloads</h3>
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
		</div>
	</div>
</div>
<?php //todo comment & workload display?>
