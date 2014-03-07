<?php $this->Html->script( 'members', array( 'inline' => false ) ); ?>

<a href="/projects/<?php echo $project['Project']['id']?>">Back to project</a>
<h2 id="project" data-projectid="<?php echo $project['Project']['id']?>"><?php echo h($project['Project']['name'])?></h2>
<hr>
<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>Project Member</h4>
				</div>
			</div>
			<div class="panel-body">
				<ul>
					<?php foreach($members as $member):?>
					<li>
						<?php echo $this->Html->link($member['User']['name'], '/users/'.$member['User']['id']) ?>
						<?php if(!$this->App->is_admin($member['User'], $project['Member'])):?>
						<a href="/members/<?php echo $member['User']['id']?>" class="btn btn-xs btn-danger btn-delete-member" confirm="Are you sure?" data-id="<?php echo $member['Member']['id']?>">Delete</a>
						<?php endif ?>
					</li>
					<?php endforeach ?>
				</ul>
			</div><!--/panel content-->
		</div><!--/panel-->
	</div>

	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">
					<h4>All User</h4>
				</div>
			</div>
			<div class="panel-body">
				<ul>
					<?php foreach($users as $user):?>
					<li>
						<?php echo $this->Html->link($user['User']['name'], '/users/'.$user['User']['id']) ?>
						<a href="/projects/<?php echo $project['Project']['id']?>/members/?user_id=<?php echo $user['User']['id']?>" class="btn btn-xs btn-success" data-method="post">Add</a>
					</li>
					<?php endforeach ?>
				</ul>
			</div><!--/panel content-->
		</div><!--/panel-->
	</div>
</div>