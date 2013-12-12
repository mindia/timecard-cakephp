<div class="row">
	<div class="col-lg-6">
		<div class="issue">
		  <div class="issue-author text-muted">
<<<<<<< HEAD
		    <b><?php echo $issue['Author']['name'] ?></b> opened this issue <?php echo $this->App->timeAgo($issue['Issue']['created_at']) ?>
=======
		    <b><?php echo $issue['Author']['username'] ?></b> opened this issue <?php echo $this->App->timeAgo($issue['Issue']['created_at']) ?>
>>>>>>> iss-14 projectにissueを登録できるようにする
		  </div>
		  <div class="issue-subject">
		    <h2 style="margin:0">
		      <?php //echo  link_to_provider(@issue) ?>
		      <?php echo h($issue['Issue']['subject']) ?>
		    </h2>
		  </div>
		  <div class="issue-assignee">
		    <?php if( isset($issue['Assignee']['id'])): ?>
<<<<<<< HEAD
		      <b><?php echo $issue['Assignee']['name'] ?></b> is assigned
=======
		      <b><?php echo $issue['Assignee']['username'] ?></b> is assigned
>>>>>>> iss-14 projectにissueを登録できるようにする
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